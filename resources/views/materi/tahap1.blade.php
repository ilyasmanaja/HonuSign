<x-student-layout>
    <div class="max-w-6xl w-full px-6 py-12 flex flex-col items-center">
        <!-- Progress Bar (Tahap 1) -->
        <div class="w-full mb-10">
            <div class="flex justify-between mb-2">
                <span class="text-xs font-black text-blue-600 uppercase tracking-widest">Tahap 1: Membaca</span>
                <span class="text-xs font-black text-slate-400 uppercase tracking-widest">Misi 1 dari 6</span>
            </div>
            <div
                class="w-full bg-slate-200 dark:bg-slate-800 h-3 rounded-full overflow-hidden border-2 border-white dark:border-slate-700">
                <div class="bg-blue-500 h-full transition-all duration-1000" style="width: 16.6%"></div>
            </div>
        </div>

        <h1 class="text-3xl font-black text-slate-800 dark:text-white uppercase mb-8 tracking-tighter">
            {{ $materi->judul }}
        </h1>

        <!-- Container Gambar -->
        <div
            class="w-6xl aspect-video bg-black rounded-[3rem] border-8 border-slate-800 overflow-hidden shadow-2xl mb-8">
            <!-- Ganti gambar menjadi video_peragaan -->
            <img src="{{ asset('images/' . $materi->video_peragaan) }}" alt="Thumbnail {{ $materi->judul }}"
                class="w-full h-full object-contain">
        </div>

        <!-- Teks Bacaan -->
        <div
            class="w-6xl bg-white dark:bg-slate-900 p-10 rounded-[3rem] border-4 border-slate-200 dark:border-slate-800 shadow-xl mb-10">
            <h3 class="font-black text-blue-500 mb-4 uppercase tracking-widest text-sm flex items-center gap-2">
                <span class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-lg">📖</span> Teks Bacaan:
            </h3>
            <p class="text-xl text-slate-600 dark:text-slate-300 leading-relaxed font-medium">
                {!! nl2br(e($materi->deskripsi)) !!}
            </p>
        </div>

        <a href="{{ route('materi.belajar', ['step' => 2]) }}" onclick="tandaiSelesai(event, this.href, 1)"
            class="bg-blue-600 hover:bg-blue-500 text-white p-6 px-12 rounded-[2.5rem] font-black uppercase shadow-[0_10px_0_0_#1d4ed8] active:shadow-none active:translate-y-2 transition-all text-center text-lg mt-8">
            Selesai Membaca, Lanjut Tahap Kedua! 🚀
        </a>
    </div>

    <script>
        function tandaiSelesai(event, nextUrl, tahapKe) {
            event.preventDefault(); // Tahan dulu, jangan langsung pindah halaman

            fetch('{{ route('materi.save_progress') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    materi_id: {{ $materi->id }},
                    tahap: tahapKe,
                    score: 0 // Karena ini cuma bacaan, skor 0 tidak masalah
                })
            }).then(() => {
                window.location.href = nextUrl; // Kalau sukses simpan, baru pindah halaman
            }).catch(() => {
                window.location.href = nextUrl; // Kalau internet nge-lag, tetap izinkan pindah halaman
            });
        }
    </script>
</x-student-layout>