<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanItem extends Model
{
    protected $fillable = [
        'cycle',
        'datetime_from',
        'datetime_to',
        'frequency',
        'is_base',
        'max_count',
        'name',
        'plan_id',
        'product_codes_json',
        'promo_type',
        'promo_value',
    ];

    protected $casts = [
        'product_codes_json' => 'json',
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function planItemUsers()
    {
        return $this->hasMany(PlanItemUser::class);
    }
}
