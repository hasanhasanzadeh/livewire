<?php

namespace App\Http\Controllers\Api\Auth;

use App\ApiResponse\ApiExceptionResult;
use App\Http\ApiRequests\LoginApiRequest;
use App\Http\ApiRequests\RegisterApiRequest;
use App\Http\ApiRequests\UpdateProfileApiRequest;
use App\Http\Controllers\Controller;
use App\Services\UserService;

class AuthController extends Controller
{
    public function __construct(private readonly UserService $userService)
    {
    }

    public function register(RegisterApiRequest $registerApiRequest)
    {
        $result = $this->userService->addUser($registerApiRequest->validated());
        $msg = 'create user successful';
        return app(ApiExceptionResult::class)(result: $result, msg: $msg, status: 201);
    }

    public function updateProfile(UpdateProfileApiRequest $updateProfileApiRequest)
    {
        $result = $this->userService->updateProfile($updateProfileApiRequest->validated());
        $msg = 'update user successful';
        return app(ApiExceptionResult::class)(result: $result, msg: $msg);
    }

    public function login(LoginApiRequest $loginApiRequest)
    {
        $result = $this->userService->getToken($loginApiRequest->validated());
        $msg = 'login successful';
        return app(ApiExceptionResult::class)(result: $result, msg: $msg);
    }

    public function profile()
    {
        $result = $this->userService->getProfile();
        return app(ApiExceptionResult::class)(result: $result);
    }
}
