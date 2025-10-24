<?php

namespace Modules\Users\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider {
    public function register(): void {
    }

    public function boot(): void {
        Route::middleware('api')
            ->prefix('api')
            ->group(__DIR__ . "/../routes/api.php");
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }
}
