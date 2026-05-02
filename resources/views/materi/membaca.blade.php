<x-student-layout>
    <div class="max-w-5xl w-full px-6 py-12">
        <div class="flex justify-between items-end mb-12">
            <div>
                <h1 class="text-4xl font-black text-teal-500 uppercase tracking-tighter">Membaca Kalimat</h1>
                <p class="text-slate-400 font-medium">Perhatikan gerakan isyarat untuk setiap kalimat di bawah ini</p>
            </div>
            <a href="{{ route('materi.index') }}"
                class="bg-slate-800 text-white px-6 py-3 rounded-2xl font-bold hover:bg-slate-700 transition-all border border-slate-700">
                ← KEMBALI
            </a>
        </div>

        <div class="space-y-4">
            @forelse($semuaMateri as $m)
                {{-- Ubah div jadi tag <a> dan tambahkan route --}}
                    <a href="{{ route('materi.show', $m->slug) }}"
                        class="group bg-teal-300 border-2 border-teal-500 p-6 rounded-4xl hover:border-blue-500 hover:bg-blue-300 transition-all cursor-pointer flex items-center gap-6">

                        <div
                            class="w-16 h-16 bg-blue-300 rounded-2xl flex items-center justify-center text-3xl border-2 border-blue-500 group-hover:scale-110 transition-transform group-hover:bg-teal-300 group-hover:border-teal-500">
                            ▶️
                        </div>

                        <div class="flex-1 text-left"> {{-- Tambah text-left biar rapi --}}
                            <h3 class="text-xl font-black text-slate-600 uppercase tracking-tight">{{ $m->judul }}</h3>
                            <p class="text-slate-400 text-sm mt-1">{{ $m->deskripsi }}</p>
                        </div>

                        <div class="hidden md:block">
                            <span
                                class="text-slate-600 font-black uppercase text-xs tracking-widest group-hover:text-blue-500">Klik
                                untuk Belajar</span>
                        </div>

                    </a> {{-- Jangan lupa tutup pakai </a> --}}
            @empty
                <div class="text-center py-20 bg-slate-800/30 rounded-[3rem] border-4 border-dashed border-slate-700">
                    <p class="text-slate-500 font-black uppercase tracking-widest text-xl">Belum ada kalimat yang tersedia
                    </p>
                </div>
            @endforelse
        </div>
    </div>
</x-student-layout>