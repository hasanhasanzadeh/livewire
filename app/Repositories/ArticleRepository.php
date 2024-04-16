<?php

namespace App\Repositories;


use App\Base\LiveWireServiceWrapper;
use App\Models\Article;

class ArticleRepository implements InterfaceRepository
{

    public function getAll(array $data = [])
    {
        return app(LiveWireServiceWrapper::class)(function () use ($data) {
            return Article::with('author')->get();
        }, transaction: false);
    }

    public function getById($id)
    {
        return app(LiveWireServiceWrapper::class)(function () use ($id) {
            return Article::with('author')->findOrFail($id);
        }, transaction: false);
    }

    public function delete($id)
    {
        return app(LiveWireServiceWrapper::class)(function () use ($id) {
            return Article::findOrFail($id)->delete();
        }, transaction: false);
    }

    public function store(array $data)
    {
        return app(LiveWireServiceWrapper::class)(function () use ($data) {
            $article = auth()->user()->articles()->create($data);
            if ($data['image']) {
                $path = str_replace('public', 'storage', $data['image']->store('public/articles'));
                $article->photo()->create(['original_name' => $path, 'path' => $path]);
            }
            return $article;
        }, transaction: true);
    }

    public function update($id, array $data)
    {
        return app(LiveWireServiceWrapper::class)(function () use ($data, $id) {
            $article = Article::findOrFail($id);
            $article->update($data);
            if ($data['image']) {
                $article->photo()->delete();
                $path = str_replace('public', 'storage', $data['image']->store('public/articles'));
                $article->photo()->create(['original_name' => $path, 'path' => $path]);
            }
            return $article;
        }, transaction: true);
    }
}
