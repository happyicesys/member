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
            'base' => $this->getBasePlanItem($request->user()),
            'planItems' => PlanItemResource::collection(
                $this->planItems->where('is_base', false)
            )->each->withUser($request->user()),
        ];
    }

    /**
     * Get the base plan item (is_base = true).
     */
    private function getBasePlanItem($user): ?array
    {
        $basePlanItem = $this->planItems->where('is_base', true)->first();

        if ($basePlanItem) {
            return (new PlanItemResource($basePlanItem))->withUser($user)->resolve();
        }

        return null;
    }
}
