<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AdditionalAuthor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdditionalAuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $names = [
            'Rafi Ramadhan',
            'Dewi Lestari',
            'Bagus Pratama',
            'Nadia Putri',
            'Fajar Nugroho',
            'Siti Aisyah',
        ];

        foreach ($names as $name) {
            AdditionalAuthor::firstOrCreate([
                'name' => $name,
            ]);
        }
    }
}
