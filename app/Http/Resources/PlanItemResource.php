<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlanItemResource extends JsonResource
{
    /**
     * The user context for the plan item.
     *
     * @var \App\Models\User|null
     */
    private ?\App\Models\User $user = null;

    /**
     * Inject the user context into the resource.
     */
    public function withUser($user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'cycle' => $this->cycle,
            'datetime_from' => $this->datetime_from ? $this->datetime_from->toDateTimeString() : null,
            'datetime_to' => $this->datetime_to ? $this->datetime_to->toDateTimeString() : null,
            'frequency' => $this->frequency,
            'is_base' => $this->is_base,
            'max_count' => $this->max_count,
            'name' => $this->name,
            'plan' => PlanResource::make($this->whenLoaded('plan')),
            'plan_id' => $this->plan_id,
            'product_codes_json' => $this->product_codes_json,
            'promo_type' => $this->promo_type,
            'promo_value' => $this->promo_value,
        ];
    }
}
