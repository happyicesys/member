<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'total_discount_amount',
        'total_landing_page_visit_count',
    ];
}
