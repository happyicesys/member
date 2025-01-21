<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanItemUser extends Model
{
    protected $fillable = [
        'datetime_from',
        'datetime_to',
        'is_active',
        'plan_item_id',
        'used_count',
        'user_id',
    ];

    protected $casts = [
        'datetime_from' => 'datetime',
        'datetime_to' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function planItem()
    {
        return $this->belongsTo(PlanItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
