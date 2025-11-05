<?php

use Illuminate\Support\Facades\Route;
use Modules\Users\Livewire\Login;
use Modules\Users\Livewire\Register;

Route::middleware(['web'])
    ->group(function () {
        Route::get('/login', function () {
            return redirect()->route('users.login');
        })->name('login');
        Route::get('/auth/login', Login::class)->name('users.login');
        Route::get('/auth/register', Register::class)->name('users.register');
    });
