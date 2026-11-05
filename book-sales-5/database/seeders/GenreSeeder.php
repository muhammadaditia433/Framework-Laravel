<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        $genres = [
            ['name' => 'Fiksi',     'description' => 'Cerita rekaan yang lahir dari imajinasi penulis.'],
            ['name' => 'Non-Fiksi', 'description' => 'Buku berbasis fakta, pengetahuan, dan kejadian nyata.'],
            ['name' => 'Fantasi',   'description' => 'Cerita dengan dunia sihir, makhluk mitos, dan petualangan.'],
            ['name' => 'Teknologi', 'description' => 'Buku seputar pemrograman, komputer, dan inovasi digital.'],
            ['name' => 'Sejarah',   'description' => 'Catatan dan analisis peristiwa masa lalu.'],
        ];

        foreach ($genres as $genre) {
            Genre::create($genre);
        }
    }
}
