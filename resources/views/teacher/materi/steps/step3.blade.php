<x-admin-layout>
    <div class="max-w-5xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        
        <div class="mb-8 text-center md:text-left">
            <h1 class="text-3xl font-black text-black uppercase tracking-tight">Tahap 3: Cerita & Kamera AI</h1>
            <p class="text-sm font-bold text-slate-500 mt-1">Materi: {{ $materi->judul }}</p>
            
            <div class="mt-6 flex items-center justify-between relative">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="h-2 w-full bg-slate-200 border-2 border-black rounded-full"></div>
                </div>
                <div class="relative flex items-center justify-center bg-[#D4F1BE] border-4 border-black text-black rounded-full w-12 h-12 font-black z-10 shadow-[4px_4px_0_#000]">✓</div>
                <div class="relative flex items-center justify-center bg-[#D4F1BE] border-4 border-black text-black rounded-full w-12 h-12 font-black z-10 shadow-[4px_4px_0_#000]">✓</div>
                <div class="relative flex items-center justify-center bg-[#FFF5B8] border-4 border-black text-black rounded-full w-12 h-12 font-black z-10 shadow-[4px_4px_0_#000] animate-pulse">3</div>
                <div class="relative flex items-center justify-center bg-white border-4 border-black text-black rounded-full w-12 h-12 font-black z-10">4</div>
                <div class="relative flex items-center justify-center bg-white border-4 border-black text-black rounded-full w-12 h-12 font-black z-10">5</div>
                <div class="relative flex items-center justify-center bg-white border-4 border-black text-black rounded-full w-12 h-12 font-black z-10">6</div>
            </div>
        </div>

        @if ($errors->any())
            <div class="mb-6 p-4 bg-[#FFB3B3] border-4 border-black shadow-[4px_4px_0_#000] rounded-xl font-black text-black">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('teacher.materi.save.step', ['mapel_slug' => $mapel->slug, 'materi_slug' => $materi->slug, 'step' => 3]) }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 md:p-10 brutal-border brutal-shadow rounded-[2rem] space-y-10">
            @csrf

            <div class="bg-[#FFF5B8] p-6 rounded-2xl border-4 border-black shadow-[4px_4px_0_#000]">
                <div class="flex items-center gap-3 mb-4 border-b-4 border-black pb-2">
                    <span class="text-3xl">📝</span>
                    <h3 class="text-2xl font-black text-black uppercase tracking-tight">1. Teks Bacaan Awal</h3>
                </div>
                <div>
                    <label class="font-black text-black block mb-2">Deskripsi Cerita Atas (Format HTML):</label>
                    <textarea name="deskripsi_tahap3" rows="4" class="w-full p-4 border-4 border-black rounded-xl font-bold focus:outline-none bg-white" placeholder="<p>Masukkan cerita pengantar sesi kamera di sini...</p>">{{ old('deskripsi_tahap3', $materi->images->where('tipe', 'deskripsi_tahap3')->first()?->teks) }}</textarea>
                </div>
            </div>

            <div class="bg-[#BEE9E8] p-6 rounded-2xl border-4 border-black shadow-[4px_4px_0_#000]">
                <div class="flex items-center gap-3 mb-4 border-b-4 border-black pb-2">
                    <span class="text-3xl">📖</span>
                    <h3 class="text-2xl font-black text-black uppercase tracking-tight">2. Gambar Pengantar Cerita</h3>
                </div>
                
                <div class="mb-4 bg-white p-4 border-2 border-dashed border-black rounded-xl">
                    <p class="text-sm font-bold text-slate-700">💡 <b>Catatan:</b> Tambahkan maksimal 3 gambar ilustrasi untuk menghiasi bacaan Tahap 3.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @for ($i = 0; $i < 3; $i++)
                    <div class="bg-white p-4 rounded-xl border-4 border-black">
                        <label class="font-black text-black block mb-2">Upload Gambar {{ $i + 1 }}:</label>
                        <input type="file" name="cerita_tahap3_gambar[]" accept="image/*" class="w-full p-2 bg-slate-50 border-2 border-black rounded-lg text-sm cursor-pointer">
                    </div>
                    @endfor
                </div>
            </div>

            <div class="bg-[#FFF5B8] p-6 rounded-2xl border-4 border-black shadow-[4px_4px_0_#000]">
                <div class="flex items-center gap-3 mb-4 border-b-4 border-black pb-2">
                    <span class="text-3xl">📝</span>
                    <h3 class="text-2xl font-black text-black uppercase tracking-tight">3. Teks Bacaan Penutup</h3>
                </div>
                <div>
                    <label class="font-black text-black block mb-2">Deskripsi Cerita Bawah (Format HTML):</label>
                    <textarea name="penutup_tahap3" rows="4" class="w-full p-4 border-4 border-black rounded-xl font-bold focus:outline-none bg-white" placeholder="<p>Masukkan cerita penutup khusus Tahap 3 di sini...</p>">{{ old('penutup_tahap3', $materi->images->where('tipe', 'penutup_tahap3')->first()?->teks) }}</textarea>
                </div>
            </div>

            <div class="bg-[#FFD1E3] p-6 rounded-2xl border-4 border-black shadow-[4px_4px_0_#000]">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-3 mb-4 border-b-4 border-black pb-2">
                    <div class="flex items-center gap-3">
                        <span class="text-3xl">🤖</span>
                        <h3 class="text-2xl font-black text-black uppercase tracking-tight">4. Soal Deteksi Kamera AI</h3>
                    </div>
                    <span class="bg-black text-white px-3 py-1 rounded-full text-xs font-black uppercase">Maksimal 5 Soal</span>
                </div>
                
                <p class="text-sm font-bold mb-6 text-black">Isi beberapa soal di bawah ini. Kosongkan soal yang tidak ingin digunakan (misal hanya butuh 2 soal, isi nomor 1 & 2 saja).</p>

                <div class="space-y-6">
                    @for ($i = 0; $i < 5; $i++)
                    <div class="bg-white p-5 border-4 border-black rounded-xl relative">
                        <div class="absolute -top-3 -left-3 bg-[#FFF5B8] border-2 border-black w-10 h-10 flex items-center justify-center rounded-full font-black text-lg shadow-[2px_2px_0_#000]">
                            {{ $i + 1 }}
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                            <div>
                                <label class="font-black text-black block mb-2 text-sm">Teks Pertanyaan / Instruksi:</label>
                                <textarea name="pertanyaan_eja[]" rows="2" class="w-full p-3 border-2 border-black rounded-xl font-bold focus:bg-pink-50" placeholder="Contoh: Ayo eja lambang sila pertama!"></textarea>
                            </div>
                            
                            <div>
                                <label class="font-black text-black block mb-2 text-sm">Kata Target (Jawaban):</label>
                                <input type="text" name="target_eja_kata[]" class="w-full p-3 border-2 border-black rounded-xl font-black uppercase tracking-widest focus:bg-pink-50" placeholder="MISAL: BINTANG">
                                <small class="text-red-600 font-bold mt-1 block">TIDAK BOLEH ADA SPASI / ANGKA</small>
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>

            <div class="flex flex-col md:flex-row justify-between items-center pt-4 gap-4">
                <a href="{{ route('teacher.materi.edit.step', ['mapel_slug' => $mapel->slug, 'materi_slug' => $materi->slug, 'step' => 2]) }}" class="font-black text-black uppercase hover:underline">
                    ← Kembali ke Tahap 2
                </a>
                <button type="submit" class="w-full md:w-auto bg-[#D4F1BE] px-8 py-4 rounded-2xl border-4 border-black font-black text-black text-lg shadow-[4px_4px_0_#000] hover:-translate-y-1 transition-transform cursor-pointer uppercase tracking-widest">
                    Simpan & Lanjut ke Tahap 4 →
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>