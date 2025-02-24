<?php

namespace Database\Seeders;

use App\Models\PlanItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanItemPlatinumBaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PlanItem::create([
            'plan_id' => 4,
            'name' => 'Unlimited: 30% discount on all products',
            'cycle' => 1,
            'frequency' => 'monthly',
            'is_base' => true,
            'promo_type' => 'percent',
            'promo_value' => 30,
        ]);
    }
}
