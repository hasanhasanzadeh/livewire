<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Photo;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articles = Article::factory(20)->create();
        foreach ($articles as $article) {
            $article->photo()->save(Photo::factory()
                ->create([
                    'original_name' => 'articles/default-' . $article->id . '.png',
                    'path' => 'articles/default-' . $article->id . '.png',
                    'photoable_id' => $article->id,
                    'photoable_type' => Article::class
                ])
            );

        }
    }
}
