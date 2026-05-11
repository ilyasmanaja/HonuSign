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
        // Bikin 10 siswa dummy
        \App\Models\User::factory(10)->create([
            'role' => 'student',
        ]);

        // Bonus: Bikin 1 akun guru buat login kamu sendiri
        \App\Models\User::factory()->create([
            'name' => 'Pak Guru Han',
            'email' => 'guru@honusign.test',
            'password' => bcrypt('password'),
            'role' => 'teacher',
        ]);
    }
}