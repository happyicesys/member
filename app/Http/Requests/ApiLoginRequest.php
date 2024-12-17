<?php

namespace App\Http\Requests;

use App\Models\Country;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class ApiLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $country = Country::find($this->country_id);

        if (!$country) {
            throw ValidationException::withMessages([
                'country_id' => 'Invalid country selected.',
            ]);
        }

        return [
            'country_id' => 'required|integer|exists:countries,id',
            'phone_number' => [
                'required',
                'string',
                'phone:' . $country->abbreviation,
                // Add custom validation rule to check if the phone number exists in the specified country
                function ($attribute, $value, $fail) use ($country) {
                    $user = User::where('phone_number', $value)
                        ->where('phone_country_id', $country->id)
                        ->first();

                    if (!$user) {
                        $fail('The phone number hasn\'t been registered');
                    }
                },
            ],
            'passwordParts.*' => 'required|digits:1',
            'remember' => 'boolean',
        ];
    }
}
