<x-admin-layout>
    <div class="max-w-6xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        
        <div class="mb-8 text-center md:text-left">
            <h1 class="text-3xl font-black text-black uppercase tracking-tight">Tahap 4: Keberagaman</h1>
            <p class="text-sm font-bold text-slate-500 mt-1">Materi: {{ $materi->judul }}</p>
            
            <div class="mt-6 flex items-center justify-between relative">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="h-2 w-full bg-slate-200 border-2 border-black rounded-full"></div>
                </div>
                <div class="relative flex items-center justify-center bg-[#D4F1BE] border-4 border-black text-black rounded-full w-12 h-12 font-black z-10 shadow-[4px_4px_0_#000]">✓</div>
                <div class="relative flex items-center justify-center bg-[#D4F1BE] border-4 border-black text-black rounded-full w-12 h-12 font-black z-10 shadow-[4px_4px_0_#000]">✓</div>
                <div class="relative flex items-center justify-center bg-[#D4F1BE] border-4 border-black text-black rounded-full w-12 h-12 font-black z-10 shadow-[4px_4px_0_#000]">✓</div>
                <div class="relative flex items-center justify-center bg-[#FFF5B8] border-4 border-black text-black rounded-full w-12 h-12 font-black z-10 shadow-[4px_4px_0_#000] animate-pulse">4</div>
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

        <form action="{{ route('teacher.materi.save.step', ['mapel_slug' => $mapel->slug, 'materi_slug' => $materi->slug, 'step' => 4]) }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 md:p-10 brutal-border brutal-shadow rounded-[2rem] space-y-10">
            @csrf

            <div class="bg-[#FFF5B8] p-6 rounded-2xl border-4 border-black shadow-[4px_4px_0_#000]">
                <div class="flex items-center gap-3 mb-4 border-b-4 border-black pb-2">
                    <span class="text-3xl">📝</span>
                    <h3 class="text-2xl font-black text-black uppercase tracking-tight">1. Teks Bacaan Awal Tahap 4</h3>
                </div>
                <div>
                    <label class="font-black text-black block mb-2">Deskripsi Cerita Atas (Format HTML):</label>
                    <textarea name="deskripsi_tahap4" rows="4" class="w-full p-4 border-4 border-black rounded-xl font-bold focus:outline-none bg-white" placeholder="<p>Masukkan cerita awal khusus keberagaman di sini...</p>">{{ old('deskripsi_tahap4', $materi->images->where('tipe', 'deskripsi_tahap4')->first()?->teks) }}</textarea>
                </div>
            </div>

            <div class="bg-[#E0BBE4] p-6 rounded-2xl border-4 border-black shadow-[4px_4px_0_#000]">
                <div class="flex items-center gap-3 mb-4 border-b-4 border-black pb-2">
                    <span class="text-3xl">🎴</span>
                    <h3 class="text-2xl font-black text-black uppercase tracking-tight">2. Kartu Visual Keberagaman</h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @for ($i = 0; $i < 9; $i++)
                        @php
                            $bgColors = ['bg-[#BEE9E8]', 'bg-[#FFD1E3]', 'bg-[#FFF5B8]', 'bg-[#D4F1BE]', 'bg-[#E0BBE4]', 'bg-[#BEE9E8]', 'bg-[#FFD1E3]', 'bg-[#FFF5B8]', 'bg-[#D4F1BE]'];
                            $slotBg = $bgColors[$i];
                        @endphp
                        <div class="{{ $slotBg }} p-5 border-4 border-black rounded-xl relative shadow-sm">
                            <div class="absolute -top-3 -left-3 bg-white border-2 border-black w-8 h-8 flex items-center justify-center rounded-full font-black text-sm shadow-[2px_2px_0_#000]">
                                {{ $i + 1 }}
                            </div>

                            <label class="font-black text-black block mb-2 text-sm mt-2">Gambar Kartu:</label>
                            <input type="file" name="kartu_gambar[]" accept="image/*" class="w-full p-2 bg-white border-2 border-black rounded-lg text-xs mb-3 cursor-pointer">
                            
                            <label class="font-black text-black block mb-2 text-sm">Judul Kartu (Isyarat):</label>
                            <input type="text" name="kartu_teks[]" class="w-full p-3 border-2 border-black rounded-lg font-black uppercase text-sm focus:outline-none" placeholder="MISAL: SUKU DAYAK">
                        </div>
                    @endfor
                </div>
            </div>

            <div class="bg-[#FFF5B8] p-6 rounded-2xl border-4 border-black shadow-[4px_4px_0_#000]">
                <div class="flex items-center gap-3 mb-4 border-b-4 border-black pb-2">
                    <span class="text-3xl">📝</span>
                    <h3 class="text-2xl font-black text-black uppercase tracking-tight">3. Teks Bacaan Penutup Tahap 4</h3>
                </div>
                <div>
                    <label class="font-black text-black block mb-2">Deskripsi Cerita Bawah (Format HTML):</label>
                    <textarea name="penutup_tahap4" rows="4" class="w-full p-4 border-4 border-black rounded-xl font-bold focus:outline-none bg-white" placeholder="<p>Masukkan cerita penutup khusus keberagaman di sini...</p>">{{ old('penutup_tahap4', $materi->images->where('tipe', 'penutup_tahap4')->first()?->teks) }}</textarea>
                </div>
            </div>

            <div class="flex flex-col md:flex-row justify-between items-center pt-4 gap-4">
                <a href="{{ route('teacher.materi.edit.step', ['mapel_slug' => $mapel->slug, 'materi_slug' => $materi->slug, 'step' => 3]) }}" class="font-black text-black uppercase hover:underline">
                    ← Kembali ke Tahap 3
                </a>
                <button type="submit" class="w-full md:w-auto bg-[#D4F1BE] px-8 py-4 rounded-2xl border-4 border-black font-black text-black text-lg shadow-[4px_4px_0_#000] hover:-translate-y-1 transition-transform cursor-pointer uppercase tracking-widest">
                    Simpan & Lanjut ke Tahap 5 →
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>