<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlanItemUserResource extends JsonResource
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
            'datetime_from' => $this->datetime_from ? $this->datetime_from->toDateTimeString() : null,
            'date_from' => $this->datetime_from ? $this->datetime_from->toDateString() : null,
            'datetime_to' => $this->datetime_to ? $this->datetime_to->toDateTimeString() : null,
            'date_to' => $this->datetime_to ? $this->datetime_to->toDateString() : null,
            'is_active' => $this->is_active,
            'is_grace_period' => $this->is_grace_period,
            'is_required_email_retention' => $this->is_required_email_retention,
            'is_email_retention_sent' => $this->is_email_retention_sent,
            'plan' => PlanResource::make($this->whenLoaded('plan')),
            'plan_id' => $this->plan_id,
            'scheduled_downgrade_plan_id' => $this->scheduled_downgrade_plan_id,
            'scheduledDowngradePlan' => PlanResource::make($this->whenLoaded('scheduledDowngradePlan')),
            'used_count' => $this->used_count,
            'user' => UserResource::make($this->whenLoaded('user')),
            'user_id' => $this->user_id,
        ];
    }
}
