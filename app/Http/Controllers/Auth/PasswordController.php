<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    /**
     * Update the user's PIN (stored as a hashed password).
     */
    public function update(Request $request): RedirectResponse
    {
        // dd($request->all());
        $request->merge([
            'current_password' => implode('', $request->current_pin),
            'password' => implode('', $request->new_pin),
            'password_confirmation' => implode('', $request->new_pin_confirmation),
        ]);
        $validated = $request->validate([
            'current_password' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    if (!Hash::check($value, $request->user()->password)) {
                        $fail('The current PIN is incorrect.');
                    }
                },
            ],
            'password' => ['required', 'digits:6', 'confirmed'],
        ]);

        // Hash the new PIN and update the user's password field
        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'PIN updated successfully!');
    }
}
