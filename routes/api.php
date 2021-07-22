<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SessionController;

Route::prefix('v1')->group(function () {
    Route::group([
        'middleware' => 'api',
        'prefix' => 'auth'
    ], function () {
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login'])->name('login');
    });

    Route::group([
        'middleware' => 'auth.jwt',
    ], function () {
        Route::resource('session', SessionController::class);
    });
});
