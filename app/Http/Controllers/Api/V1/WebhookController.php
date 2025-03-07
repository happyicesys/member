<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\PlanService;
use Stripe\Stripe;
use Stripe\Webhook;
use Log;

class WebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $event = Webhook::constructEvent(
                $request->getContent(),
                $request->header('Stripe-Signature'),
                env('STRIPE_WEBHOOK_SECRET')
            );

            if ($event->type === 'invoice.payment_failed') {
                $user = User::where('stripe_id', $event->data->object->customer)->first();
                if ($user) {
                    Log::warning("Payment failed for user: {$user->id}");
                    $user->planItemUser->update(['is_active' => false]); // Temporarily disable plan
                }
            }

            if ($event->type === 'invoice.payment_succeeded') {
                $user = User::where('stripe_id', $event->data->object->customer)->first();
                if ($user) {
                    Log::info("Payment succeeded for user: {$user->id}");
                    app(PlanService::class)->syncPlan($user->id, $user->planItemUser->plan_id);
                }
            }

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            Log::error("Stripe webhook error: " . $e->getMessage());
            return response()->json(['error' => 'Webhook failed'], 400);
        }
    }
}
