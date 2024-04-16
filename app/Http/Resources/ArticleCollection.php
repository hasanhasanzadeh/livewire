<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ArticleCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->map(function ($item) {
                return [
                    'title' => $item->title,
                    'slug' => $item->slug,
                    'content' => $item->content,
                    'author' => new AuthorResource($item->author),
                    'image_url' => $item->photo ? $item->photo->path : null,
                ];
            })
        ];
    }
}
