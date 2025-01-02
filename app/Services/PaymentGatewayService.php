<?php

namespace App\Services;

use App\Interfaces\PaymentGatewayInterface;
use App\Services\PaymentGateways\Stripe;

class PaymentGatewayService
{
    protected $gateways = [];

    public function __construct()
    {
        $this->gateways = [
            'stripe' => new Stripe(),
            // Add other gateways here
        ];
    }

    public function getGateway(string $gateway): PaymentGatewayInterface
    {
        if (!isset($this->gateways[$gateway])) {
            throw new \Exception("Payment gateway '{$gateway}' is not supported.");
        }

        return $this->gateways[$gateway];
    }

    public function supportsSubscriptions(string $gateway): bool
    {
        $gatewayInstance = $this->getGateway($gateway);
        return $gatewayInstance instanceof \App\Interfaces\SubscriptionGatewayInterface;
    }
}

