<?php

namespace App\Http\ApiRequests;

use App\ApiResponse\ApiFormRequest;
use App\Models\Article;
use Illuminate\Contracts\Validation\ValidationRule;

class UpdateArticleApiRequest extends ApiFormRequest
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
        return Article::rules([
            'title' => 'required|string|min:3|max:70',
            'slug' => 'nullable|string|min:3|max:70|unique:articles,slug,' . $this->id,
            'image' => 'nullable|image|mimes:png,jpg,webp,jpeg,gif,svg,bmp,avif|max:2048',
        ]);
    }
}
