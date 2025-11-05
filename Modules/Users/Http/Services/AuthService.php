<?php

namespace Modules\Users\Http\Services;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AuthService {
    public function login(string $email, string $password, bool  $remember): bool {
        if (Auth::attempt([
            'email' => $email,
            'password' => $password
        ], $remember)) {
            request()->session()->regenerate();
            return true;
            // return  redirect()->route('tasks.index');
        }
        return false;
        // return back()->withErrors([
        //     'email' => 'The provided credentials do not match our records.',
        // ])->onlyInput('email');
    }
    public function register(array $data) {
        $user = User::create($data);
        Auth::login($user);
        request()->session()->regenerate();
    }
    public function logout(): void {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();
    }
}
