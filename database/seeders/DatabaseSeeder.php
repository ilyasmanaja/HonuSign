<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Raihan',
            'email' => 'raihan@honusign.com',
            'password' => bcrypt('password'),
            'role' => 'student',
        ]);

        User::factory()->create([
            'name' => 'Zidan',
            'email' => 'zidan@honusign.com',
            'password' => bcrypt('password'),
            'role' => 'student',
        ]);

        User::factory()->create([
            'name' => 'Mitra',
            'email' => 'mitra@honusign.com',
            'password' => bcrypt('password'),
            'role' => 'student',
        ]);

        User::factory()->create([
            'name' => 'Nikma',
            'email' => 'nikma@honusign.com',
            'password' => bcrypt('password'),
            'role' => 'student',
        ]);

        // Bonus: Bikin 1 akun guru buat login kamu sendiri
        User::factory()->create([
            'name' => 'Ningrum',
            'email' => 'ningrum@honusign.com',
            'password' => bcrypt('password'),
            'role' => 'teacher',
        ]);

        $this->call([
            MapelSeeder::class,
            MateriSeeder::class,
            QuizSeeder::class,
        ]);
    }
}
