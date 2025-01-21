<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VendTransactionItemResource extends JsonResource
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
            'amount' => $this->amount,
            'product_id' => $this->product_id,
            'product_name' => $this->product_name,
            'product_thumbnail_url' => $this->product_thumbnail_url,
            'promo_amount' => $this->promo_amount,
            'qty' => $this->qty,
            'vend_channel_code' => $this->vend_channel_code,
            'vend_channel_id' => $this->vend_channel_id,
            'vend_channel_error_code' => $this->vend_channel_error_code,
            'vend_channel_error_name' => $this->vend_channel_error_name,
            'vend_channel_error_id' => $this->vend_channel_error_id,
            'vend_transaction_id' => $this->vend_transaction_id,
            'vendTransaction' => new VendTransactionResource($this->whenLoaded('vendTransaction')),
            'created_at' => $this->created_at,
        ];
    }
}
