<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Support\Facades\Session;


class PaymentController extends Controller
{
    public function showPaymentPage(Request $request)
    {
        $grandTotal = $request->query('amount'); // Get amount from query string
        return view('user.payment', compact('grandTotal'));
    }

    public function stripePost(Request $request): RedirectResponse
    {
        try {
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            $amount = intval($request->amount * 100);

            Stripe\Charge::create([
                "amount" => $amount,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Payment of $" . $request->amount
            ]);

            // Retrieve order data from session
            $orderData = session('order_data');

            if ($orderData) {
                $order = Order::create([
                    'user_id' => $orderData['user_id'],
                    'name' => $orderData['name'],
                    'email' => $orderData['email'],
                    'address' => $orderData['address'],
                    'payment_method' => $orderData['payment_method'],
                    'total_price' => $orderData['total_price'],
                ]);

                foreach ($orderData['cart_items'] as $cartItem) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $cartItem['product_id'],
                        'product_title' => $cartItem['product_title'],
                        'product_price' => $cartItem['product_price'],
                        'quantity' => $cartItem['quantity'],
                    ]);
                }

                // Clear cart after successful payment
                Cart::where('user_id', $orderData['user_id'])->delete();

                // Clear session data
                session()->forget('order_data');
            }

            return redirect()->route('redirect')->with('success', 'Payment successful! Order placed.');
        } catch (\Exception $e) {
            return redirect()->route('cart.show')->with('error', 'Payment failed: ' . $e->getMessage());
        }
    }
}
