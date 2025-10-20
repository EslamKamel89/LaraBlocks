<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Domain\TaskController;
use App\Models\Domain\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1')->name('api.v1.')->group(function () {
    Route::get('/health', function () {
        return response()->json([
            'status' => 'ok',
            'time' => now()->toIso8601String(),
            'app' => config('app.name')
        ]);
    })->name('health');



    Route::post('auth/login', [AuthController::class, 'login'])
        ->middleware('throttle:10,1')
        ->name('auth.login');

    Route::apiResource('/tasks', TaskController::class)->only(['index', 'show']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user', [AuthController::class,  'me'])->name('me');
        Route::apiResource('/tasks', TaskController::class)->except(['index', 'show']);
    });
});
