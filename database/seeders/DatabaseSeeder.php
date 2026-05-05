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
        // 1. Membuat akun test agar kamu bisa login
        User::factory()->create([
            'name' => 'Siswa HonuSign',
            'email' => 'siswa@example.com',
            // Default password dari factory Laravel biasanya adalah 'password'
        ]);

        // 2. Memanggil seeder materi dan kuis yang sudah kita buat
        // Urutannya penting: Materi dulu, baru Quiz (jika quiz butuh relasi ke materi nantinya)
        $this->call([
            MateriSeeder::class,
            QuizSeeder::class,
        ]);
    }
}