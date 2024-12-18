<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\UserLoginRequest;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use ApiResponse;

    public function login(UserLoginRequest $request)
    {
        $request->validated($request->all());

        if(!auth()->attempt($request->only('phone_number', 'password'))) {
            return $this->error('Invalid credentials', null, 401);
        }

        $user = User::where('phone_number', $request->phone_number)->first();

        // dd($user->toArray());
        return $this->success(
            'Authenticated',
            [
                'token' => $user->createToken($request->phone_number)->accessToken,
                'user' => $user
            ],
            200);
    }
}
