<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\UserResource;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ApiResponse;

    public function user(Request $request)
    {
        // dd($request->user()->toArray());
        $user = $request->user();

        if(!$user) {
            return $this->error('Authenticated but user not identified', null, 404);
        }

        return $this->success('Authenticated and user identified', UserResource::make($user), 200);
    }
}
