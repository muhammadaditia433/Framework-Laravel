<?php

namespace App\Models;

class Author
{
    // Data array statis (struktur sesuai tabel authors: id, name, photo, bio)
    public static function all(): array
    {
        return [
            ['id' => 1, 'name' => 'Andrea Hirata',          'photo' => 'andrea-hirata.jpg',  'bio' => 'Novelis Indonesia, penulis tetralogi Laskar Pelangi.'],
            ['id' => 2, 'name' => 'Pramoedya Ananta Toer',  'photo' => 'pramoedya.jpg',      'bio' => 'Sastrawan Indonesia, penulis Tetralogi Buru.'],
            ['id' => 3, 'name' => 'Tere Liye',              'photo' => 'tere-liye.jpg',      'bio' => 'Penulis produktif novel populer Indonesia.'],
            ['id' => 4, 'name' => 'Dee Lestari',            'photo' => 'dee-lestari.jpg',    'bio' => 'Penulis dan penyanyi, pencipta seri Supernova.'],
            ['id' => 5, 'name' => 'Robert C. Martin',       'photo' => 'robert-martin.jpg',  'bio' => 'Software engineer, penulis Clean Code.'],
        ];
    }

    public static function find(int $id): ?array
    {
        foreach (self::all() as $author) {
            if ($author['id'] === $id) {
                return $author;
            }
        }
        return null;
    }
}
