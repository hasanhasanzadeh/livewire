<?php

namespace App\ApiResponse;

use App\ApiResponse\Facades\ApiResponse;

class ApiExceptionResult
{
    public function __invoke($result, string $msg = null, int $status = 200)
    {
        if ($result->ok) {
            return ApiResponse::withMsg([$msg])
                ->withStatus($status)
                ->withData($result->data)
                ->build()
                ->response();
        }
        return ApiResponse::withMsg(['Server Error !'])
            ->withStatus(500)
            ->build()
            ->response();
    }
}
