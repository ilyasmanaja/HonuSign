<x-student-layout>
    <div class="max-w-5xl w-full px-6 py-12 flex flex-col items-center">

        <!-- Progress Bar -->
        <div class="w-full mb-10 max-w-3xl">
            <div class="flex justify-between mb-4 items-end">
                <span class="font-black text-xl tracking-widest uppercase text-black">Memahami</span>
            </div>
            <div class="w-full h-8 bg-white brutal-border brutal-shadow-sm rounded-2xl overflow-hidden p-1">
                <div class="h-full bg-[#FFD1E3] rounded-xl transition-all duration-1000 border-r-4 border-black"
                    style="width: 83.3%"></div>
            </div>
        </div>

        <!-- Header Judul -->
        <div class="text-center mb-10">
            <h1
                class="text-4xl md:text-5xl font-black text-black uppercase tracking-tighter transform -rotate-1 mb-2 flex justify-center items-center gap-3">
                Ayo Kita <span class="text-[#FFD1E3] text-outline drop-shadow-[0_4px_0_#000]">Memahami</span>!
            </h1>
        </div>

        <!-- Kontainer Utama -->
        <div class="w-full bg-[#FFD1E3] brutal-border brutal-shadow rounded-[3rem] p-6 md:p-8 mb-10">
            <div class="bg-[#FFFEFA] brutal-border brutal-shadow-sm rounded-[2rem] p-6 md:p-10">

                <!-- Header Card -->
                <div class="flex items-center gap-4 mb-8 border-b-4 border-slate-200 pb-6">
                    <span
                        class="p-3 bg-[#FFD1E3] brutal-border brutal-shadow-sm rounded-2xl transform -rotate-3 text-black">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8">
                            <path opacity="0.2"
                                d="M12 22a2 2 0 0 0 2-2h-4a2 2 0 0 0 2 2zm-3-4h6v-1a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v1zm3-16a7 7 0 0 0-6.17 10.28L6.82 14A2 2 0 0 0 6.5 15h11a2 2 0 0 0-.32-1l.99-1.72A7 7 0 0 0 12 2z" />
                            <path
                                d="M12 2a7 7 0 0 0-6.17 10.28L6.82 14A2 2 0 0 0 6.5 15h11a2 2 0 0 0-.32-1l.99-1.72A7 7 0 0 0 12 2zm-1 15h2v-2h-2v2zm3-3H10v-1c0-1.85.9-2.52 1.4-3.03.65-.67 1.1-1.12 1.1-2.47a1.5 1.5 0 0 0-3 0H8a3.5 3.5 0 0 1 7 0c0 1.95-1.13 2.76-1.71 3.36-.5.52-.79.84-.79 1.64v1.5z" />
                        </svg>
                    </span>
                    <h3 class="font-black text-black uppercase tracking-widest text-xl md:text-2xl">Cinta &amp; Tidak
                        Cinta Tanah Air</h3>
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
                                    class="w-full h-40 object-cover" onerror="this.style.display='none'">
                            </div>
                            <div class="p-4 flex items-start gap-3">
                                <span class="w-6 h-6 flex-shrink-0">
                                    @if($item['positif'])
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="w-full h-full text-green-700">
                                            <path opacity="0.2"
                                                d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm-2 15l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9z" />
                                            <path d="M10 17.41L4.59 12 6 10.59l4 4 6.59-6.59L18 9l-8 8.41z" />
                                        </svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="w-full h-full text-red-700">
                                            <path opacity="0.2"
                                                d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm3.59 12.17L14.17 15.59 12 13.41 9.83 15.59 8.41 14.17 10.59 12 8.41 9.83 9.83 8.41 12 10.59l2.17-2.17 1.42 1.42L13.41 12z" />
                                            <path
                                                d="M15.59 7L12 10.59 8.41 7 7 8.41 10.59 12 7 15.59 8.41 17 12 13.41 15.59 17 17 15.59 13.41 12 17 8.41z" />
                                        </svg>
                                    @endif
                                </span>
                                <p class="font-bold text-black text-sm leading-snug">{{ $item['judul'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="w-full max-w-5xl flex flex-col md:flex-row justify-between items-center mt-4 gap-6">
            <!-- Tombol Keluar & Simpan -->
            <a href="{{ route('materi.index') }}" onclick="tandaiSelesai(event, this.href, 5)"
                class="bg-[#FFB3B3] w-full md:w-auto justify-center brutal-border brutal-shadow-sm brutal-hover text-black px-8 py-5 md:px-10 md:py-6 rounded-[3rem] font-black uppercase tracking-widest text-lg md:text-xl flex items-center gap-4 text-center transform hover:-translate-y-2 transition-transform">
                Keluar & Simpan Progres
            </a>

            <!-- Tombol Lanjut -->
            <a href="{{ route('materi.belajar', ['step' => 6]) }}" onclick="tandaiSelesai(event, this.href, 5)"
                class="bg-[#D4F1BE] w-full md:w-auto justify-center brutal-border brutal-shadow-sm brutal-hover text-black px-8 py-5 md:px-12 md:py-6 rounded-[3rem] font-black uppercase tracking-widest text-xl md:text-2xl flex items-center gap-4 text-center transform hover:-translate-y-2 transition-transform">
                Selesai Membaca, Lanjut!
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="w-6 h-6 text-black transform -rotate-90">
                        <path opacity="0.2" d="M12 20V4l8 8-8 8z" />
                        <path d="M12 20V4l8 8-8 8z" />
                    </svg>
                </span>
            </a>
        </div>
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