<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;


class PaymentController extends Controller
{
        public function showPaymentPage(Request $request)
    {

        $grandTotal = $request->query('amount'); // Get amount from query string
        return view('user.payment', compact('grandTotal'));
    }

    public function stripePost(Request $request): RedirectResponse
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $amount = intval($request->amount * 100);
      
        Stripe\Charge::create ([
                "amount" => $amount,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Payment of $" . $request->amount
        ]);
                
        return redirect()->route('redirect')->with('success', 'Payment successful!');
    }
}
