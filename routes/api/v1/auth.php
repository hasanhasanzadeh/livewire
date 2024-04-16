<?php

use App\Http\Controllers\Api\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function ($route) {
    $route->post('login', [AuthController::class, 'login']);
    $route->post('register', [AuthController::class, 'register']);
    $route->get('profile', [AuthController::class, 'profile'])->middleware('auth:sanctum');
    $route->patch('profile/update', [AuthController::class, 'updateProfile'])->middleware('auth:sanctum');
});
