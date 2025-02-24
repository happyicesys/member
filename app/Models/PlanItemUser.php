<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class PlanItemUser extends Model
{
    const NOTIFICATION_BEFORE_DAYS = 30;

    protected $fillable = [
        'datetime_from',
        'datetime_to',
        'is_active',
        'plan_id',
        'used_count',
        'user_id',
    ];

    protected $casts = [
        'datetime_from' => 'datetime',
        'datetime_to' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
