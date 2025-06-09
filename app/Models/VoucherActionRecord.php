<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VoucherActionRecord extends Model
{
    protected $fillable = [
        'action',
        'dcvend_qty_per_member',
        'is_dcvend',
        'is_recurring',
        'valid_duration',
        'valid_unit',
        'voucher_json'
    ];

    protected $casts = [
        'dcvend_qty_per_member' => 'integer',
        'is_dcvend' => 'boolean',
        'is_recurring' => 'boolean',
        'valid_duration' => 'integer',
        'valid_unit' => 'string',
        'voucher_json' => 'json'
    ];
}
