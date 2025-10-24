<?php

use App\Http\Controllers\Api\Auth\AuthController;
use Modules\Tasks\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Tasks\Http\Controllers\Api\TaskController;

Route::prefix('v1')->name('api.v1.')->group(function () {
    Route::apiResource('/tasks', TaskController::class)->only(['index', 'show']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('/tasks', TaskController::class)->except(['index', 'show']);
    });
});
