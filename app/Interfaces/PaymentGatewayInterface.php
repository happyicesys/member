<?php

namespace App\Interfaces;

interface PaymentGatewayInterface
{
    public function charge(float $amount, array $details): bool;
    public function refund(string $transactionId): bool;
}
