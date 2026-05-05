<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Soal 1: Susun Huruf (SIBI)
        \App\Models\Quiz::create([
            'tipe' => 'susun_huruf',
            'pertanyaan' => 'Siapakah tokoh yang menggunakan pakaian teluk belanga?',
            'jawaban_benar' => 'SAMSUL',
        ]);

        // Soal 2: Puzzle (9 Bagian)
        \App\Models\Quiz::create([
            'tipe' => 'puzzle',
            'pertanyaan' => 'Susun potongan gambar ini menjadi utuh!',
            'jawaban_benar' => 'kelas.png', // Nama file gambar asli
        ]);

        // Soal 3: Susun Kalimat
        \App\Models\Quiz::create([
            'tipe' => 'susun_kalimat',
            'pertanyaan' => 'Susun kata-kata berikut menjadi kalimat yang benar!',
            'jawaban_benar' => 'Aku pergi ke Sekolah untuk belajar',
            'pilihan_data' => json_encode(['pergi', 'belajar', 'Aku', 'Sekolah', 'ke', 'untuk']), // Kata yang diacak
        ]);

        $soal_kamera = [
            ['tipe' => 'isyarat_kamera', 'pertanyaan' => 'Peragakan abjad ini di depan kamera!', 'jawaban_benar' => 'A'],
            ['tipe' => 'isyarat_kamera', 'pertanyaan' => 'Peragakan abjad ini di depan kamera!', 'jawaban_benar' => 'B'],
            ['tipe' => 'isyarat_kamera', 'pertanyaan' => 'Peragakan abjad ini di depan kamera!', 'jawaban_benar' => 'C'],
            ['tipe' => 'isyarat_kamera', 'pertanyaan' => 'Peragakan abjad ini di depan kamera!', 'jawaban_benar' => 'D'],
            ['tipe' => 'isyarat_kamera', 'pertanyaan' => 'Peragakan abjad ini di depan kamera!', 'jawaban_benar' => 'E'],
        ];

        foreach ($soal_kamera as $soal) {
            \App\Models\Quiz::create($soal);
        }
    }
}
