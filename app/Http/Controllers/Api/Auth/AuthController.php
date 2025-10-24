<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Hash;
use Modules\Users\Http\Resources\UserSafeResource;

class AuthController extends Controller {
    public function login(LoginRequest $request) {
        $validated = $request->validated();
        /** @var User $user */
        $user = User::where('email', $validated['email'] ?? '')->firstOrFail();
        if (!Hash::check($validated['password'], $user->password)) {
            throw new AuthenticationException('The email or password or not correct');
        }
        $token = $user->createToken($user->email)->plainTextToken;
        return [
            'token' => $token,
            'user' => UserSafeResource::make($user)
        ];
    }
    public function me(Request $request) {
        return UserSafeResource::make($request->user());
    }
}
