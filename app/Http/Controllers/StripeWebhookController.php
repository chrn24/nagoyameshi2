<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Cashier\Subscription;

class StripeWebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        $payload = $request->all();

        if ($payload['type'] === 'invoice.payment_succeeded') {
            $invoice = $payload['data']['object'];
            $stripeSubscriptionId = $invoice['subscription'];
            $amount = $invoice['amount_paid'] / 100;

            $subscription = Subscription::where('stripe_id', $stripeSubscriptionId)->first();
            if ($subscription) {
                $subscription->price_amount = $amount;
                $subscription->save();
            }
        }

        return response()->json(['status' => 'ok']);
    }
}
