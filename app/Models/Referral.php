<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    protected $fillable = [
        'user_id',
        'code',
        'referral_user_id',
        'is_active',
        'is_welcome_used',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_welcome_used' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function referralUser()
    {
        return $this->belongsTo(User::class, 'referral_user_id');
    }
}
