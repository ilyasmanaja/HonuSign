<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {

    // 1. Dashboard Traffic Controller (Siswa vs Guru)
    Route::get('dashboard', function () {
        if (auth()->user()->role === 'teacher') {
            return redirect()->route('teacher.dashboard');
        }
        return view('dashboard');
    })->name('dashboard');

    // 2. Dashboard Khusus Guru (Terproteksi Middleware 'teacher')
    Route::get('teacher/dashboard', function () {
        return view('teacher.dashboard');
    })->middleware(['teacher'])->name('teacher.dashboard');

    // --- FITUR MATERI (STUDY) ---

    // 3. Halaman Game: Klik Karakter ke Sekolah
    Route::get('materi', function () {
        return view('materi.study-page');
    })->name('materi.index');

    // 4. Halaman Pembelajaran Linear (Mendukung Sub-Soal untuk Tahap 2)
    Route::get('materi/belajar/{step}/{soal_ke?}', function ($step, $soal_ke = 1) {
        // 1. Ambil materi utama (untuk Tahap 1)
        $materi = \App\Models\Materi::where('kategori', 'kalimat')
            ->orderBy('id')
            ->first();

        if (!$materi)
            return redirect()->route('dashboard');

        // --- LOGIKA TAHAP 1 ---
        if ($step == 1) {
            return view('materi.tahap1', compact('materi', 'step'));
        }

        // --- LOGIKA TAHAP 2 (3 Jenis Soal) ---
        if ($step == 2) {
            // Ambil soal dari database berdasarkan urutan (soal_ke)
            // skip($soal_ke - 1) akan mengambil soal ke-1, ke-2, atau ke-3
            $quiz = \App\Models\Quiz::orderBy('id')
                ->skip($soal_ke - 1)
                ->first();

            // Jika soal sudah habis, lanjut ke Tahap 3 (atau dashboard)
            if (!$quiz) {
                return redirect()->route('dashboard')->with('status', 'Misi Tahap 2 Selesai! Kamu Hebat!');
            }

            return view('materi.tahap2', compact('materi', 'step', 'quiz', 'soal_ke'));
        }

        return "Tahap $step sedang dalam pembangunan!";
    })->name('materi.belajar');

    // Halaman Detail Membaca (Video Player)
    Route::get('materi/membaca/{materi:slug}', function (\App\Models\Materi $materi) {
        return view('materi.show', compact('materi'));
    })->middleware(['auth', 'verified'])->name('materi.show');

    // 5. Placeholder untuk Quiz & Puzzle (Biar tidak error saat tombol diklik)
    Route::get('materi/quiz', fn() => "Halaman Quiz Segera Hadir")->name('materi.quiz');
    Route::get('materi/puzzle', fn() => "Halaman Puzzle Segera Hadir")->name('materi.puzzle');

});

require __DIR__ . '/settings.php';