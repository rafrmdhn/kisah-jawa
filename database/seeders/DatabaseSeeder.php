<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $categories = [
            ['name' => 'Kriminal', 'slug' => 'kriminal', 'status' => 1],
            ['name' => 'Misteri', 'slug' => 'misteri', 'status' => 1],
            ['name' => 'Film & Review', 'slug' => 'film-review', 'status' => 1],
            ['name' => 'Opini', 'slug' => 'opini', 'status' => 1],
            ['name' => 'Sejarah', 'slug' => 'sejarah', 'status' => 1],
        ];

        $tags = [
            ['name' => 'Fenomena Gaib', 'slug' => 'fenomena-gaib'],
            ['name' => 'Mitos dan Legenda', 'slug' => 'mitos-legenda'],
            ['name' => 'Urban Legend', 'slug' => 'urban-legend'],
            ['name' => 'Hantu', 'slug' => 'hantu'],
            ['name' => 'Kutukan', 'slug' => 'kutukan'],
            ['name' => 'Tempat Angker', 'slug' => 'tempat-angker'],
            ['name' => 'Paranormal', 'slug' => 'paranormal'],
            ['name' => 'True Crime', 'slug' => 'true-crime'],
            ['name' => 'Film Horror', 'slug' => 'film-horror'],
            ['name' => 'Review Film Horror', 'slug' => 'review-film-horror']
        ];

        // foreach ($categories as $category) {
        //     Category::create($category);
        // }

        // foreach ($tags as $tag) {
        //     Tag::create($tag);
        // }

        $this->call([
            AdSeeder::class,
        ]);

        // $this->call(ArtikelTagSeeder::class);
    }
}
