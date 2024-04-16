<?php

namespace App\Http\ApiRequests;

use App\ApiResponse\ApiFormRequest;
use App\Models\Article;
use Illuminate\Contracts\Validation\ValidationRule;

class ArticleApiRequest extends ApiFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return Article::rules();
    }
}
