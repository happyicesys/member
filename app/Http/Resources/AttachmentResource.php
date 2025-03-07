<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttachmentResource extends JsonResource
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
            'created_at' => $this->created_at,
            'full_url' => $this->full_url,
            'is_active' => $this->is_active,
            'local_url' => $this->local_url,
            'name' => $this->name,
            'sequence' => $this->sequence,
            'type' => $this->type,
        ];
    }
}
