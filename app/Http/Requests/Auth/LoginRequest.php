<?php

namespace App\Http\Requests\Auth;

use App\Models\Country;
use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
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

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        if (! Auth::attempt([
            'phone_number' => $this->phone_number,
            'password' => $this->password,
        ], $this->remember)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'phone_number' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'phone_number' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('phone_number')).'|'.$this->ip());
    }
}
