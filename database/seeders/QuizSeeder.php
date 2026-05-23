<?php

namespace Database\Seeders;

use App\Models\Quiz;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ==========================================
        // SOAL BAWAAN (TAHAP 1 - 2)
        // ==========================================

        // Soal 1: Susun Huruf (SIBI)
        Quiz::create([
            'tipe' => 'susun_huruf',
            'pertanyaan' => 'Siapakah tokoh yang menggunakan pakaian teluk belanga?',
            'jawaban_benar' => 'SAMSUL',
        ]);

        // Soal 2: Puzzle (9 Bagian)
        Quiz::create([
            'tipe' => 'puzzle',
            'pertanyaan' => 'Susun potongan gambar ini menjadi utuh!',
            'jawaban_benar' => 'kelas.png',
        ]);

        // Soal 3: Susun Kalimat
        Quiz::create([
            'tipe' => 'susun_kalimat',
            'pertanyaan' => 'Susun kata-kata berikut menjadi kalimat yang benar!',
            'jawaban_benar' => 'Aku pergi ke Sekolah untuk belajar',
            'pilihan_data' => json_encode(['pergi', 'belajar', 'Aku', 'Sekolah', 'ke', 'untuk']),
        ]);

        // ==========================================
        // TAHAP 3: 5 SOAL CERITA BARU (MENGEJA LEWAT KAMERA AI)
        // ==========================================

        // Soal Cerita 1 (L.Manik)
        Quiz::create([
            'tipe' => 'eja_kata',
            'pertanyaan' => 'Lagu satu nusa,satu bangsa diciptakan oleh...',
            'jawaban_benar' => 'LMANIK',
            'pilihan_data' => json_encode(['LMANIK', 'MANIK']),
        ]);

        // Soal Cerita 2 (Bantu/Tolong)
        Quiz::create([
            'tipe' => 'eja_kata',
            'pertanyaan' => 'Saat siti terjatuh apa yang dilakukan oleh Udin....',
            'jawaban_benar' => 'MEMBANTU',
            'pilihan_data' => json_encode(['TOLONG', 'MENOLONG', 'BANTU', 'MEMBANTU']),
        ]);

        // Soal Cerita 3 (Melayu)
        Quiz::create([
            'tipe' => 'eja_kata',
            'pertanyaan' => 'Samsul berasal dari suku….',
            'jawaban_benar' => 'MELAYU',
            'pilihan_data' => json_encode(['MELAYU']),
        ]);

        // Soal Cerita 4 (Berkumpul)
        Quiz::create([
            'tipe' => 'eja_kata',
            'pertanyaan' => 'Selesai Paduan suara apa yang dilakukan oleh made, samsul dan udin serta teman-temannya yang lain di lapangan…',
            'jawaban_benar' => 'BERKUMPUL',
            'pilihan_data' => json_encode(['BERKUMPUL', 'KUMPUL']),
        ]);

        // Soal Cerita 5 (Pekanbaru)
        Quiz::create([
            'tipe' => 'eja_kata',
            'pertanyaan' => 'Di manakah lokasi sekolah made, samsul, dan udin...',
            'jawaban_benar' => 'PEKANBARU',
            'pilihan_data' => json_encode(['PEKANBARU']),
        ]);
    }
}
