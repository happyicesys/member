<?php

namespace App\Http\Resources\Api\V1;

use App\Http\Resources\Api\V1\CountryResource;
use App\Http\Resources\PlanResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'phoneCountry' => CountryResource::make($this->whenLoaded('phoneCountry')),
            'phone_number' => $this->phone_number,
        ];
    }
}
