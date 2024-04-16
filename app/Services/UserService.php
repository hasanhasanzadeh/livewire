<?php

namespace App\Services;


use App\Base\ServiceResult;
use App\Base\ServiceWrapper;
use App\Models\User;

class UserService
{

    public function addUser(array $data): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($data) {
            $user = User::create($data);
            $token = $user->createToken('create-token')->plainTextToken;
            return ['token' => $token];
        }, transaction: true);
    }

    public function updateProfile(array $data): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($data) {
            $user = User::with('avatar')->findOrFail(auth()->user()->id);
            $user->update($data);
            if ($data['avatar']) {
                $user->avatar() ? $user->avatar()->delete() : null;
                $path = str_replace('public', 'storage', $data['avatar']->store('public/avatars'));
                $user->avatar()->create(['original_name' => $path, 'path' => $path]);
            }
            return $user;
        }, transaction: true);
    }

    public function getProfile(): ServiceResult
    {
        return app(ServiceWrapper::class)(function () {
            return User::with('avatar')->findOrFail(auth()->user()->id);
        }, transaction: false);
    }

    public function getToken(array $data): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($data) {
            $user = User::whereEmail($data['email'])->first();
            if (!password_verify($data['password'], $user->password)) {
                return false;
            }
            $token = $user->createToken('create-token')->plainTextToken;
            return ['token' => $token];

        }, transaction: false);
    }

}
