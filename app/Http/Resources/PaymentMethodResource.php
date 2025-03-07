<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentMethodResource extends JsonResource
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
            'attachment' => AttachmentResource::make($this->whenLoaded('attachment')),
            'name' => $this->name,
            'slug' => $this->slug,
            'created_at' => $this->created_at,
        ];
    }
}
