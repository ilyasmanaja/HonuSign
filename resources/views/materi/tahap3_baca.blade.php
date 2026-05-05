<x-student-layout>
    <div class="max-w-5xl w-full px-6 py-12 flex flex-col items-center">
        <!-- Progress Bar (Tahap 3) -->
        <div class="w-full mb-10">
            <div class="flex justify-between mb-2">
                <span class="text-xs font-black text-purple-600 uppercase tracking-widest">Tahap 3: Diskusi</span>
                <span class="text-xs font-black text-slate-400 uppercase tracking-widest">Persiapan Misi</span>
            </div>
            <div class="w-full bg-slate-200 h-3 rounded-full overflow-hidden border-2 border-white">
                <div class="bg-purple-500 h-full w-[50%] transition-all duration-1000"></div>
            </div>
        </div>

        <h1 class="text-3xl font-black text-slate-800 uppercase mb-8">Ayo Membaca! 📖</h1>

        <div class="w-full bg-white dark:bg-slate-900 p-10 rounded-[3rem] border-4 border-slate-200 shadow-xl mb-10">
            <p class="text-xl text-slate-600 dark:text-slate-300 leading-relaxed font-medium">
                {{-- Masukkan materi diskusi dari database --}}
                {!! nl2br(e($materi->deskripsi_tambahan)) !!}
            </p>
        </div>

        <a href="{{ route('materi.belajar', ['step' => 3, 'soal_ke' => 1]) }}"
            onclick="tandaiSelesai(event, this.href, 3)"
            class="bg-purple-600 text-white p-8 px-12 rounded-[2.5rem] font-black uppercase shadow-[0_10px_0_0_#7e22ce] active:translate-y-2 transition-all mt-8">
            Mulai Tantangan Kamera! 📸
        </a>
    </div>

    <script>
        function tandaiSelesai(event, nextUrl, tahapKe) {
            event.preventDefault();

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
                    score: 0
                })
            }).then(() => {
                window.location.href = nextUrl;
            }).catch(() => {
                window.location.href = nextUrl;
            });
        }
    </script>
</x-student-layout>