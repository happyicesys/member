<?php

namespace App\Models;

use App\Models\Plan;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class PlanItemUser extends Model
{
    const NOTIFICATION_BEFORE_DAYS = 14;

    protected $fillable = [
        'datetime_from',
        'datetime_to',
        'is_active',
        'is_grace_period',
        'plan_id',
        'scheduled_downgrade_plan_id',
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

    public function scheduledDowngradePlan()
    {
        return $this->belongsTo(Plan::class, 'scheduled_downgrade_plan_id');
    }

    public function scopeExpiringSoon($query)
    {
        return $query->where('datetime_to', '<', Carbon::now()->addDays(Plan::GRACE_PERIOD_DAYS));
    }

    public function scopeExpired($query)
    {
        return $query->where('datetime_to', '<', Carbon::now());
    }
}
