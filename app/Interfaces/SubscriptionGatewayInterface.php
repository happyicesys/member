<?php

namespace App\Interfaces;

interface SubscriptionGatewayInterface
{
    public function createSubscription(array $details): bool;
    public function cancelSubscription(string $subscriptionId): bool;
    public function resumeSubscription(string $subscriptionId): bool;
}

