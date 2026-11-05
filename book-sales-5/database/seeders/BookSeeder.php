<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            ['title' => 'Laskar Pelangi', 'description' => 'Kisah sepuluh anak Belitung yang berjuang bersekolah di tengah keterbatasan.', 'price' => 89000, 'stock' => 25, 'cover_photo' => 'laskar-pelangi.jpg', 'genre_id' => 1, 'author_id' => 1],
            ['title' => 'Bumi Manusia', 'description' => 'Novel sejarah tentang Minke di masa kolonial Hindia Belanda.', 'price' => 120000, 'stock' => 15, 'cover_photo' => 'bumi-manusia.jpg', 'genre_id' => 5, 'author_id' => 2],
            ['title' => 'Hujan', 'description' => 'Cerita tentang persahabatan dan cinta di dunia masa depan.', 'price' => 99000, 'stock' => 30, 'cover_photo' => 'hujan.jpg', 'genre_id' => 1, 'author_id' => 3],
            ['title' => 'Supernova: Ksatria, Putri, dan Bintang Jatuh', 'description' => 'Pertemuan sains, cinta, dan spiritualitas dalam seri Supernova.', 'price' => 110000, 'stock' => 20, 'cover_photo' => 'supernova.jpg', 'genre_id' => 3, 'author_id' => 4],
            ['title' => 'Clean Code', 'description' => 'Panduan menulis kode yang rapi, mudah dibaca, dan mudah dirawat.', 'price' => 350000, 'stock' => 10, 'cover_photo' => 'clean-code.jpg', 'genre_id' => 4, 'author_id' => 5],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
