<?php

use App\Http\Controllers\Api\Domain\TaskController;
use App\Models\Domain\Task;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/health', function () {
    return response()->json([
        'status' => 'ok',
        'time' => now()->toIso8601String(),
        'app' => config('app.name')
    ]);
});


Route::post('auth/login', function (Request $request) {
    /** @var User $user */
    $user = User::where('email', $request->email ?? '')->firstOrFail();
    if (!Hash::check($request->password, $user->password)) {
        throw new AuthenticationException('The email or password or not correct');
    }
    $user->token = $user->createToken($user->email)->plainTextToken;
    return $user;
});

Route::apiResource('/tasks', TaskController::class)->only(['index', 'show']);
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/tasks', TaskController::class)->except(['index', 'show']);
});
