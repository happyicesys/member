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
        $planItemUser = $this->resource->planItemUsers()
            ->where('user_id', $this->user?->id)
            ->latest()
            ->first();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'promo_type' => $this->promo_type,
            'promo_value' => $this->promo_value,
            'is_base' => $this->is_base,
            'max_count' => $this->max_count,
            'used_count' => $planItemUser ? $planItemUser->used_count : 0,
            'datetime_from' => $planItemUser ? $planItemUser->datetime_from->toDateTimeString() : null,
            'datetime_to' => $planItemUser ? $planItemUser->datetime_to->toDateTimeString() : null,
        ];
    }
}
