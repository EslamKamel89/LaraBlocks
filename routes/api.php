<?php

use App\Http\Controllers\Api\Domain\TaskController;
use App\Models\Domain\Task;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1')->name('api.v1.')->group(function () {
    Route::get('/health', function () {
        return response()->json([
            'status' => 'ok',
            'time' => now()->toIso8601String(),
            'app' => config('app.name')
        ]);
    })->name('health');



    Route::post('auth/login', function (Request $request) {
        /** @var User $user */
        $user = User::where('email', $request->email ?? '')->firstOrFail();
        if (!Hash::check($request->password, $user->password)) {
            throw new AuthenticationException('The email or password or not correct');
        }
        $user->token = $user->createToken($user->email)->plainTextToken;
        return $user;
    })->name('auth.login');

    Route::apiResource('/tasks', TaskController::class)->only(['index', 'show']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user', function (Request $request) {
            return $request->user();
        })->name('me');
        Route::apiResource('/tasks', TaskController::class)->except(['index', 'show']);
    });
});
