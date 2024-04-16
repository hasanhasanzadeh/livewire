<?php

namespace App\ApiResponse;

use App\ApiResponse\Facades\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ApiFormRequest extends FormRequest
{

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            ApiResponse::withMsg(collect($validator->errors()->all())->values()->toArray())->withStatus(422)->build()->response()
        );
    }

}

