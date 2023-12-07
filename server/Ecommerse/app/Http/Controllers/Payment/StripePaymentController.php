<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\PaymentSuccess;
use Exception;
use Illuminate\Http\Request;
use Stripe;
class StripePaymentController extends Controller
{

    public function stripePost(Request $request)
    {
        try {
            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

            // Create a PaymentIntent
            $paymentIntent = $stripe->paymentIntents->create([
                'amount' => $request->amount,
                'currency' => 'usd',
                'payment_method' => $request->stripePaymentMethod,
                'confirmation_method' => 'manual',
                'confirm' => true,
                'return_url' => 'http://localhost:5173/store',
            ]);
            if ($paymentIntent->status === "succeeded") {
                foreach ($request->cartItems as $item){
                    PaymentSuccess::create([
                        'user_name'=>$request->fullName,
                        'user_email'=>$request->email,
                        'user_phone'=>$request->phone,
                        'user_address'=>$request->address,
                        'product_id'=> $item['id'],
                        'product_qty' => $item['qty']
                    ]);
                }
            }

            return response()->json(['status' => $paymentIntent->status], 201);
        } catch (Exception $ex) {
            return response()->json(['response' => 'failed', 'error' => $ex->getMessage()], 500);
        }
    }

}
