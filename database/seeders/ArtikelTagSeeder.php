<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ArtikelTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $articleIds = \App\Models\Article::pluck('id')->toArray();
        $tagIds     = \App\Models\Tag::pluck('id')->toArray();

        $data = [];

        foreach ($articleIds as $articleId) {
            $randomTags = collect($tagIds)->random(rand(2, 4))->toArray();

            foreach ($randomTags as $tagId) {
                $data[] = [
                    'artikel_id' => $articleId,
                    'tag_id'     => $tagId,
                ];
            }
        }

        DB::table('artikel_tags')->insert($data);
    }
}
