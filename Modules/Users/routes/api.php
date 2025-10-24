<?php

use Illuminate\Support\Facades\Route;
use Modules\Users\Http\Controllers\UserController;

Route::prefix('v1')->name('api.v1.')->group(function () {
    Route::resource('users', UserController::class)->only(['show']);
});
