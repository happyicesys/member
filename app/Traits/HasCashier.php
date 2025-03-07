<?php

namespace App\Traits;


trait HasCashier
{
    public function getCashierKey(): string
    {
        return config('cashier.key');
    }
}