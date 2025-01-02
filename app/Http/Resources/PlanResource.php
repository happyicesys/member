<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'level' => $this->level,
            'price' => $this->price, // Price in dollars
            'description' => $this->desc,
            'is_active' => $this->is_active,
            'base_discount_percent' => $this->base_discount_percent,
            'is_stackable' => $this->is_stackable,
            'monthly_discount_voucher' => $this->when($this->is_monthly_discount_voucher, [
                'count' => $this->monthly_discount_voucher_count,
                'percent' => $this->monthly_discount_voucher_percent,
            ]),
            'monthly_free_item' => $this->when($this->is_monthly_free_item, [
                'count' => $this->monthly_free_item_count,
                'label' => $this->monthly_free_item_label,
                'ref_id' => $this->monthly_free_item_ref_id,
            ]),
            'external_ref_id' => $this->external_ref_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'users' => UserResource::collection($this->whenLoaded('users'))
        ];
    }
}
