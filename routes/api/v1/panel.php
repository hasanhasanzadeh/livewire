<?php

use App\Http\Controllers\Api\ArticleController;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->middleware('auth:sanctum')->group(function ($route) {
    $route->apiResource('articles', ArticleController::class);
});
