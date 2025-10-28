<?php

namespace Modules\Tasks\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Modules\Tasks\Models\Task;
use Modules\Tasks\Policies\TaskPolicy;

class TaskServiceProvider extends ServiceProvider {
    public function register(): void {
    }

    public function boot(): void {
        Route::middleware('api')
            ->prefix('api')
            ->group(__DIR__ . '/../routes/api.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        Gate::policy(Task::class, TaskPolicy::class);
    }
}
