<x-student-layout>
    <div class="max-w-5xl w-full px-6 py-12 flex flex-col items-center">

        <!-- Progress Bar (Tahap 3) -->
        <div class="w-full mb-10 max-w-3xl">
            <div class="flex justify-between mb-4 items-end">
                <span class="font-black text-xl tracking-widest uppercase text-black">Tahap 3: Diskusi</span>
                <span
                    class="text-xl font-black text-black bg-[#BEE9E8] brutal-border px-4 py-1 rounded-2xl transform rotate-2 shadow-[2px_2px_0_#000]">Misi
                    3 dari 6</span>
            </div>
            <div class="w-full h-8 bg-white brutal-border brutal-shadow-sm rounded-2xl overflow-hidden p-1">
                <div class="h-full bg-[#BEE9E8] rounded-xl transition-all duration-1000 border-r-4 border-black"
                    style="width: 50%"></div>
            </div>
        </div>

        <!-- Header Judul -->
        <div class="text-center mb-10">
            <h1 class="text-4xl md:text-5xl font-black text-black uppercase tracking-tighter transform -rotate-1 mb-2">
                Ayo <span class="text-[#BEE9E8] text-outline drop-shadow-[0_4px_0_#000]">Membaca</span>! 📖
            </h1>
        </div>

        <!-- Konten Card -->
        <div class="w-full max-w-5xl bg-[#BEE9E8] brutal-border brutal-shadow rounded-[3rem] p-6 md:p-8 mb-10">
            <div class="bg-[#FFFEFA] brutal-border brutal-shadow-sm rounded-[2rem] p-6 md:p-10">
                <!-- Header Card -->
                <div class="flex items-center gap-4 mb-8 border-b-4 border-slate-200 pb-6">
                    <span class="p-3 bg-[#BEE9E8] brutal-border brutal-shadow-sm rounded-2xl transform -rotate-3 text-3xl">📖</span>
                    <h3 class="font-black text-black uppercase tracking-widest text-xl md:text-2xl">Diskusi Isyarat</h3>
                </div>

                <div class="text-xl md:text-2xl text-slate-700 leading-relaxed font-bold">
                    {!! nl2br(e($materi->deskripsi_tambahan)) !!}
                </div>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <a href="{{ route('materi.belajar', ['step' => 3, 'soal_ke' => 1]) }}"
            onclick="tandaiSelesai(event, this.href, 3)"
            class="bg-[#D4F1BE] brutal-border brutal-shadow-sm brutal-hover text-black px-8 py-5 md:px-12 md:py-6 rounded-[3rem] font-black uppercase tracking-widest text-xl md:text-2xl flex items-center gap-4 text-center">
            Mulai Tantangan Kamera! <span class="text-4xl animate-bounce">📸</span>
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