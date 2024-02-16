<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'admin master',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'pembeli',
            'email' => 'putra@gmail.com',
            'password' => Hash::make('putra'),
            'role' => 'pembeli',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'penyelenggara',
            'email' => 'putri@gmail.com',
            'password' => Hash::make('putri'),
            'role' => 'penyelenggara',
        ]);
    }
}