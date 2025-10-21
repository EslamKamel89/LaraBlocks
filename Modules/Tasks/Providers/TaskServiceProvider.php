<?php

namespace Modules\Tasks\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class TaskServiceProvider extends ServiceProvider {
    public function register(): void {
    }

    public function boot(): void {
        Route::middleware('api')
            ->prefix('api/v1')
            ->group(__DIR__ . '/../routes/api.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }
}
