<?php

namespace App\Http\Resources\Api\V1;

use App\Http\Resources\Api\V1\CountryResource;
use App\Http\Resources\PlanResource;
use App\Services\VoucherService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    protected $voucherService;

    public function __construct()
    {
        parent::__construct(...func_get_args());
        $this->voucherService = new VoucherService();
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
            'name' => $this->name,
            'phoneCountry' => CountryResource::make($this->whenLoaded('phoneCountry')),
            'phone_number' => $this->phone_number,
            'plan' => $this->when($this->relationLoaded('planItemUser'), function() {
                $plan = $this->planItemUser->plan;
                $planItemBase = $plan->planItems()->where('is_base', true)->first();
                $data = [
                    'id' => $plan->id,
                    'name' => $plan->name,
                    'level' => $plan->level,
                    'price' => $plan->price,
                    'description' => $plan->desc,
                    'is_active' => $plan->is_active,
                    'is_available' => $plan->is_available,
                    'is_stackable' => $plan->is_stackable,
                    'base' => [
                        'id' => $planItemBase->id,
                        'name' => $planItemBase->name,
                        'promo_type' => $planItemBase->promo_type,
                        'promo_value' => $planItemBase->promo_value,
                        'is_base' => $planItemBase->is_base,
                        'max_count' => $planItemBase->max_count,
                        'used_count' => $this->planItemUser->used_count,
                        'datetime_from' => $this->planItemUser->datetime_from ? $this->planItemUser->datetime_from->toDatetimeString() : null,
                        'datetime_to' => $this->planItemUser->datetime_to ? $this->planItemUser->datetime_to->toDatetimeString() : null,
                    ],
                    'planItems' => []
                ];
                return $data;
            }),
            'vouchers' => $this->voucherService->getVouchers($this->id),
        ];
    }
}
