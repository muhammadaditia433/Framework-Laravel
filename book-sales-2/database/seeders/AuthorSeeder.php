<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    public function run(): void
    {
        $authors = [
            ['name' => 'Andrea Hirata',         'photo' => 'andrea-hirata.jpg', 'bio' => 'Novelis Indonesia, penulis tetralogi Laskar Pelangi.'],
            ['name' => 'Pramoedya Ananta Toer', 'photo' => 'pramoedya.jpg',     'bio' => 'Sastrawan Indonesia, penulis Tetralogi Buru.'],
            ['name' => 'Tere Liye',             'photo' => 'tere-liye.jpg',     'bio' => 'Penulis produktif novel populer Indonesia.'],
            ['name' => 'Dee Lestari',           'photo' => 'dee-lestari.jpg',   'bio' => 'Penulis dan penyanyi, pencipta seri Supernova.'],
            ['name' => 'Robert C. Martin',      'photo' => 'robert-martin.jpg', 'bio' => 'Software engineer, penulis Clean Code.'],
        ];

        foreach ($authors as $author) {
            Author::create($author);
        }
    }
}
