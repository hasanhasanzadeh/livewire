<?php

namespace App\Http\Controllers\Api;

use App\ApiResponse\ApiExceptionResult;
use App\Http\ApiRequests\ArticleApiRequest;
use App\Http\ApiRequests\UpdateArticleApiRequest;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Repositories\ArticleRepository;
use Illuminate\Http\JsonResponse;

class ArticleController extends Controller
{
    public function __construct(
        private readonly ArticleRepository $articleRepository
    )
    {
    }

    public function index()
    {
        $result = $this->articleRepository->getAll();
        return app(ApiExceptionResult::class)(result: $result);
    }


    public function store(ArticleApiRequest $request)
    {
        $result = $this->articleRepository->store($request->validated());
        return app(ApiExceptionResult::class)(result: $result, status: 201);
    }

    public function show(Article $article)
    {
        $result = $this->articleRepository->getById($article->id);
        return app(ApiExceptionResult::class)(result: $result);
    }

    public function update(UpdateArticleApiRequest $request, Article $article): JsonResponse
    {
        $result = $this->articleRepository->update($article->id, $request->validated());
        return app(ApiExceptionResult::class)(result: $result, msg: 'success update article');
    }

    public function destroy(Article $article)
    {
        $result = $this->articleRepository->delete($article->id);
        return app(ApiExceptionResult::class)(result: $result, msg: 'success delete article', status: 204);
    }
}
