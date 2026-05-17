<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Quiz;

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

        // Soal Cerita 1 (LMANIK)
        Quiz::create([
            'tipe' => 'eja_kata',
            'pertanyaan' => "Di kelas inklusi, Made, Samsul, dan Udin bersama teman-temannya sedang mengikuti pelajaran seni musik. Mereka semua berdiri rapi menyanyikan lagu wajib nasional berjudul 'Satu Nusa Satu Bangsa' dengan penuh khidmat.\n\nPertanyaan: Lagu satu nusa, satu bangsa diciptakan oleh...",
            'jawaban_benar' => 'LMANIK',
        ]);

        // Soal Cerita 2 (MENOLONG)
        Quiz::create([
            'tipe' => 'eja_kata',
            'pertanyaan' => "Ketika bel istirahat berbunyi, anak-anak berlarian ke arah lapangan sekolah. Tiba-tiba Siti tersandung akar pohon dan terjatuh hingga lututnya terluka. Melihat hal itu, Udin yang berada di dekatnya langsung berlari menghampiri Siti.\n\nPertanyaan: Saat siti terjatuh apa yang dilakukan oleh Udin?",
            'jawaban_benar' => 'MEMBANTU',
        ]);

        // Soal Cerita 3 (MELAYU)
        Quiz::create([
            'tipe' => 'eja_kata',
            'pertanyaan' => "Saat hari kebudayaan tiba, setiap siswa mengenakan pakaian adat khas daerah masing-masing. Made memakai baju adat Bali, Udin memakai baju adat Jawa, sedangkan Samsul tampil gagah mengenakan baju kurung lengkap dengan kain samping songket.\n\nPertanyaan: Samsul berasal dari suku...",
            'jawaban_benar' => 'MELAYU',
        ]);

        // Soal Cerita 4 (BERKUMPUL)
        Quiz::create([
            'tipe' => 'eja_kata',
            'pertanyaan' => "Suara tepuk tangan menggema setelah kelompok paduan suara selesai menampilkan performa terbaik mereka. Setelah merapikan kembali ruang musik, Made, Samsul, Udin, serta teman-teman yang lain langsung menuju ke tengah lapangan terbuka.\n\nPertanyaan: Selesai Paduan suara apa yang dilakukan oleh made, samsul dan udin serta teman-temannya yang lain di lapangan?",
            'jawaban_benar' => 'BERKUMPUL',
        ]);

        // Soal Cerita 5 (DUMAI)
        Quiz::create([
            'tipe' => 'eja_kata',
            'pertanyaan' => "Sekolah tempat Made, Samsul, dan Udin belajar terletak di sebuah kota pelabuhan yang sangat strategis di Provinsi Riau. Kota ini terkenal sebagai salah satu kota industri minyak terbesar dan menghadap langsung ke Selat Malaka.\n\nPertanyaan: Di manakah lokasi sekolah made, samsul, dan udin?",
            'jawaban_benar' => 'DUMAI',
        ]);
    }
}