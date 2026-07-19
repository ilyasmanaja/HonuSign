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

        // Soal 1: Susun Huruf (SIBI) - DISESUAIKAN DENGAN NAMA KOLOM UTAMA
        Quiz::create([
            'materi_id' => 1,
            'tipe' => 'susun_huruf',
            'pertanyaan' => 'Siapakah tokoh yang menggunakan pakaian Riau?',
            'jawaban_benar' => 'SAMSUL',
            'pilihan_data' => json_encode('samsul_teluk_belangga.png') // Gunakan pilihan_data untuk menyimpan nama gambar tokoh
        ]);

        // Soal 2: Puzzle (9 Bagian)
        Quiz::create([
            'materi_id' => 1,
            'tipe' => 'puzzle',
            'pertanyaan' => 'Susun potongan gambar ini menjadi utuh!',
            'jawaban_benar' => 'kelas.png',
        ]);

        // Soal 3: Susun Kalimat
        Quiz::create([
            'materi_id' => 1,
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
            'materi_id' => 1,
            'tipe' => 'eja_kata',
            'pertanyaan' => 'Lagu satu nusa,satu bangsa diciptakan oleh...',
            'jawaban_benar' => 'LMANIK',
            'pilihan_data' => json_encode(['LMANIK', 'MANIK']),
        ]);

        // Soal Cerita 2 (Bantu/Tolong)
        Quiz::create([
            'materi_id' => 1,
            'tipe' => 'eja_kata',
            'pertanyaan' => 'Saat siti terjatuh apa yang dilakukan oleh Udin....',
            'jawaban_benar' => 'MEMBANTU',
            'pilihan_data' => json_encode(['TOLONG', 'MENOLONG', 'BANTU', 'MEMBANTU']),
        ]);

        // Soal Cerita 3 (Melayu)
        Quiz::create([
            'materi_id' => 1,
            'tipe' => 'eja_kata',
            'pertanyaan' => 'Samsul berasal dari suku….',
            'jawaban_benar' => 'MELAYU',
            'pilihan_data' => json_encode(['MELAYU']),
        ]);

        // Soal Cerita 4 (Berkumpul)
        Quiz::create([
            'materi_id' => 1,
            'tipe' => 'eja_kata',
            'pertanyaan' => 'Selesai Paduan suara apa yang dilakukan oleh made, samsul dan udin serta teman-temannya yang lain di lapangan…',
            'jawaban_benar' => 'BERKUMPUL',
            'pilihan_data' => json_encode(['BERKUMPUL', 'KUMPUL']),
        ]);

        // Soal Cerita 5 (Pekanbaru)
        Quiz::create([
            'materi_id' => 1,
            'tipe' => 'eja_kata',
            'pertanyaan' => 'Di manakah lokasi sekolah made, samsul, dan udin...',
            'jawaban_benar' => 'PEKANBARU',
            'pilihan_data' => json_encode(['PEKANBARU']),
        ]);

        Quiz::create([
            'materi_id' => 1,
            'tipe' => 'pilah_perilaku',
            'pertanyaan' => 'Tarik dan kelompokkan setiap perilaku di bawah ini ke kotak yang benar!',
            'jawaban_benar' => 'COMPLETED',
            'pilihan_data' => json_encode([
                ['id' => 1, 'judul' => 'Amir mengikuti upacara dengan khidmat', 'gambar' => 'upacara_bendera.png', 'color' => '#D4F1BE', 'positif' => true],
                ['id' => 2, 'judul' => 'Abdul mencoret-coret dinding kelas', 'gambar' => 'coret_tembok.png', 'color' => '#FFB3B3', 'positif' => false],
                ['id' => 3, 'judul' => 'Okta membuang sampah pada tempatnya', 'gambar' => 'okta_sampah.png', 'color' => '#D4F1BE', 'positif' => true],
                ['id' => 4, 'judul' => 'Ariva membuang sampah di Sungai', 'gambar' => 'buang_sampah.png', 'color' => '#FFB3B3', 'positif' => false],
                ['id' => 5, 'judul' => 'Okta berbicara keras saat teman beribadah', 'gambar' => 'bicara_solat.png', 'color' => '#FFB3B3', 'positif' => false],
                ['id' => 6, 'judul' => 'Sisca melaksanakan piket dengan sungguh', 'gambar' => 'siska_piket.png', 'color' => '#D4F1BE', 'positif' => true],
            ])
        ]);
    }
}