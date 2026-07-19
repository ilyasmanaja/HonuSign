<x-admin-layout>
    <div class="max-w-6xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        
        <div class="mb-8 text-center md:text-left">
            <h1 class="text-3xl font-black text-black uppercase tracking-tight">Tahap 5: Pilah Perilaku</h1>
            <p class="text-sm font-bold text-slate-500 mt-1">Materi: {{ $materi->judul }}</p>
            
            <div class="mt-6 flex items-center justify-between relative">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="h-2 w-full bg-slate-200 border-2 border-black rounded-full"></div>
                </div>
                <div class="relative flex items-center justify-center bg-[#D4F1BE] border-4 border-black text-black rounded-full w-12 h-12 font-black z-10 shadow-[4px_4px_0_#000]">✓</div>
                <div class="relative flex items-center justify-center bg-[#D4F1BE] border-4 border-black text-black rounded-full w-12 h-12 font-black z-10 shadow-[4px_4px_0_#000]">✓</div>
                <div class="relative flex items-center justify-center bg-[#D4F1BE] border-4 border-black text-black rounded-full w-12 h-12 font-black z-10 shadow-[4px_4px_0_#000]">✓</div>
                <div class="relative flex items-center justify-center bg-[#D4F1BE] border-4 border-black text-black rounded-full w-12 h-12 font-black z-10 shadow-[4px_4px_0_#000]">✓</div>
                <div class="relative flex items-center justify-center bg-[#FFF5B8] border-4 border-black text-black rounded-full w-12 h-12 font-black z-10 shadow-[4px_4px_0_#000] animate-pulse">5</div>
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

        <form action="{{ route('teacher.materi.save.step', ['mapel_slug' => $mapel->slug, 'materi_slug' => $materi->slug, 'step' => 5]) }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 md:p-10 brutal-border brutal-shadow rounded-[2rem] space-y-10">
            @csrf

            <div class="bg-[#FFD1E3] p-6 rounded-2xl border-4 border-black shadow-[4px_4px_0_#000]">
                <div class="flex items-center justify-between gap-3 mb-4 border-b-4 border-black pb-2">
                    <div class="flex items-center gap-3">
                        <span class="text-3xl">🧩</span>
                        <h3 class="text-2xl font-black text-black uppercase tracking-tight">Kartu Perilaku (Drag & Drop)</h3>
                    </div>
                </div>
                
                <div class="mb-6 bg-white p-4 border-2 border-dashed border-black rounded-xl">
                    <p class="text-sm font-bold text-slate-700">💡 <b>Petunjuk:</b> Isi maksimal 6 kartu perilaku di bawah ini. Tentukan apakah perilaku tersebut termasuk sikap baik (Cinta Tanah Air) atau sikap buruk (Tidak Cinta Tanah Air). Sistem akan otomatis memberi warna Hijau/Merah pada kartu murid.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @for ($i = 0; $i < 6; $i++)
                        <div class="bg-white p-5 border-4 border-black rounded-xl relative shadow-sm hover:-translate-y-1 transition-transform">
                            <div class="absolute -top-3 -left-3 bg-[#BEE9E8] border-2 border-black w-8 h-8 flex items-center justify-center rounded-full font-black text-sm shadow-[2px_2px_0_#000]">
                                {{ $i + 1 }}
                            </div>

                            <label class="font-black text-black block mb-2 text-sm mt-2">Gambar Kartu:</label>
                            <input type="file" name="perilaku_gambar[]" accept="image/*" class="w-full p-2 bg-slate-50 border-2 border-black rounded-lg text-xs mb-3 cursor-pointer">
                            
                            <label class="font-black text-black block mb-2 text-sm">Deskripsi Perilaku:</label>
                            <input type="text" name="perilaku_teks[]" class="w-full p-3 border-2 border-black rounded-lg font-bold text-sm focus:outline-none focus:ring-4 focus:ring-pink-200 mb-3" placeholder="Contoh: Mengikuti upacara bendera">

                            <label class="font-black text-black block mb-2 text-sm">Kategori Perilaku:</label>
                            <select name="perilaku_status[]" class="w-full p-3 border-2 border-black rounded-lg font-black text-sm uppercase cursor-pointer focus:outline-none focus:ring-4 focus:ring-pink-200">
                                <option value="1">✅ Cinta Tanah Air (Positif)</option>
                                <option value="0">❌ Tidak Cinta Tanah Air (Negatif)</option>
                            </select>
                        </div>
                    @endfor
                </div>
            </div>

            <div class="flex flex-col md:flex-row justify-between items-center pt-4 gap-4">
                <a href="{{ route('teacher.materi.edit.step', ['mapel_slug' => $mapel->slug, 'materi_slug' => $materi->slug, 'step' => 4]) }}" class="font-black text-black uppercase hover:underline">
                    ← Kembali ke Tahap 4
                </a>
                <button type="submit" class="w-full md:w-auto bg-[#D4F1BE] px-8 py-4 rounded-2xl border-4 border-black font-black text-black text-lg shadow-[4px_4px_0_#000] hover:-translate-y-1 transition-transform cursor-pointer uppercase tracking-widest">
                    Simpan & Lanjut ke Tahap 6 →
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>