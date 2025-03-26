<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StripePaymentController extends Controller
{
  public function paymentCreate(Request $request)
  {
    try {
      \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

      $paymentIntent = \Stripe\PaymentIntent::create([
        'amount' => 100 * 150,
        'currency' => 'mad',
        'automatic_payment_methods' => [
          'enabled' => true,
        ],
      ]);

      $output = [
        'clientSecret' => $paymentIntent->client_secret,
      ];

      return response()->json($output);
    } catch (\Exception $e) {
      return response()->json(['error' => $e->getMessage()], 500);
    }
  }
}
