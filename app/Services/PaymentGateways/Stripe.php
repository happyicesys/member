<?php

namespace App\Services\PaymentGateways;

use App\Interfaces\PaymentGatewayInterface;
use App\Interfaces\SubscriptionGatewayInterface;
use App\Models\User;

class Stripe implements PaymentGatewayInterface, SubscriptionGatewayInterface
{
    public function charge(float $amount, array $details): bool
    {
        try {
            $user = User::findOrFail($details['user_id']);

            // Laravel Cashier's charge method
            $user->charge($amount, $details['payment_method'] ?? null);

            return true;
        } catch (\Exception $e) {
            \Log::error('Stripe Charge Error: ' . $e->getMessage());
            return false;
        }
    }

    public function refund(string $transactionId): bool
    {
        try {
            \Stripe\Refund::create(['charge' => $transactionId]);

            return true;
        } catch (\Exception $e) {
            \Log::error('Stripe Refund Error: ' . $e->getMessage());
            return false;
        }
    }

    public function createSubscription(array $details): bool
    {
        try {
            $user = User::findOrFail($details['user_id']);

            // Laravel Cashier's subscription method
            $user->newSubscription($details['name'], $details['plan_id'])
                 ->create($details['payment_method']);

            return true;
        } catch (\Exception $e) {
            \Log::error('Stripe Subscription Creation Error: ' . $e->getMessage());
            return false;
        }
    }

    public function cancelSubscription(string $subscriptionId): bool
    {
        try {
            $user = User::whereHas('subscriptions', function ($query) use ($subscriptionId) {
                $query->where('stripe_id', $subscriptionId);
            })->firstOrFail();

            $subscription = $user->subscriptions()->where('stripe_id', $subscriptionId)->firstOrFail();
            $subscription->cancel();

            return true;
        } catch (\Exception $e) {
            \Log::error('Stripe Subscription Cancellation Error: ' . $e->getMessage());
            return false;
        }
    }

    public function resumeSubscription(string $subscriptionId): bool
    {
        try {
            $user = User::whereHas('subscriptions', function ($query) use ($subscriptionId) {
                $query->where('stripe_id', $subscriptionId);
            })->firstOrFail();

            $subscription = $user->subscriptions()->where('stripe_id', $subscriptionId)->firstOrFail();
            $subscription->resume();

            return true;
        } catch (\Exception $e) {
            \Log::error('Stripe Subscription Resumption Error: ' . $e->getMessage());
            return false;
        }
    }
}
