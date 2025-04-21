<?php

namespace App\Services\V1\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Prewk\Result\Ok;
use Prewk\Result\Err;


use Prewk\Result;

class AuthService
{
    public function userRegister(array $request): ok
    {
        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'role_id' => $request['role_id'] ?? null,
            'password' => Hash::make($request['password']),
        ]);

        return new ok([
            'message' => 'User successfully registered.'
        ]);
    }

    public function userLogin(array $request): Result
    {
        if (!Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            return new Err([
                'code' => 'unauthorized',
                'message' => 'Unauthorized.',
                'status' => 401,
            ]);
        }

        $user = Auth::user();

        if (!$user->is_active) {
            return new Err([
                'code' => 'unauthorized',
                'message' => 'Your account is deactivated. Please contact support.',
                'status' => 403,
            ]);
        }

        $tokenResult = $user->createToken('Devisers');
        $token = $tokenResult->accessToken;
        $expiresAt = Carbon::now()->addHours(2);

        return new Ok([
            'message' => 'User successfully logged in.',
            'token' => $token,
            'expires_at' => $expiresAt,
            'token_type' => 'Bearer',
        ]);
    }
}
