<?php

use App\Models\Materi;
use App\Models\Quiz;
use App\Models\User;
use App\Models\UserProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Mapel;
use App\Http\Controllers\MateriManagementController;
use App\Http\Controllers\AiPracticeController;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {

    // 1. Dashboard Traffic Controller (Siswa vs Guru)
    Route::get('dashboard', function (Request $request) {
        if ($request->user()?->role === 'teacher') {
            return redirect()->route('teacher.dashboard');
        }
        return redirect()->route('mapel.index');
    })->name('dashboard');

    // 2. Rute Guru Umum (Tanpa Prefix Mapel)
    Route::middleware(['teacher'])->prefix('teacher')->name('teacher.')->group(function () {
        Route::get('/dashboard', function () {
            $mapels = \App\Models\Mapel::all();
            return view('teacher.dashboard', compact('mapels'));
        })->name('dashboard');
    });

    // 3. Rute Guru Spesifik Mapel (dashboardDaftar Materi & Wizard Input)
    Route::middleware(['teacher'])->prefix('teacher/mapel/{mapel_slug}')->name('teacher.materi.')->group(function () {
        // Halaman list materi yang ada di mapel ini
        Route::get('/', [MateriManagementController::class, 'index'])->name('index');

        // Step 1: Buat Materi Baru
        Route::get('/materi/create', [MateriManagementController::class, 'create'])->name('create');
        Route::post('/materi/store', [MateriManagementController::class, 'store'])->name('store');

        // Wizard Step 2 - 6
        Route::get('/materi/{materi_slug}/edit-step/{step}', [MateriManagementController::class, 'editStep'])->name('edit.step');
        Route::post('/materi/{materi_slug}/save-step/{step}', [MateriManagementController::class, 'saveStep'])->name('save.step');

        Route::get('/monitoring', [MateriManagementController::class, 'monitoring'])->name('monitoring');
    });

    Route::post('/materi/save-progress', function (Request $request) {
        $request->validate([
            'materi_id' => 'required|exists:materis,id',
            'tahap' => 'required|integer',
            'score' => 'required|numeric',
            'answers' => 'nullable|array',
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
                'answers' => $request->answers,
                'is_completed' => true,
            ]
        );

        return response()->json(['message' => 'Nilai berhasil disimpan ke database!']);
    })->name('materi.save_progress');

    Route::post('materi/reset-progress', function () {
        UserProgress::where('user_id', auth()->id())->delete();

        return response()->json(['message' => 'Progress berhasil direset!']);
    })->name('materi.reset_progress');

    // --- FITUR MATERI (STUDY) ---

    // 1. Halaman Pilih Mata Pelajaran (Menu Awal)
    Route::get('/pilih-mapel', function () {
        // Ambil data mapel
        $mapels = Mapel::all();

        // Kirim data ke view 'pilih-mapel'
        return view('pilih-mapel', compact('mapels'));
    })->name('mapel.index');

    Route::get('dashboard/mapel/{mapel_slug}', function ($mapel_slug) {
        // Cari mapel berdasarkan slug
        $mapel = Mapel::where('slug', $mapel_slug)->firstOrFail();

        // Buka halaman dashboard.blade.php sambil membawa data mapel
        return view('dashboard', compact('mapel'));
    })->name('dashboard.mapel');

    // 2. Halaman Game: Klik Karakter ke Sekolah (Sekarang butuh mapel_slug)
    Route::get('materi/{mapel_slug}', function ($mapel_slug) {
        $mapel = \App\Models\Mapel::where('slug', $mapel_slug)->firstOrFail();
        return view('materi.study-page', compact('mapel'));
    })->name('materi.index');

    // 3. Halaman Khusus Video Peragaan SIBI Tahap 1
    Route::get('materi/{mapel_slug}/tahap1/video', function ($mapel_slug) {
        $mapel = \App\Models\Mapel::where('slug', $mapel_slug)->firstOrFail();

        // Ambil materi berdasarkan mapel_id
        $materi = Materi::where('mapel_id', $mapel->id)->orderBy('order', 'asc')->first();

        if (!$materi) {
            return redirect()->route('mapel.index')->with('error', 'Materi belum tersedia.');
        }

        return view('materi.tahap1.tahap1video', compact('materi', 'mapel'));
    })->name('materi.tahap1.video');

    // 4. Halaman Pembelajaran Linear (Linear Progression RADEC)
    Route::get('materi/{mapel_slug}/belajar/{step}/{soal_ke?}', function ($mapel_slug, $step, $soal_ke = null) {

        // Cari mapel
        $mapel = \App\Models\Mapel::where('slug', $mapel_slug)->firstOrFail();

        // Cari materi utama milik mapel ini
        $materi = Materi::where('mapel_id', $mapel->id)->orderBy('order', 'asc')->first();

        if (!$materi) {
            return redirect()->route('mapel.index');
        }

        // --- LOGIKA TAHAP 1 (Membaca Cerita) ---
        if ($step == 1) {
            return view('materi.tahap1.tahap1', compact('materi', 'step', 'mapel'));
        }

        // --- LOGIKA TAHAP 2 (Menjawab 3 Jenis Kuis) ---
        if ($step == 2) {
            $nomor_soal = $soal_ke ?? 1;

            if ($nomor_soal > 3) {
                return redirect()->route('materi.belajar', ['mapel_slug' => $mapel->slug, 'step' => 3]);
            }

            return view("materi.tahap2.soal{$nomor_soal}", [
                'materi' => $materi,
                'mapel' => $mapel,
                'step' => $step,
                'soal_ke' => $nomor_soal,
            ]);
        }

        // --- LOGIKA TAHAP 3 (Diskusi & Kamera) ---
        if ($step == 3) {
            if (!$soal_ke) {
                return view('materi.tahap3.tahap3_baca', compact('materi', 'step', 'mapel'));
            }

            $quiz = Quiz::where('tipe', 'eja_kata')
                ->orderBy('id')
                ->skip($soal_ke - 1)
                ->first();

            if (!$quiz) {
                return redirect()->route('materi.belajar', ['mapel_slug' => $mapel->slug, 'step' => 4]);
            }

            return view('materi.tahap3.tahap3_kamera', compact('materi', 'step', 'mapel', 'quiz', 'soal_ke'));
        }

        if ($step == 4) {
            return view('materi.tahap4.tahap4', compact('materi', 'step', 'mapel'));
        }

        if ($step == 5) {
            return view('materi.tahap5.tahap5', compact('materi', 'step', 'mapel'));
        }

        if ($step == 6) {
            return view('materi.tahap6.tahap6', compact('materi', 'step', 'mapel'));
        }

        return "Tahap $step sedang dalam pembangunan!";
    })->name('materi.belajar');

    Route::get('evaluasi', function () {
        return redirect()->route('evaluasi.soal', ['soal' => 1]);
    })->middleware(['auth', 'verified'])->name('evaluasi.index');

    Route::get('evaluasi/{soal}', function ($soal) {
        if ($soal < 1 || $soal > 10) {
            return redirect()->route('evaluasi.soal', ['soal' => 1]);
        }

        return view("evaluasi.soal{$soal}", compact('soal'));
    })->middleware(['auth', 'verified'])->name('evaluasi.soal');

    // 5. Placeholder untuk rute yang lain
    Route::get('materi/quiz', fn() => 'Halaman Quiz Segera Hadir')->name('materi.quiz');

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

    Route::get('/mapel/{mapel_slug}/ai', [AiPracticeController::class, 'index'])->name('ai.index');
    Route::get('/mapel/{mapel_slug}/ai/kamera/{kata}', [AiPracticeController::class, 'kamera'])->name('ai.kamera');

    Route::post('/logout', function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    })->name('logout');
});

require __DIR__ . '/settings.php';
