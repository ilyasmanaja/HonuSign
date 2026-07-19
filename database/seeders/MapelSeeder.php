<?php

namespace Database\Seeders;

use App\Models\Mapel;
use Illuminate\Database\Seeder;

class MapelSeeder extends Seeder
{
    public function run(): void
    {
        Mapel::create([
            'nama' => 'PPKn',
            'slug' => 'ppkn', // Ini contoh slug-nya
            'deskripsi' => 'Belajar tentang nilai-nilai Pancasila dan persatuan.',
            'icon' => 'mapel/pkn.jpeg' // Menggunakan gambar pkn.jpeg yang baru dipindahkan
        ]);

        Mapel::create([
            'nama' => 'Matematika',
            'slug' => 'matematika',
            'deskripsi' => 'Belajar angka, berhitung, dan logika dasar.',
            'icon' => 'mapel/mtk.jpeg' // Menggunakan gambar mtk.jpeg yang baru dipindahkan
        ]);

        Mapel::create([
            'nama' => 'Bahasa Indonesia',
            'slug' => 'bahasa-indonesia', // Spasi diubah jadi tanda hubung
            'deskripsi' => 'Belajar abjad, mengeja kata, dan membaca cerita.',
            'icon' => 'mapel/bindo.jpeg' // Menggunakan gambar bindo.jpeg yang baru dipindahkan
        ]);
    }
}