<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'name',
        'abbreviation',
        'currency_name',
        'currency_exponent',
        'currency_symbol',
        'is_active',
        'is_currency_exponent_hidden',
        'is_default',
        'phone_code',
        'timezone',
    ];

    protected $casts = [
        'is_currency_exponent_hidden' => 'boolean',
        'is_active' => 'boolean',
        'is_default' => 'boolean',
    ];
}
