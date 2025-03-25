<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentGatewayWebhookLog extends Model
{
    protected $fillable = [
        'original_json',
        'status',
    ];

    protected $casts = [
        'original_json' => 'json',
    ];
}
