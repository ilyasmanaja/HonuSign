<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\UserProgress;
use Illuminate\Support\Facades\Auth;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {

    // 1. Dashboard Traffic Controller (Siswa vs Guru)
    Route::get('dashboard', function (Request $request) {
        if ($request->user()?->role === 'teacher') {
            return redirect()->route('teacher.dashboard');
        }
        return view('dashboard');
    })->name('dashboard');

    // 2. Dashboard Khusus Guru (Terproteksi Middleware 'teacher')
    Route::get('teacher/dashboard', function () {
        // 1. Ambil semua siswa
        // 2. Load relasi progress-nya (Eager Loading agar tidak berat)
        $students = \App\Models\User::where('role', 'student')
            ->with([
                'progress' => function ($query) {
                    $query->orderBy('materi_id')->orderBy('tahap');
                }
            ])->get();

        return view('teacher.dashboard', compact('students'));
    })->middleware(['auth', 'teacher'])->name('teacher.dashboard');

    Route::post('/materi/save-progress', function (Request $request) {
        $request->validate([
            'materi_id' => 'required|exists:materis,id',
            'tahap' => 'required|integer',
            'score' => 'required|numeric'
        ]);

        // updateOrCreate: Kalau datanya belum ada, dibuat baru. Kalau sudah ada, di-update.
        UserProgress::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'materi_id' => $request->materi_id,
                'tahap' => $request->tahap,
            ],
            [
                'score' => $request->score,
                'is_completed' => true
            ]
        );

        return response()->json(['message' => 'Nilai berhasil disimpan ke database!']);
    })->name('materi.save_progress');

    // --- FITUR MATERI (STUDY) ---

    // 3. Halaman Game: Klik Karakter ke Sekolah
    Route::get('materi', function () {
        return view('materi.study-page');
    })->name('materi.index');

    // 4. Halaman Khusus Video Peragaan SIBI Tahap 1
    Route::get('materi/tahap1/video', function () {
        $materi = \App\Models\Materi::orderBy('order', 'asc')->first();
        if (!$materi) return redirect()->route('dashboard');
        return view('materi.tahap1video', compact('materi'));
    })->name('materi.tahap1.video');

    // 5. Halaman Pembelajaran Linear (Linear Progression)
    // Parameter diubah menjadi null agar Tahap 3 bisa mendeteksi nilai kosong
    Route::get('materi/belajar/{step}/{soal_ke?}', function ($step, $soal_ke = null) {

        // 1. Ambil materi utama menggunakan urutan (order) terbaru
        $materi = \App\Models\Materi::orderBy('order', 'asc')->first();

        if (!$materi) {
            return redirect()->route('dashboard');
        }

        // --- LOGIKA TAHAP 1 (Membaca Cerita) ---
        if ($step == 1) {
            return view('materi.tahap1', compact('materi', 'step'));
        }

        // --- LOGIKA TAHAP 2 (Menjawab 3 Jenis Kuis) ---
        if ($step == 2) {
            $nomor_soal = $soal_ke ?? 1;

            // FIX: Batasi kueri hanya mengambil tipe soal khusus milik Tahap 2 saja
            $quiz = \App\Models\Quiz::whereIn('tipe', ['susun_huruf', 'puzzle', 'susun_kalimat'])
                ->orderBy('id')
                ->skip($nomor_soal - 1)
                ->first();

            // Jika ke-3 soal Tahap 2 sudah habis, lempar otomatis ke Tahap 3!
            if (!$quiz) {
                return redirect()->route('materi.belajar', ['step' => 3]);
            }

            return view('materi.tahap2', [
                'materi' => $materi,
                'step' => $step,
                'quiz' => $quiz,
                'soal_ke' => $nomor_soal
            ]);
        }

        // --- LOGIKA TAHAP 3 (Diskusi & Kamera) ---
        if ($step == 3) {
            // Jika belum ada parameter soal_ke, tampilkan halaman BACA materi dulu
            if (!$soal_ke) {
                return view('materi.tahap3_baca', compact('materi', 'step'));
            }

            // FIX: Ubah pencarian tipe dari 'isyarat_kamera' menjadi 'eja_kata' sesuai isi seeder baru
            $quiz = \App\Models\Quiz::where('tipe', 'eja_kata')
                ->orderBy('id')
                ->skip($soal_ke - 1)
                ->first();

            // Jika ke-5 soal cerita eja kata sudah habis, lanjut ke Tahap 4!
            if (!$quiz) {
                return redirect()->route('materi.belajar', ['step' => 4]);
            }

            return view('materi.tahap3_kamera', compact('materi', 'step', 'quiz', 'soal_ke'));
        }

        if ($step == 4) {
            return view('materi.tahap4', compact('materi', 'step'));
        }

        if ($step == 5) {
            return view('materi.tahap5', compact('materi', 'step'));
        }

        if ($step == 6) {
            return view('materi.tahap6', compact('materi', 'step'));
        }

        return "Tahap $step sedang dalam pembangunan!";
    })->name('materi.belajar');

    Route::get('evaluasi', function () {
        return view('evaluasi.index');
    })->middleware(['auth', 'verified'])->name('evaluasi.index');

    // 5. Placeholder untuk rute yang lain
    Route::get('materi/quiz', fn() => "Halaman Quiz Segera Hadir")->name('materi.quiz');

    Route::get('general', function () {
        return view('general.index');
    })->name('general.index');

    Route::get('general/puzzle', function () {
        return view('general.puzzle');
    })->name('general.puzzle');

    Route::get('general/puzzle_instrument', function () {
        return view('general.puzzle_instrument');
    })->name('general.puzzle_instrument');

    Route::get('general/memory', function () {
        return view('general.memory');
    })->name('general.memory');

    Route::post('/logout', function (Illuminate\Http\Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    })->name('logout');
});

require __DIR__ . '/settings.php';
