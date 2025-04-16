<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    protected $fillable = [
        'user_id',
        'code',
        'is_active',
        'is_welcome_used',
        'parent_id',
        'referral_user_id',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_welcome_used' => 'boolean',
    ];

    public function parent()
    {
        return $this->belongsTo(Referral::class, 'parent_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function referralUser()
    {
        return $this->belongsTo(User::class, 'referral_user_id');
    }
}
