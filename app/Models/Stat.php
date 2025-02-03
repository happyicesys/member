<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    const TYPE_DAILY = 1;
    const TYPE_MONTHLY = 2;

    protected $fillable = [
        'landing_page_visit_count',
        'new_user_count',
        'new_user_source_json',
        'promo_amount',
        'sales_amount',
        'type',
    ];

    protected $casts = [
        'new_user_source_json' => 'json'
    ];

}
