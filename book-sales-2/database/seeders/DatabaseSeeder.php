<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Urutan penting: Author dulu karena Book memiliki author_id.
        $this->call([
            AuthorSeeder::class,
            BookSeeder::class,
        ]);
    }
}
