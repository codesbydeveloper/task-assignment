<?php

use App\Http\Controllers\Api\Admin\AdminApiController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SystemController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('me', [AuthController::class, 'me']);
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    });
});

Route::middleware(['auth:sanctum', 'throttle:60,1'])->group(function () {
    Route::get('profile', [UserController::class, 'showProfile']);
    Route::put('profile', [UserController::class, 'updateProfile']);

    Route::get('users', [UserController::class, 'index'])->middleware('role:admin');
    Route::put('users/{user}', [UserController::class, 'update'])->middleware('role:admin');
    Route::post('users/{user}/activate', [UserController::class, 'activate'])->middleware('role:admin');
    Route::post('users/{user}/deactivate', [UserController::class, 'deactivate'])->middleware('role:admin');

    Route::get('system/health', [SystemController::class, 'health']);
    Route::get('system/version', [SystemController::class, 'version']);
    Route::get('system/rate-limit', [SystemController::class, 'rateLimit']);

    Route::middleware(['role:admin', 'admin.ip'])->prefix('admin')->group(function () {
        Route::get('dashboard', [AdminApiController::class, 'dashboard']);
        Route::get('logs', [AdminApiController::class, 'logs']);
        Route::get('cron-status', [AdminApiController::class, 'cronStatus']);
        Route::get('queue-status', [AdminApiController::class, 'queueStatus']);
    });
});
