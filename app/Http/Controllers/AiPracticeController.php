<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mapel;

class AiPracticeController extends Controller
{
    public function index($mapel_slug)
    {
        $mapel = Mapel::where('slug', $mapel_slug)->firstOrFail();
        
        // Daftar Kamus Kata untuk Latihan AI
        // Kamu bisa menambahkan kata sebanyak-banyaknya di sini!
        $daftarKata = [
            ['kata' => 'AYAM', 'emoji' => '🐔', 'color' => '#FFF5B8'],
            ['kata' => 'BOLA', 'emoji' => '⚽', 'color' => '#BEE9E8'],
            ['kata' => 'KUCING', 'emoji' => '🐱', 'color' => '#FFD1E3'],
            ['kata' => 'RUMAH', 'emoji' => '🏠', 'color' => '#D4F1BE'],
            ['kata' => 'MOBIL', 'emoji' => '🚗', 'color' => '#E0BBE4'],
            ['kata' => 'BUKU', 'emoji' => '📚', 'color' => '#FFF5B8'],
            ['kata' => 'PISANG', 'emoji' => '🍌', 'color' => '#BEE9E8'],
            ['kata' => 'BUNGA', 'emoji' => '🌻', 'color' => '#FFD1E3'],
        ];

        return view('student.ai.index', compact('mapel', 'daftarKata'));
    }

    public function kamera($mapel_slug, $kata)
    {
        $mapel = Mapel::where('slug', $mapel_slug)->firstOrFail();
        
        // Pastikan kata selalu huruf besar dan tidak ada spasi agar AI mudah membacanya
        $word = strtoupper(trim($kata));

        return view('student.ai.kamera', compact('mapel', 'word'));
    }
}