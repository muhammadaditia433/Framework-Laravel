<?php

namespace App\Models;

class Genre
{
    // Data array statis (struktur sesuai tabel genres: id, name, description)
    public static function all(): array
    {
        return [
            ['id' => 1, 'name' => 'Fiksi',       'description' => 'Cerita rekaan yang lahir dari imajinasi penulis.'],
            ['id' => 2, 'name' => 'Non-Fiksi',   'description' => 'Buku berbasis fakta, pengetahuan, dan kejadian nyata.'],
            ['id' => 3, 'name' => 'Fantasi',     'description' => 'Cerita dengan dunia sihir, makhluk mitos, dan petualangan.'],
            ['id' => 4, 'name' => 'Teknologi',   'description' => 'Buku seputar pemrograman, komputer, dan inovasi digital.'],
            ['id' => 5, 'name' => 'Sejarah',     'description' => 'Catatan dan analisis peristiwa masa lalu.'],
        ];
    }

    public static function find(int $id): ?array
    {
        foreach (self::all() as $genre) {
            if ($genre['id'] === $id) {
                return $genre;
            }
        }
        return null;
    }
}
