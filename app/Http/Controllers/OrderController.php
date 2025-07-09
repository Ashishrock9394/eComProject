<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;


class OrderController extends Controller
{

        public function paymentPage()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to checkout.');
        }

        $cartItems = Cart::where('user_id', Auth::id())->get();
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.show')->with('error', 'Your cart is empty.');
        }

        $grandTotal = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product_price;
        });

        return view('user.checkout', compact('cartItems', 'grandTotal'));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'address' => 'required|string|max:500',
            'payment_method' => 'required',
        ]);

        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.show')->with('error', 'Your cart is empty.');
        }

        $grandTotal = $cartItems->sum(fn($item) => $item->quantity * $item->product_price);

        // If payment method is not COD, save order data in session and redirect to payment
        if ($request->payment_method !== "COD") {
            session([
                'order_data' => [
                    'user_id' => $user->id,
                    'name' => $request->name,
                    'email' => $request->email,
                    'address' => $request->address,
                    'payment_method' => $request->payment_method,
                    'total_price' => $grandTotal,
                    'cart_items' => $cartItems->toArray()
                ]
            ]);
            return redirect()->to('/pay?amount=' . $grandTotal);
        }

        // If COD, process order immediately
        $order = $this->createOrder($user, $request, $cartItems);
        Cart::where('user_id', $user->id)->delete();
        
        return redirect()->route('redirect')->with('success', 'Order placed successfully!');
    }

    // Extracted method to handle order creation
    private function createOrder($user, $request, $cartItems)
    {
        $order = Order::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'payment_method' => $request->payment_method,
            'total_price' => $cartItems->sum(fn($item) => $item->quantity * $item->product_price),
        ]);

        foreach ($cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'product_title' => $cartItem->product_title,
                'product_price' => $cartItem->product_price,
                'quantity' => $cartItem->quantity,
            ]);
        }

        return $order;
    }

   public function showOrderHistory()
{
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'You must be logged in to view your orders.');
    }

    $orders = Order::where('user_id', Auth::id())
                   ->with('orderItems') // Eager load
                   ->get();

    return view('user.order_history', compact('orders'));
}



}
