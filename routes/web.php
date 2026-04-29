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

    // 3. Halaman Pilihan (Transit): Membaca, Quiz, Puzzle
    Route::get('materi', function () {
        return view('materi.study-page');
    })->name('materi.index');

    // 4. Halaman Membaca (Menampilkan Daftar Kalimat)
    Route::get('materi/membaca', function () {
        // Kita ambil data materi yang kategorinya 'kalimat' saja
        $semuaMateri = \App\Models\Materi::where('kategori', 'kalimat')->get();
        return view('materi.membaca', compact('semuaMateri'));
    })->name('materi.membaca');
    
    // Halaman Detail Membaca (Video Player)
    Route::get('materi/membaca/{materi:slug}', function (\App\Models\Materi $materi) {
        return view('materi.show', compact('materi'));
    })->middleware(['auth', 'verified'])->name('materi.show');

    // 5. Placeholder untuk Quiz & Puzzle (Biar tidak error saat tombol diklik)
    Route::get('materi/quiz', fn() => "Halaman Quiz Segera Hadir")->name('materi.quiz');
    Route::get('materi/puzzle', fn() => "Halaman Puzzle Segera Hadir")->name('materi.puzzle');

});

require __DIR__ . '/settings.php';