<?php

use App\ApiResponse\Facades\ApiResponse;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (NotFoundHttpException $e, $request) {
            if ($request->is('api/*')) {
                return ApiResponse::withMsg([$e->getMessage()])->withStatus(404)->build()->response();
            }
        });
        $exceptions->render(function (AuthenticationException $e, $request) {
            if ($request->is('api/*')) {
                return ApiResponse::withMsg([$e->getMessage()])->withStatus(401)->build()->response();
            }
        });
        $exceptions->render(function (Exception $e, $request) {
            return ApiResponse::withMsg([$e->getMessage()])->withStatus(500)->build()->response();
        });
    })->create();
