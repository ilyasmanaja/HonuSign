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

    // 4. Halaman Pembelajaran Linear (Step-by-Step)
    Route::get('materi/belajar/{step}', function ($step) {
        // Ambil materi berdasarkan kategori 'kalimat'
        $materi = \App\Models\Materi::where('kategori', 'kalimat')
            ->orderBy('id')
            ->skip(0) // Untuk sementara kita ambil materi pertama terus sebagai contoh
            ->first();

        if (!$materi)
            return redirect()->route('dashboard');

        // Cek step berapa, lalu arahkan ke file masing-masing
        if ($step == 1) {
            return view('materi.tahap1', compact('materi', 'step'));
        } elseif ($step == 2) {
            return view('materi.tahap2', compact('materi', 'step'));
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