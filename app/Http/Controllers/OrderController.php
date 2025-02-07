<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;

class OrderController extends Controller
{

        public function checkout()
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

    // public function placeOrder(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email',
    //         'address' => 'required|string|max:500',
    //         'payment_method' => 'required',
    //     ]);

    //     $user = Auth::user();
    //     $cartItems = Cart::where('user_id', $user->id)->get();

    //     if ($cartItems->isEmpty()) {
    //         return redirect()->route('cart.show')->with('error', 'Your cart is empty.');
    //     }

    //     // Create Order
    //     $order = new Order();
    //     $order->user_id = $user->id;
    //     $order->name = $request->name;
    //     $order->email = $request->email;
    //     $order->address = $request->address;
    //     $order->payment_method = $request->payment_method;
    //     $order->total_price = $cartItems->sum(fn($item) => $item->quantity * $item->product_price);
    //     $order->save();

    //     // Save Order Items
    //     foreach ($cartItems as $cartItem) {
    //         OrderItem::create([
    //             'order_id' => $order->id,
    //             'product_id' => $cartItem->product_id,
    //             'product_title' => $cartItem->product_title,
    //             'product_price' => $cartItem->product_price,
    //             'quantity' => $cartItem->quantity,
    //         ]);
    //     }

    //     // Clear the cart
    //     Cart::where('user_id', $user->id)->delete();

    //     return redirect()->route('checkout')->with('success', 'Order placed successfully!');
    // }
    

}
