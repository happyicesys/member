<?php

namespace App\Services;

use App\Models\User;
use Exception;

class PaymentService
{
    // ✅ Ensure Stripe customer exists and update details
    public function updateOrCreateStripeCustomer($user)
    {
        $stripeCustomer = $user->createOrGetStripeCustomer();

        $user->updateStripeCustomer([
            'name' => $user->name,
            'address' => [
                'postal_code' => '659526',
                'country' => 'SG',
            ],
        ]);

        return $stripeCustomer;
    }

    // ✅ Add a new payment method (without automatically setting it as default)
    public function getPaymentMethod($user, $paymentMethod = null)
    {
        if ($paymentMethod) {
            $user->addPaymentMethod($paymentMethod);

            $user->updateDefaultPaymentMethod($paymentMethod);
        }

        return $user->defaultPaymentMethod();
    }

    // ✅ Properly set the default payment method (with validation)
    public function setDefaultPaymentMethod($user, $paymentMethodId = null)
    {
        if($paymentMethodId) {
            $paymentMethod = $user->findPaymentMethod($paymentMethodId);
        }else {
            $paymentMethod = $user->paymentMethods()->first();
        }

        // Set the default payment method
        $user->updateDefaultPaymentMethod($paymentMethod->id);
    }
}
