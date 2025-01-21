<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'level',
        'name',
        'price',
        'desc',
        'is_active',
        'is_available',
        'is_stackable',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_available' => 'boolean',
        'is_stackable' => 'boolean',
    ];

    // relationships
    public function planItems()
    {
        return $this->hasMany(PlanItem::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    // Mutator and accessor for price
    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value / 100, // Convert cents to dollars
            set: fn ($value) => $value * 100, // Convert dollars to cents
        );
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getStripeProductId()
    {
        return $this->external_ref_id;
    }

    /**
     * Get the base discount percentage for the plan.
     */
    public function getBaseDiscountPercent(): int
    {
        return $this->base_discount_percent;
    }

    /**
     * Get monthly discount voucher details.
     */
    public function getMonthlyDiscountVoucherDetails(): ?array
    {
        if (!$this->is_monthly_discount_voucher) {
            return null;
        }

        return [
            'count' => $this->monthly_discount_voucher_count,
            'percent' => $this->monthly_discount_voucher_percent,
        ];
    }

    /**
     * Get monthly free item details.
     */
    public function getMonthlyFreeItemDetails(): ?array
    {
        if (!$this->is_monthly_free_item) {
            return null;
        }

        return [
            'count' => $this->monthly_free_item_count,
            'label' => $this->monthly_free_item_label,
            'ref_id' => $this->monthly_free_item_ref_id,
        ];
    }

    /**
     * Check if discounts or benefits are stackable with other offers.
     */
    public function isStackable(): bool
    {
        return $this->is_stackable;
    }

    /**
     * Apply base discount to a given price.
     */
    public function applyBaseDiscount(float $price): float
    {
        return $price - ($price * ($this->base_discount_percent / 100));
    }
}
