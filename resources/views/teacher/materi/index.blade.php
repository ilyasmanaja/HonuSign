<x-admin-layout>
    <div class="max-w-5xl mx-auto py-12 px-6">

        <div class="mb-6">
            <a href="{{ route('teacher.dashboard') }}"
                class="inline-flex items-center gap-2 font-black text-black uppercase tracking-wider hover:underline text-sm">
                ← Kembali ke Pilihan Mapel
            </a>
        </div>

        <div
            class="flex flex-col md:flex-row md:items-center md:justify-between border-4 border-black p-8 rounded-[2.5rem] bg-[#FFD1E3] shadow-[8px_8px_0_#000] mb-12 gap-6">
            <div>
                <span
                    class="bg-white px-4 py-1.5 rounded-xl border-2 border-black text-xs font-black tracking-widest uppercase">Kategori
                    Mapel</span>
                <h1 class="text-4xl font-black text-black uppercase tracking-tight mt-2">{{ $mapel->nama }}</h1>
            </div>

            <div class="flex flex-col sm:flex-row gap-4">

                <a href="{{ route('teacher.materi.monitoring', ['mapel_slug' => $mapel->slug]) }}"
                    class="bg-[#FFF5B8] px-6 py-4 rounded-2xl border-4 border-black font-black text-black uppercase tracking-wider shadow-[4px_4px_0_#000] hover:-translate-y-1 transition-transform block text-center flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M2 12h4l2-9 5 18 3-9h5" />
                    </svg>
                    Monitoring
                </a>

                <a href="{{ route('teacher.materi.create', ['mapel_slug' => $mapel->slug]) }}"
                    class="bg-[#D4F1BE] px-6 py-4 rounded-2xl border-4 border-black font-black text-black uppercase tracking-wider shadow-[4px_4px_0_#000] hover:-translate-y-1 transition-transform block text-center flex items-center justify-center gap-2">
                    ➕ Tambah Materi Baru
                </a>

            </div>
        </div>

        <h2 class="text-2xl font-black text-black uppercase tracking-tight mb-6">Daftar Materi Saat Ini</h2>

        @if ($materis->isEmpty())
            <div class="bg-white border-4 border-black border-dashed rounded-[2rem] p-12 text-center">
                <p class="text-xl font-bold text-slate-500 mb-4">Belum ada materi pembelajaran yang dibuat untuk mapel
                    ini.</p>
                <a href="{{ route('teacher.materi.create', ['mapel_slug' => $mapel->slug]) }}"
                    class="text-indigo-600 font-black hover:underline uppercase">Mulai Buat Materi Pertama Sekarang!</a>
            </div>
        @else
            <div class="space-y-4">
                @foreach ($materis as $materi)
                    <div
                        class="bg-white border-4 border-black rounded-2xl p-6 flex flex-col md:flex-row justify-between md:items-center shadow-[4px_4px_0_#000] gap-4">
                        <div>
                            <span class="text-xs font-black text-slate-400 uppercase tracking-widest block mb-1">Urutan
                                Ke-{{ $materi->order }}</span>
                            <h3 class="text-xl font-black text-black uppercase">{{ $materi->judul }}</h3>
                        </div>

                        <div class="flex gap-3">
                            <a href="{{ route('teacher.materi.edit.step', ['mapel_slug' => $mapel->slug, 'materi_slug' => $materi->slug, 'step' => 1]) }}"
                                class="bg-[#FFF5B8] px-4 py-2 rounded-xl border-2 border-black font-black text-xs uppercase shadow-[2px_2px_0_#000] hover:bg-yellow-200">
                                📝 Edit Info / Video
                            </a>
                            <a href="{{ route('teacher.materi.edit.step', ['mapel_slug' => $mapel->slug, 'materi_slug' => $materi->slug, 'step' => 2]) }}"
                                class="bg-[#BEE9E8] px-4 py-2 rounded-xl border-2 border-black font-black text-xs uppercase shadow-[2px_2px_0_#000] hover:bg-cyan-200">
                                🎮 Kelola Tahap 2-6
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-admin-layout>
