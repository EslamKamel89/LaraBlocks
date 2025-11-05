<?php

namespace Modules\Users\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Livewire;
use Modules\Users\Livewire\Login;
use Modules\Users\Livewire\Register;

class UserServiceProvider extends ServiceProvider {
    public function register(): void {
    }

    public function boot(): void {
        Route::middleware('api')
            ->prefix('api')
            ->group(__DIR__ . "/../routes/api.php");
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadViewsFrom(__DIR__ . '/../resources/views/', 'users');
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        Livewire::component('users.login', Login::class);
        Livewire::component('users.register', Register::class);
    }
}
