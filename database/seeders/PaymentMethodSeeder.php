<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paymentMethods = [
            ['name' => 'Visa', 'slug' => 'visa', 'full_url' => 'https://happyice-space.sgp1.digitaloceanspaces.com/dcvend/payment-gateway/visa.png'],
            ['name' => 'Mastercard', 'slug' => 'mastercard', 'full_url' => 'https://happyice-space.sgp1.digitaloceanspaces.com/dcvend/payment-gateway/mastercard.png'],
            ['name' => 'American Express', 'slug' => 'american_express', 'full_url' => 'https://happyice-space.sgp1.digitaloceanspaces.com/dcvend/payment-gateway/american_express.png'],
            ['name' => 'Discover', 'slug' => 'discover', 'full_url' => 'https://happyice-space.sgp1.digitaloceanspaces.com/dcvend/payment-gateway/discover.png'],
            ['name' => 'Diners Club', 'slug' => 'diners_club', 'full_url' => 'https://happyice-space.sgp1.digitaloceanspaces.com/dcvend/payment-gateway/diners_club.png'],
            ['name' => 'JCB', 'slug' => 'jcb', 'full_url' => 'https://happyice-space.sgp1.digitaloceanspaces.com/dcvend/payment-gateway/jcb.png'],
            ['name' => 'UnionPay', 'slug' => 'unionpay', 'full_url' => 'https://happyice-space.sgp1.digitaloceanspaces.com/dcvend/payment-gateway/union_pay.png'],
        ];

        foreach ($paymentMethods as $paymentMethod) {
            $paymentMethodObj = PaymentMethod::create([
                'name' => $paymentMethod['name'],
                'slug' => $paymentMethod['slug'],
            ]);

            $paymentMethodObj->attachment()->create([
                'full_url' => $paymentMethod['full_url'],
                'name' => $paymentMethod['name'],
            ]);
        }
    }
}
