<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserVoucher extends Model
{
    // what should be recorded?
    // get creation from sys
    // 1. paid plan user with reccuring monthly voucher
    // 2. voucher creation based on gold plan, newly converted, all users, upon sign up

    const STATUS_ACTIVE = '1';
    const STATUS_REDEEMED = '2';
    const STATUS_EXPIRED = '98';

    const STATUS_MAPPINGS = [
        self::STATUS_ACTIVE => 'active',
        self::STATUS_REDEEMED => 'redeemed',
        self::STATUS_EXPIRED => 'expired',
    ];

    protected $table = 'user_vouchers';

    protected $fillable = [
        'date_from',
        'date_to',
        'is_redeemable',
        'is_redeemed',
        'qty',
        'redeemed_at',
        'ref_voucher_id',
        'ref_voucher_code',
        'status',
        'used_count',
        'user_id',
    ];

    protected $casts = [
        'date_from' => 'datetime',
        'date_to' => 'datetime',
        'is_redeemable' => 'boolean',
        'is_redeemed' => 'boolean',
        'qty' => 'integer',
        'redeemed_at' => 'datetime',
        'status' => 'string',
        'used_count' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function balanceQty(): int
    {
        return max(0, $this->qty - $this->used_count);
    }


}
