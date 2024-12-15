<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
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
            'abbreviation' => $this->abbreviation,
            'currency_name' => $this->currency_name,
            'currency_exponent' => $this->currency_exponent,
            'currency_symbol' => $this->currency_symbol,
            'is_active' => $this->is_active,
            'is_currency_exponent_hidden' => $this->is_currency_exponent_hidden,
            'is_default' => $this->is_default,
            'phone_code' => $this->phone_code,
            'timezone' => $this->timezone,
        ];
    }
}
