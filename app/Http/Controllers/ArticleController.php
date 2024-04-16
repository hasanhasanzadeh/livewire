<?php

namespace App\Http\Controllers;

use App\Repositories\ArticleRepository;

class ArticleController extends Controller
{
    public function __construct(private readonly ArticleRepository $articleRepository)
    {
    }

    public function index()
    {
        $articles = $this->articleRepository->getAll();
        return view('front.articles', compact(['articles']));
    }
}
