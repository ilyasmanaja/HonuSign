<?php

namespace Database\Seeders;

use App\Models\Materi;
use App\Models\MateriImage;
use Illuminate\Database\Seeder;

class MateriSeeder extends Seeder
{
    public function run(): void
    {

        // Cari ID PPKn secara otomatis
        $mapel_ppkn = \App\Models\Mapel::where('slug', 'ppkn')->first();

        // 1. Buat Data Materi Utama
        $materi_cerita = Materi::create([
            'mapel_id' => $mapel_ppkn->id, // <- Gunakan ID PPKn
            'order' => 1,
            'judul' => 'Festival Budaya Kemerdekaan Indonesia',
            'slug' => 'festival-budaya-kemerdekaan-indonesia',
            'video_peragaan' => null,
            'deskripsi' => '<p class="text-justify">Di kelas 4 SLB Insan Mutiara Pekanbaru, Samsul dan teman-temannya mengikuti festival budaya Hari Kemerdekaan 17 Agustus. Sebelum festival, mereka bersama-sama membersihkan kelas.</p>',
            'deskripsi_tambahan' => '<p class="text-justify">Saat festival, mereka memakai baju adat yang berbeda-beda.</p>'
        ]);

        // 2. Masukkan Gambar Ilustrasi Utama (Yang besar di tengah)
        MateriImage::create([
            'materi_id' => $materi_cerita->id,
            'tipe' => 'ilustrasi_atas',
            'path' => 'kelas.png',
            'teks' => null,
            'urutan' => 1
        ]);

        MateriImage::create([
            'materi_id' => $materi_cerita->id,
            'tipe' => 'ilustrasi_tengah',
            'path' => 'pakaian_adat.png',
            'teks' => null,
            'urutan' => 2
        ]);

        MateriImage::create([
            'materi_id' => $materi_cerita->id,
            'tipe' => 'ilustrasi_bawah',
            'path' => 'penghargaan.png',
            'teks' => null,
            'urutan' => 3
        ]);

        // 3. Masukkan Data Storyboard 1: Membersihkan Kelas (Grid 3 Kartu)
        $cerita_1 = [
            ['path' => 'samsul_menyusun_kursi.png', 'teks' => 'Samsul menyusun kursi'],
            ['path' => 'abdul_mengelap_kaca.png', 'teks' => 'Abdul mengelap kaca'],
            ['path' => 'siti_menyapu.png', 'teks' => 'Siti menyapu'],
        ];

        foreach ($cerita_1 as $index => $item) {
            MateriImage::create([
                'materi_id' => $materi_cerita->id,
                'tipe' => 'cerita_1', // Penanda untuk baris grid pertama
                'path' => $item['path'],
                'teks' => $item['teks'],
                'urutan' => $index + 1,
            ]);
        }

        // 4. Masukkan Data Storyboard 2: Pakaian Adat (Grid 3 Kartu)
        $cerita_2 = [
            ['path' => 'samsul_teluk_belangga.png', 'teks' => 'Samsul memakai baju Riau'],
            ['path' => 'abdul_kanigaran.png', 'teks' => 'Abdul memakai baju Jawa'],
            ['path' => 'siti_bundo_kanduang.png', 'teks' => 'Siti memakai baju Minang'],
        ];

        foreach ($cerita_2 as $index => $item) {
            MateriImage::create([
                'materi_id' => $materi_cerita->id,
                'tipe' => 'cerita_2', // Penanda untuk baris grid kedua
                'path' => $item['path'],
                'teks' => $item['teks'],
                'urutan' => $index + 1,
            ]);
        }

        MateriImage::create([
            'materi_id' => $materi_cerita->id,
            'tipe' => 'paragraf_akhir',
            'path' => '', // Biarkan kosong karena ini cuma teks
            'teks' => '<p class="text-justify">Mereka berjalan bersama dengan semangat. Pada tanggal 17 Agustus, kelas 4 SLB Insan Mutiara menjadi juara kelas terbersih karena anak-anaknya rajin membersihkan kelas. Samsul dan teman-temannya merasa senang sekali.</p>',
            'urutan' => 1,
        ]);

        MateriImage::create([
            'materi_id' => 1,
            'tipe' => 'kartu_keberagaman',
            'path' => 'bahasa_daerah.png',
            'teks' => 'Bahasa Daerah',
            'urutan' => 1
        ]);
    }
}