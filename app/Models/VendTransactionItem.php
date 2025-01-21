<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class VendTransactionItem extends Model
{
    protected $fillable = [
        'product_id',
        'product_name',
        'product_thumbnail_url',
        'qty',
        'vend_channel_code',
        'vend_channel_id',
        'vend_channel_error_code',
        'vend_channel_error_name',
        'vend_channel_error_id',
        'vend_transaction_id',
    ];

    // relationships
    public function vendTransaction()
    {
        return $this->belongsTo(VendTransaction::class);
    }

    // Mutator and accessor
    protected function amount(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value / 100, // Convert cents to dollars
            set: fn ($value) => $value * 100, // Convert dollars to cents
        );
    }
}
