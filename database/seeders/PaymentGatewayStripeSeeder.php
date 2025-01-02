<?php

namespace Database\Seeders;

use App\Models\PaymentGateway;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentGatewayStripeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaymentGateway::create([
            'name' => 'Stripe',
            'slug' => 'stripe',
            'desc' => 'Stripe payment gateway',
        ]);
    }
}
