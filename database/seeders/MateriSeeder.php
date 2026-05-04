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
        ];

        foreach ($kalimat as $k) {
            Materi::create($k);
        }
    }
}