<?php

namespace Modules\Tasks\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Livewire;
use Modules\Tasks\Livewire\Index;
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
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'tasks');
        Livewire::component('tasks.index', Index::class);
        Gate::policy(Task::class, TaskPolicy::class);
    }
}
