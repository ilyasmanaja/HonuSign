<x-admin-layout>
    <div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        
        <div class="mb-8 text-center md:text-left">
            <h1 class="text-3xl font-black text-black uppercase tracking-tight">Tahap 2: Kuis & Puzzle</h1>
            <p class="text-sm font-bold text-slate-500 mt-1">Materi: {{ $materi->judul }}</p>
            
            <div class="mt-6 flex items-center justify-between relative">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="h-2 w-full bg-slate-200 border-2 border-black rounded-full"></div>
                </div>
                <div class="relative flex items-center justify-center bg-[#D4F1BE] border-4 border-black text-black rounded-full w-12 h-12 font-black z-10 shadow-[4px_4px_0_#000]">✓</div>
                <div class="relative flex items-center justify-center bg-[#FFF5B8] border-4 border-black text-black rounded-full w-12 h-12 font-black z-10 shadow-[4px_4px_0_#000] animate-pulse">2</div>
                <div class="relative flex items-center justify-center bg-white border-4 border-black text-black rounded-full w-12 h-12 font-black z-10">3</div>
                <div class="relative flex items-center justify-center bg-white border-4 border-black text-black rounded-full w-12 h-12 font-black z-10">4</div>
                <div class="relative flex items-center justify-center bg-white border-4 border-black text-black rounded-full w-12 h-12 font-black z-10">5</div>
                <div class="relative flex items-center justify-center bg-white border-4 border-black text-black rounded-full w-12 h-12 font-black z-10">6</div>
            </div>
        </div>

        {{-- Menampilkan pesan error jika validasi gagal --}}
        @if ($errors->any())
            <div class="mb-6 p-4 bg-[#FFB3B3] border-4 border-black shadow-[4px_4px_0_#000] rounded-xl font-black text-black">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('teacher.materi.save.step', ['mapel_slug' => $mapel->slug, 'materi_slug' => $materi->slug, 'step' => 2]) }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 md:p-10 brutal-border brutal-shadow rounded-[2rem] space-y-10">
            @csrf

            <div class="bg-[#FFF5B8] p-6 rounded-2xl border-4 border-black shadow-[4px_4px_0_#000]">
                <div class="flex items-center gap-3 mb-4 border-b-4 border-black pb-2">
                    <span class="text-3xl">🔠</span>
                    <h3 class="text-2xl font-black text-black uppercase tracking-tight">1. Kuis Susun Huruf</h3>
                </div>
                
                <div class="space-y-4">
                    <div>
                        <label class="font-black text-black block mb-2">Kata Target (Jawaban Benar):</label>
                        <input type="text" name="susun_huruf_kata" class="w-full p-4 border-4 border-black rounded-xl font-black uppercase text-xl focus:outline-none focus:bg-yellow-100" placeholder="Contoh: GARUDA" required>
                        <small class="text-slate-700 font-bold mt-1 block">Sistem akan mengacak huruf secara otomatis.</small>
                    </div>
                    <div>
                        <label class="font-black text-black block mb-2">Gambar Tokoh (Opsional):</label>
                        <input type="file" name="susun_huruf_gambar" accept="image/*" class="w-full p-3 bg-white border-4 border-black rounded-xl font-bold cursor-pointer">
                    </div>
                </div>
            </div>

            <div class="bg-[#BEE9E8] p-6 rounded-2xl border-4 border-black shadow-[4px_4px_0_#000]">
                <div class="flex items-center gap-3 mb-4 border-b-4 border-black pb-2">
                    <span class="text-3xl">🧩</span>
                    <h3 class="text-2xl font-black text-black uppercase tracking-tight">2. Kuis Puzzle 3x3</h3>
                </div>
                
                <div>
                    <label class="font-black text-black block mb-2">Upload Gambar Utuh:</label>
                    <input type="file" name="puzzle_gambar" accept="image/*" class="w-full p-3 bg-white border-4 border-black rounded-xl font-bold cursor-pointer">
                    <div class="mt-3 p-3 bg-white border-2 border-dashed border-black rounded-lg">
                        <p class="text-sm font-bold text-slate-700">💡 <b>Info:</b> Guru cukup mengunggah 1 gambar utuh. Sistem/CSS akan memotongnya menjadi kotak 3x3 secara otomatis.</p>
                    </div>
                </div>
            </div>

            <div class="bg-[#D4F1BE] p-6 rounded-2xl border-4 border-black shadow-[4px_4px_0_#000]">
                <div class="flex items-center gap-3 mb-4 border-b-4 border-black pb-2">
                    <span class="text-3xl">📝</span>
                    <h3 class="text-2xl font-black text-black uppercase tracking-tight">3. Kuis Susun Kalimat</h3>
                </div>
                
                <div class="space-y-4">
                    <div>
                        <label class="font-black text-black block mb-2">Kalimat Jawaban Benar:</label>
                        <input type="text" name="susun_kalimat_jawaban" class="w-full p-4 border-4 border-black rounded-xl font-black focus:outline-none focus:bg-green-100" placeholder="Contoh: SAYA SUKA BELAJAR PANCASILA" required>
                    </div>
                    <div>
                        <label class="font-black text-black block mb-2">Pecahan Kata Acak (Pisahkan dengan koma):</label>
                        <textarea name="susun_kalimat_acak" rows="3" class="w-full p-4 border-4 border-black rounded-xl font-black focus:outline-none focus:bg-green-100" placeholder="Contoh: SUKA, PANCASILA, SAYA, BELAJAR" required></textarea>
                        <small class="text-slate-700 font-bold mt-1 block">Kata-kata ini akan tampil sebagai tombol yang bisa ditekan oleh anak.</small>
                    </div>
                </div>
            </div>

            <div class="flex justify-between items-center pt-4">
                <a href="{{ route('teacher.materi.edit.step', ['mapel_slug' => $mapel->slug, 'materi_slug' => $materi->slug, 'step' => 1]) }}" class="font-black text-black uppercase hover:underline">
                    ← Kembali ke Tahap 1
                </a>
                <button type="submit" class="bg-[#FFD1E3] px-8 py-4 rounded-2xl border-4 border-black font-black text-black text-lg shadow-[4px_4px_0_#000] hover:-translate-y-1 transition-transform cursor-pointer uppercase tracking-widest">
                    Simpan & Lanjut ke Tahap 3 →
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>