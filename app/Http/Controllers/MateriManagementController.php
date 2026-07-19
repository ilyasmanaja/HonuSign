<?php
namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\Materi;
use App\Models\MateriImage;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;

class MateriManagementController extends Controller
{
    // Step 1: Form Tambah Materi Baru (Informasi Dasar & Video)
    public function create($mapel_slug)
    {
        $mapel = Mapel::where('slug', $mapel_slug)->firstOrFail();
        return view('teacher.materi.create', compact('mapel'));
    }

    // Simpan Step 1 & Redirect ke Wizard Step 2
    public function store(Request $request, $mapel_slug)
    {
        $mapel = Mapel::where('slug', $mapel_slug)->firstOrFail();

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'video_peragaan' => 'nullable|mimes:mp4,mov,avi|max:20480', // max 20MB
            'deskripsi' => 'nullable|string',
        ]);

        $videoPath = null;
        if ($request->hasFile('video_peragaan')) {
            $videoPath = $request->file('video_peragaan')->store('videos/materi', 'public');
        }

        $materi = Materi::create([
            'mapel_id' => $mapel->id,
            'judul' => $validated['judul'],
            'slug' => Str::slug($validated['judul']) . '-' . rand(100, 999),
            'video_peragaan' => $videoPath,
            'deskripsi' => $validated['deskripsi'], // HTML murni dari text editor
            'order' => Materi::where('mapel_id', $mapel->id)->count() + 1,
        ]);

        // Redirect ke Step 2 (Susun Huruf, Puzzle, Susun Kalimat)
        return redirect()->route('teacher.materi.edit.step', [
            'mapel_slug' => $mapel->slug,
            'materi_slug' => $materi->slug,
            'step' => 2
        ])->with('success', 'Materi berhasil dibuat! Lanjut ke pengisian kuis Tahap 2.');
    }

    // Mengarahkan ke View Form Step 2 sampai 6
    public function editStep($mapel_slug, $materi_slug, $step)
    {
        $mapel = Mapel::where('slug', $mapel_slug)->firstOrFail();
        $materi = Materi::with(['images', 'quizzes'])->where('slug', $materi_slug)->firstOrFail();

        // Mengarahkan file blade dinamis berdasarkan step (contoh: step2.blade.php)
        if (view()->exists("teacher.materi.steps.step{$step}")) {
            return view("teacher.materi.steps.step{$step}", compact('mapel', 'materi', 'step'));
        }

        abort(404);
    }

    public function index($mapel_slug)
    {
        // Cari mapel berdasarkan slug yang ada di URL
        $mapel = Mapel::where('slug', $mapel_slug)->firstOrFail();

        // Ambil semua materi yang berelasi dengan mapel ini
        $materis = Materi::where('mapel_id', $mapel->id)->orderBy('order', 'asc')->get();

        return view('teacher.materi.index', compact('mapel', 'materis'));
    }

    // Eksekusi penyimpanan data tiap Step (2-6)
    public function saveStep(Request $request, $mapel_slug, $materi_slug, $step)
    {
        $mapel = Mapel::where('slug', $mapel_slug)->firstOrFail();
        $materi = Materi::where('slug', $materi_slug)->firstOrFail();

        switch ($step) {
            case 2:
                $this->handleStep2($request, $materi);
                $nextStep = 3;
                break;
            case 3:
                $this->handleStep3($request, $materi);
                $nextStep = 4;
                break;
            case 4:
                $this->handleStep4($request, $materi);
                $nextStep = 5;
                break;
            case 5:
                $this->handleStep5($request, $materi);
                $nextStep = 6;
                break;
            case 6:
                $this->handleStep6($request, $materi);
                // KARENA INI TAHAP TERAKHIR, REDIRECT KE DAFTAR MATERI
                return redirect()->route('teacher.materi.index', ['mapel_slug' => $mapel->slug])
                    ->with('success', 'HORE! Seluruh tahap materi berhasil disimpan dengan sempurna! 🎉');
            default:
                return redirect()->back()->with('error', 'Tahap tidak valid.');
        }

        return redirect()->route('teacher.materi.edit.step', [
            'mapel_slug' => $mapel->slug,
            'materi_slug' => $materi->slug,
            'step' => $nextStep
        ])->with('success', "Tahap {$step} berhasil disimpan! Lanjut ke Tahap {$nextStep}.");
    }

    // Placeholder handler untuk tiap step (akan kita bedah satu per satu)
    private function handleStep2(Request $request, $materi)
    {
        // 1. Validasi Input Guru
        $request->validate([
            'susun_huruf_kata' => 'required|string',
            'susun_huruf_gambar' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'puzzle_gambar' => 'nullable|image|mimes:png,jpg,jpeg|max:5120', // Maks 5MB
            'susun_kalimat_jawaban' => 'required|string',
            'susun_kalimat_acak' => 'required|string', // Format input dipisah koma
        ]);

        // 2. Simpan Kuis 1: Susun Huruf
        $kuisSusunHuruf = Quiz::firstOrNew(['materi_id' => $materi->id, 'tipe' => 'susun_huruf']);
        $kuisSusunHuruf->pertanyaan = 'Susunlah huruf menjadi kata yang benar!';
        $kuisSusunHuruf->jawaban_benar = strtoupper(trim($request->susun_huruf_kata));

        // Menyimpan gambar tokoh ke pilihan_data (berbentuk array JSON)
        if ($request->hasFile('susun_huruf_gambar')) {
            $file = $request->file('susun_huruf_gambar');
            $filename = time() . '_tokoh.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/materi/tahap2'), $filename);

            $kuisSusunHuruf->pilihan_data = json_encode([$filename]);
        }
        $kuisSusunHuruf->save();


        // 3. Simpan Kuis 2: Puzzle 3x3
        $kuisPuzzle = Quiz::firstOrNew(['materi_id' => $materi->id, 'tipe' => 'puzzle_3x3']);
        $kuisPuzzle->pertanyaan = 'Susunlah potongan puzzle berikut!';
        $kuisPuzzle->pilihan_data = json_encode([]); // Kosongkan karena tidak dipakai di puzzle

        // Menyimpan gambar utuh langsung ke jawaban_benar
        if ($request->hasFile('puzzle_gambar')) {
            $file = $request->file('puzzle_gambar');
            $filename = time() . '_puzzle.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/materi/tahap2'), $filename);

            $kuisPuzzle->jawaban_benar = $filename;
        } elseif (!$kuisPuzzle->exists) {
            $kuisPuzzle->jawaban_benar = 'default_puzzle.png'; // Mencegah error jika lupa upload saat pertama kali buat
        }
        $kuisPuzzle->save();


        // 4. Simpan Kuis 3: Susun Kalimat
        $kuisKalimat = Quiz::firstOrNew(['materi_id' => $materi->id, 'tipe' => 'susun_kalimat']);
        $kuisKalimat->pertanyaan = 'Susunlah kata-kata berikut menjadi kalimat yang padu!';
        $kuisKalimat->jawaban_benar = strtoupper(trim($request->susun_kalimat_jawaban));

        // Memecah kata yang diinput guru (dipisah koma) menjadi array, lalu di-JSON-kan
        $kataAcak = array_map('trim', explode(',', $request->susun_kalimat_acak));
        $kuisKalimat->pilihan_data = json_encode($kataAcak);

        $kuisKalimat->save();
    }
    private function handleStep3(Request $request, $materi)
    {
        // 1. Validasi Input
        $request->validate([
            'deskripsi_tahap3' => 'nullable|string',
            'penutup_tahap3' => 'nullable|string',
            'pertanyaan_eja.*' => 'nullable|string',
            'target_eja_kata.*' => 'nullable|string|alpha',
            'cerita_tahap3_gambar.*' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        // 2. Simpan Deskripsi Awal & Penutup khusus Tahap 3
        $materi->images()->whereIn('tipe', ['deskripsi_tahap3', 'penutup_tahap3'])->delete();

        if ($request->filled('deskripsi_tahap3')) {
            $materi->images()->create([
                'path' => 'text_content',
                'tipe' => 'deskripsi_tahap3',
                'teks' => $request->deskripsi_tahap3,
                'urutan' => 0
            ]);
        }

        if ($request->filled('penutup_tahap3')) {
            $materi->images()->create([
                'path' => 'text_content',
                'tipe' => 'penutup_tahap3',
                'teks' => $request->penutup_tahap3,
                'urutan' => 0
            ]);
        }

        // 3. Simpan Kuis Kamera AI
        $materi->quizzes()->where('tipe', 'eja_kata')->delete();

        if ($request->has('target_eja_kata')) {
            foreach ($request->target_eja_kata as $index => $kata) {
                if (!empty($kata)) {
                    $materi->quizzes()->create([
                        'tipe' => 'eja_kata',
                        'pertanyaan' => $request->pertanyaan_eja[$index] ?? 'Silakan eja kata berikut menggunakan bahasa isyarat!',
                        'jawaban_benar' => strtoupper(trim($kata)),
                        'pilihan_data' => json_encode([]),
                    ]);
                }
            }
        }

        // 4. Simpan Storyboard Cerita Tahap 3
        if ($request->hasFile('cerita_tahap3_gambar')) {
            $materi->images()->where('tipe', 'cerita_tahap3')->delete();

            foreach ($request->file('cerita_tahap3_gambar') as $index => $file) {
                $filename = time() . '_tahap3_' . $index . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/materi/tahap3'), $filename);

                $materi->images()->create([
                    'path' => $filename,
                    'tipe' => 'cerita_tahap3',
                    'teks' => null,
                    'urutan' => $index + 1,
                ]);
            }
        }
    }

    private function handleStep4(Request $request, $materi)
    {
        // 1. Validasi Input termasuk deskripsi baru
        $request->validate([
            'deskripsi_tahap4' => 'nullable|string',
            'penutup_tahap4' => 'nullable|string',
            'kartu_gambar.*' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'kartu_teks.*' => 'nullable|string|max:100',
        ]);

        // 2. Simpan Deskripsi Awal & Penutup khusus Tahap 4 ke tabel materi_images
        $materi->images()->whereIn('tipe', ['deskripsi_tahap4', 'penutup_tahap4'])->delete();

        if ($request->filled('deskripsi_tahap4')) {
            $materi->images()->create([
                'path' => 'text_content', // placeholder string saja karena kolom path NOT NULL
                'tipe' => 'deskripsi_tahap4',
                'teks' => $request->deskripsi_tahap4,
                'urutan' => 0
            ]);
        }

        if ($request->filled('penutup_tahap4')) {
            $materi->images()->create([
                'path' => 'text_content',
                'tipe' => 'penutup_tahap4',
                'teks' => $request->penutup_tahap4,
                'urutan' => 0
            ]);
        }

        // 3. Simpan Data Kartu Keberagaman (9 Slot)
        if ($request->has('kartu_teks')) {
            $materi->images()->where('tipe', 'kartu_keberagaman')->delete();

            $gambarFiles = $request->file('kartu_gambar');
            $teksArray = $request->kartu_teks;

            foreach ($teksArray as $index => $teks) {
                if (!empty($teks) || (is_array($gambarFiles) && isset($gambarFiles[$index]))) {
                    $imagePath = null;

                    if (is_array($gambarFiles) && isset($gambarFiles[$index])) {
                        $file = $gambarFiles[$index];
                        $filename = time() . '_keberagaman_' . $index . '.' . $file->getClientOriginalExtension();
                        $file->move(public_path('images/materi/tahap4'), $filename);
                        $imagePath = $filename;
                    }

                    $materi->images()->create([
                        'path' => $imagePath ?? 'default_kartu.png',
                        'tipe' => 'kartu_keberagaman',
                        'teks' => $teks,
                        'urutan' => $index + 1,
                    ]);
                }
            }
        }
    }

    private function handleStep5(Request $request, $materi)
    {
        // 1. Validasi Input Guru
        $request->validate([
            'perilaku_teks.*' => 'nullable|string|max:100',
            'perilaku_gambar.*' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'perilaku_status.*' => 'nullable|in:1,0', // 1 untuk Positif, 0 untuk Negatif
        ]);

        // 2. Ambil Kuis yang sudah ada (untuk menjaga gambar lama jika tidak di-update)
        $kuisPerilaku = Quiz::firstOrNew(['materi_id' => $materi->id, 'tipe' => 'pilah_perilaku']);
        $kuisPerilaku->pertanyaan = 'Tarik dan kelompokkan setiap perilaku di bawah ini ke kotak yang benar!';
        $kuisPerilaku->jawaban_benar = 'JSON_DATA'; // Hanya penanda, validasi asli ada di JSON

        $existingData = [];
        if ($kuisPerilaku->exists && $kuisPerilaku->pilihan_data) {
            $existingData = json_decode($kuisPerilaku->pilihan_data, true) ?? [];
        }

        // 3. Proses Array JSON Perilaku
        $perilakuData = [];
        $teksArray = $request->perilaku_teks;
        $statusArray = $request->perilaku_status;
        $gambarFiles = $request->file('perilaku_gambar');

        if ($teksArray) {
            foreach ($teksArray as $index => $teks) {
                // Hanya simpan jika teks judul perilaku diisi
                if (!empty($teks)) {
                    $isPositif = isset($statusArray[$index]) && $statusArray[$index] == '1' ? true : false;
                    // Auto-assign warna: Hijau untuk Positif, Merah untuk Negatif (sesuai UI Siswa)
                    $color = $isPositif ? '#D4F1BE' : '#FFB3B3';

                    $imagePath = null;
                    // Jika guru mengupload gambar baru
                    if (is_array($gambarFiles) && isset($gambarFiles[$index])) {
                        $file = $gambarFiles[$index];
                        $filename = time() . '_perilaku_' . $index . '.' . $file->getClientOriginalExtension();
                        // Simpan ke folder images/tahap5 sesuai view siswa
                        $file->move(public_path('images/tahap5'), $filename);
                        $imagePath = $filename;
                    } else {
                        // Gunakan gambar lama jika ada
                        $imagePath = $existingData[$index]['gambar'] ?? 'default_perilaku.png';
                    }

                    $perilakuData[] = [
                        'id' => $index + 1,
                        'judul' => $teks,
                        'gambar' => $imagePath,
                        'color' => $color,
                        'positif' => $isPositif
                    ];
                }
            }
        }

        // 4. Simpan ke database
        $kuisPerilaku->pilihan_data = json_encode($perilakuData);
        $kuisPerilaku->save();
    }

    private function handleStep6(Request $request, $materi)
    {
        // 1. Validasi Input (Maksimal 5MB agar gambar HD tidak pecah)
        $request->validate([
            'sketsa_mewarnai' => 'nullable|image|mimes:png,jpg,jpeg|max:5120',
        ]);

        // 2. Simpan Sketsa Mewarnai
        if ($request->hasFile('sketsa_mewarnai')) {
            // Hapus sketsa lama agar tidak menumpuk
            $materi->images()->where('tipe', 'sketsa_mewarnai')->delete();

            $file = $request->file('sketsa_mewarnai');
            $filename = time() . '_sketsa.' . $file->getClientOriginalExtension();
            
            // Simpan ke public/images/tahap6
            $file->move(public_path('images/tahap6'), $filename);

            // Kita simpan path-nya sebagai 'tahap6/namafile.png'
            // Agar saat di-render di siswa menjadi: asset('images/tahap6/namafile.png')
            $materi->images()->create([
                'path' => 'tahap6/' . $filename, 
                'tipe' => 'sketsa_mewarnai',
                'teks' => 'Sketsa Mewarnai',
                'urutan' => 1,
            ]);
        }
    }

    public function monitoring($mapel_slug)
    {
        $mapel = Mapel::where('slug', $mapel_slug)->firstOrFail();
        
        // Ambil materi utama dari mapel ini (asumsi urutan pertama)
        $materi = Materi::where('mapel_id', $mapel->id)->orderBy('order', 'asc')->first();
        $materiId = $materi ? $materi->id : 0;

        // Ambil semua siswa beserta progress mereka KHUSUS untuk materi ini
        $students = User::where('role', 'student')->with(['progress' => function ($query) use ($materiId) {
            $query->where('materi_id', $materiId);
        }])->get();

        return view('teacher.materi.monitoring', compact('mapel', 'materi', 'students'));
    }
}