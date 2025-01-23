<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class VendTransaction extends Model
{
    protected $fillable = [
        'apk_ver',
        'datetime',
        'firmware_ver',
        'total_amount',
        'customer_id',
        'customer_name',
        'payment_method_id',
        'payment_method_name',
        'ref_order_id',
        'ref_transaction_id',
        'total_promo_amount',
        'total_qty',
        'user_id',
        'vend_code',
        'vend_id',
        'vend_prefix_id',
        'vend_prefix_name',
    ];

    protected $casts = [
        'datetime' => 'datetime',
        'total_amount' => 'integer',
        'total_promo_amount' => 'integer',
    ];

    // relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vendTransactionItems()
    {
        return $this->hasMany(VendTransactionItem::class);
    }


    // Mutator and accessor for price
    protected function totalAmount(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value / 100, // Convert cents to dollars
            // set: fn ($value) => $value * 100, // Convert dollars to cents
        );
    }

    protected function totalPromoAmount(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value / 100, // Convert cents to dollars
            // set: fn ($value) => $value * 100, // Convert dollars to cents
        );
    }
}
