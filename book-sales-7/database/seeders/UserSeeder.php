<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'Admin',
            'email'    => 'admin@example.com',
            'password' => Hash::make('password123'),
            'role'     => 'admin',
        ]);

        User::create([
            'name'     => 'Customer Satu',
            'email'    => 'customer@example.com',
            'password' => Hash::make('password123'),
            'role'     => 'customer',
        ]);

        User::create([
            'name'     => 'Customer Dua',
            'email'    => 'customer2@example.com',
            'password' => Hash::make('password123'),
            'role'     => 'customer',
        ]);
    }
}
