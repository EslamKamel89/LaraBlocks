<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Laravel\Telescope\Telescope;

class TelescopeServiceProvider extends ServiceProvider {
    /**
     * Register services.
     */
    public function register(): void {
        Telescope::night();
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void {

        Gate::define('viewTelescope', function ($user = null) {
            return app()->environment('local');
        });
    }
}
