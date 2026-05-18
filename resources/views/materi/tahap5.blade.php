<x-student-layout>
    <div class="max-w-5xl w-full px-6 py-12 flex flex-col items-center">

        <!-- Progress Bar (Tahap 5) -->
        <div class="w-full mb-10 max-w-3xl">
            <div class="flex justify-between mb-4 items-end">
                <span class="font-black text-xl tracking-widest uppercase text-black">Tahap 5: Memahami</span>
                <span
                    class="text-xl font-black text-black bg-[#FFD1E3] brutal-border px-4 py-1 rounded-2xl transform rotate-2 shadow-[2px_2px_0_#000]">Misi
                    5 dari 6</span>
            </div>
            <div class="w-full h-8 bg-white brutal-border brutal-shadow-sm rounded-2xl overflow-hidden p-1">
                <div class="h-full bg-[#FFD1E3] rounded-xl transition-all duration-1000 border-r-4 border-black"
                    style="width: 83.3%"></div>
            </div>
        </div>

        <!-- Header Judul -->
        <div class="text-center mb-10">
            <h1 class="text-4xl md:text-5xl font-black text-black uppercase tracking-tighter transform -rotate-1 mb-2">
                Ayo Kita <span class="text-[#FFD1E3] text-outline drop-shadow-[0_4px_0_#000]">Memahami</span>! 💡
            </h1>
        </div>

        <!-- Kontainer Utama -->
        <div class="w-full bg-[#FFD1E3] brutal-border brutal-shadow rounded-[3rem] p-6 md:p-8 mb-10">
            <div class="bg-[#FFFEFA] brutal-border brutal-shadow-sm rounded-[2rem] p-6 md:p-10">

                <!-- Header Card -->
                <div class="flex items-center gap-4 mb-8 border-b-4 border-slate-200 pb-6">
                    <span class="p-3 bg-[#FFD1E3] brutal-border brutal-shadow-sm rounded-2xl transform -rotate-3 text-3xl">💡</span>
                    <h3 class="font-black text-black uppercase tracking-widest text-xl md:text-2xl">Cinta &amp; Tidak Cinta Tanah Air</h3>
                </div>

                <p class="text-xl text-slate-700 leading-relaxed font-bold mb-10">
                    Perhatikan contoh gambar perilaku mencintai tanah air dan tidak mencintai tanah air Indonesia:
                </p>

                <!-- Grid Contoh -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @php
                        $keberagaman = [
                            ['judul' => 'Amir mengikuti upacara dengan khidmat', 'gambar' => 'upacara_bendera.png', 'color' => '#D4F1BE', 'positif' => true],
                            ['judul' => 'Abdul mencoret-coret dinding kelas', 'gambar' => 'coret_tembok.png', 'color' => '#FFB3B3', 'positif' => false],
                            ['judul' => 'Ani berbicara saat lagu Indonesia Raya', 'gambar' => 'ngobrol_upacara.png', 'color' => '#FFB3B3', 'positif' => false],
                            ['judul' => 'Ariva membuang sampah di Sungai', 'gambar' => 'buang_sampah.png', 'color' => '#FFB3B3', 'positif' => false],
                            ['judul' => 'Okta berbicara keras saat teman beribadah', 'gambar' => 'bicara_solat.png', 'color' => '#FFB3B3', 'positif' => false],
                            ['judul' => 'Sisca melaksanakan piket dengan sungguh', 'gambar' => 'siska_piket.png', 'color' => '#D4F1BE', 'positif' => true],
                        ];
                    @endphp

                    @foreach($keberagaman as $item)
                        <div class="brutal-border brutal-shadow-sm rounded-[2rem] overflow-hidden hover:-translate-y-2 transition-all duration-300"
                            style="background-color: {{ $item['color'] }}">
                            <!-- Badge -->
                            <div class="w-full bg-[#FFFEFA] brutal-border border-t-0 border-l-0 border-r-0 overflow-hidden">
                                <img src="{{ asset('images/tahap5/' . $item['gambar']) }}" alt="{{ $item['judul'] }}"
                                    class="w-full h-40 object-cover"
                                    onerror="this.style.display='none'">
                            </div>
                            <div class="p-4 flex items-start gap-3">
                                <span class="text-xl">{{ $item['positif'] ? '✅' : '❌' }}</span>
                                <p class="font-bold text-black text-sm leading-snug">{{ $item['judul'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Tombol Lanjut -->
        <a href="{{ route('materi.belajar', ['step' => 6]) }}"
            onclick="tandaiSelesai(event, this.href, 5)"
            class="bg-[#D4F1BE] brutal-border brutal-shadow-sm brutal-hover text-black px-8 py-5 md:px-12 md:py-6 rounded-[3rem] font-black uppercase tracking-widest text-xl md:text-2xl flex items-center gap-4 text-center">
            Selesai Membaca, Lanjut! <span class="text-4xl animate-bounce">🚀</span>
        </a>
    </div>

    <script>
        function tandaiSelesai(event, nextUrl, tahapKe) {
            event.preventDefault();

            const btn = event.currentTarget;
            btn.innerHTML = 'Menyimpan... ⏳';
            btn.classList.add('opacity-75', 'cursor-not-allowed');

            fetch('{{ route('materi.save_progress') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    materi_id: {{ $materi->id ?? 1 }},
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