<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VendTransactionResource extends JsonResource
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
            'apk_ver' => $this->apk_ver,
            'datetime' => $this->datetime,
            'firmware_ver' => $this->firmware_ver,
            'total_amount' => $this->total_amount,
            'customer_id' => $this->customer_id,
            'customer_name' => $this->customer_name,
            'payment_method_id' => $this->payment_method_id,
            'payment_method_name' => $this->payment_method_name,
            'ref_order_id' => $this->ref_order_id,
            'total_promo_amount' => $this->total_promo_amount,
            'total_qty' => $this->total_qty,
            'user_id' => $this->user_id,
            'user' => new UserResource($this->whenLoaded('user')),
            'vend_code' => $this->vend_code,
            'vend_id' => $this->vend_id,
            'vend_prefix_id' => $this->vend_prefix_id,
            'vend_prefix_name' => $this->vend_prefix_name,
            'vendTransactionItems' => VendTransactionItemResource::collection($this->whenLoaded('vendTransactionItems')),
            'created_at' => $this->created_at,
        ];
    }
}
