<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanItem extends Model
{


    protected $fillable = [
        'plan_id',
        'name',
        'product_codes_json',
        'type',
    ];

    protected $casts = [
        'product_codes_json' => 'json',
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
