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
            'is_available' => $this->is_available,
            'is_stackable' => $this->is_stackable,
            'base' => [
                'promo_type' => 'percent',
                'promo_value' => 30,
                'max_count' => null,
                'used_count' => 0,
                'datetime_from' => '2025-01-01 00:00:00',
                'datetime_to' => '2025-02-01 00:00:00',
            ]
        ];
    }
}
