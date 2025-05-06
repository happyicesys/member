<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    const TYPE_DAILY = 1;
    const TYPE_MONTHLY = 2;

    protected $fillable = [
        'cumulative_landing_page_visit_count',
        'landing_page_visit_count',
        'latest_sms_credit_balance',
        'new_user_count',
        'new_user_source_json',
        'promo_amount',
        'sales_amount',
        'type',
    ];

    protected $casts = [
        'new_user_source_json' => 'json'
    ];

    // Mutator and accessor for price
    protected function latestSmsCreditBalance(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value / 100, // Convert cents to dollars
            set: fn ($value) => $value * 100, // Convert dollars to cents
        );
    }

}
