<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Materi;
use App\Models\MateriImage;
use App\Models\Quiz;
use Illuminate\Http\Request;

class AdminMateriController extends Controller
{
    // Halaman form input materi
    public function create() {
        return view('admin.materi.create');
    }

    // Proses simpan semua data (Materi, Kuis, Gambar)
    public function store(Request $request) {
        // 1. Simpan Konten Materi Utama
        $materi = Materi::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'deskripsi_tambahan' => $request->deskripsi_tambahan,
        ]);

        // 2. Jika ada video (Tahap 1, 3, 4, 6)
        if ($request->hasFile('video_peragaan')) {
            $vidName = time() . '_' . $request->file('video_peragaan')->getClientOriginalName();
            $request->file('video_peragaan')->move(public_path('videos'), $vidName);
            $materi->update(['video_peragaan' => $vidName]);
        }

        // 3. Simpan Kuis (Dinamis dari Input Repeater)
        // Kita asumsikan input kuis dikirim sebagai array di request
        if ($request->has('quizzes')) {
            foreach ($request->quizzes as $quizData) {
                Quiz::create([
                    'materi_id' => $materi->id,
                    'tipe' => $quizData['tipe'], // misal: 'pilah_perilaku'
                    'pertanyaan' => $quizData['pertanyaan'],
                    'jawaban_benar' => $quizData['jawaban_benar'],
                    'pilihan_data' => json_encode($quizData['data']) // Data JSON
                ]);
            }
        }

        return redirect()->route('admin.materi.index')->with('success', 'Materi berhasil dibuat!');
    }
}