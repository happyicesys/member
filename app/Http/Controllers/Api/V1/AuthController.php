<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\UserLoginRequest;
use App\Http\Resources\Api\V1\UserResource;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class AuthController extends Controller
{
    use ApiResponse;

    public function login(UserLoginRequest $request)
    {
        $request->validated($request->all());

        if(!auth()->attempt($request->only('phone_number', 'password'))) {
            return $this->error('Invalid credentials', json_decode('{}'), 401);
        }

        $user = User::with(['phoneCountry', 'planItemUser.plan'])->where('phone_number', $request->phone_number)->first();

        $user->update([
            'login_count' => $user->login_count + 1
        ]);

        if($user->login_count == 1 and $request->vend_code) {
            $user->update([
                'vend_code' => $request->vend_code
            ]);
        }

        $user->tokens()->delete();

        // dd($user->toArray());
        return $this->success(
            'Authenticated',
            [
                'token' => $user->createToken($request->phone_number, ['*'], now()->addMinutes(30))->accessToken,
                'user' => UserResource::make($user)
            ],
            200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->success('Logged out', null, 200);
    }
}
