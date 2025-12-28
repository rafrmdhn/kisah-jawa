<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;
use App\Models\AdditionalAuthor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ArticleAdditionalAuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authors = AdditionalAuthor::pluck('id')->all();

        if (count($authors) === 0) return;

        Article::query()
            ->inRandomOrder()
            ->take(30)
            ->get()
            ->each(function ($article) use ($authors) {
                $randomAuthorId = $authors[array_rand($authors)];

                $article->additional_authors()->syncWithoutDetaching([$randomAuthorId]);
            });
    }
}
