<?php

use App\Providers\TelescopeServiceProvider;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Modules\Tasks\Providers\TaskServiceProvider;
use Modules\Users\Providers\UserServiceProvider;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: [__DIR__ . '/../routes/web.php'],
        api: [__DIR__ . '/../routes/api.php'],
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(function (Request $request, \Throwable $e) {
            return $request->is('api/*') || $request->expectsJson();
        });
    })
    ->withProviders([
        TelescopeServiceProvider::class,
        TaskServiceProvider::class,
        UserServiceProvider::class,
    ])
    ->create();
