<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Materi;

class MateriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kalimat = [
            [
                'judul' => 'Halo, Apa Kabar?',
                'slug' => 'halo-apa-kabar',
                'kategori' => 'kalimat',
                'deskripsi' => 'Gabungan gerakan salam (halo) dan menanyakan kondisi (apa kabar).'
            ],
            [
                'judul' => 'Senang Bertemu Kamu',
                'slug' => 'senang-bertemu-kamu',
                'kategori' => 'kalimat',
                'deskripsi' => 'Ekspresi ramah saat bertemu teman baru.'
            ],
            [
                'judul' => 'Ayo Belajar Bersama',
                'slug' => 'ayo-belajar-bersama',
                'kategori' => 'kalimat',
                'deskripsi' => 'Kalimat ajakan untuk meningkatkan semangat belajar.'
            ],
        ];

        foreach ($kalimat as $k) {
            Materi::create($k);
        }
    }
}