<x-student-layout>
    <div class="max-w-5xl w-full px-6 py-12 flex flex-col items-center">

        <!-- Progress Bar (Tahap 4) -->
        <div class="w-full mb-10 max-w-3xl">
            <div class="flex justify-between mb-4 items-end">
                <span class="font-black text-xl tracking-widest uppercase text-black">Tahap 4: Keberagaman</span>
                <span
                    class="text-xl font-black text-black bg-[#E0BBE4] brutal-border px-4 py-1 rounded-2xl transform rotate-2 shadow-[2px_2px_0_#000]">Misi
                    4 dari 6</span>
            </div>
            <div class="w-full h-8 bg-white brutal-border brutal-shadow-sm rounded-2xl overflow-hidden p-1">
                <div class="h-full bg-[#E0BBE4] rounded-xl transition-all duration-1000 border-r-4 border-black"
                    style="width: 66.6%"></div>
            </div>
        </div>

        <!-- Header Judul -->
        <div class="text-center mb-10">
            <h1 class="text-4xl md:text-5xl font-black text-black uppercase tracking-tighter transform -rotate-1 mb-2">
                Keberagaman <span class="text-[#E0BBE4] text-outline drop-shadow-[0_4px_0_#000]">Indonesia</span>
            </h1>
        </div>

        <!-- Kontainer Utama Materi -->
        <div class="w-full bg-[#E0BBE4] brutal-border brutal-shadow rounded-[3rem] p-6 md:p-8 mb-10">
            <div class="bg-[#FFFEFA] brutal-border brutal-shadow-sm rounded-[2rem] p-6 md:p-10">

                <!-- Intro Paragraph -->
                <p class="text-xl md:text-2xl text-slate-700 leading-relaxed font-bold mb-10">
                    Indonesia adalah negara yang memiliki banyak keberagaman. Keberagaman ini disebut keberagaman sosial
                    dan budaya, yaitu perbedaan dalam kehidupan masyarakat yang meliputi aspek sosial seperti pekerjaan
                    dan agama, serta aspek budaya seperti adat istiadat, bahasa, dan kesenian. Bentuk keberagaman sosial
                    dan budaya di Indonesia antara lain:
                </p>

                <!-- Grid Keberagaman -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                    @php
                        $keberagaman = [
                            'Bahasa Daerah' => ['file' => 'bahasa_daerah.png', 'color' => '#BEE9E8'],
                            'Agama dan Kepercayaan' => ['file' => 'agama.png', 'color' => '#FFD1E3'],
                            'Pakaian Tradisional' => ['file' => 'pakaian_adat.png', 'color' => '#FFF5B8'],
                            'Suku Bangsa' => ['file' => 'suku_bangsa.png', 'color' => '#D4F1BE'],
                            'Tarian Daerah' => ['file' => 'tarian.png', 'color' => '#E0BBE4'],
                            'Musik Daerah' => ['file' => 'musik.png', 'color' => '#BEE9E8'],
                            'Rumah Adat' => ['file' => 'rumah_adat_riau.png', 'color' => '#FFD1E3'],
                            'Makanan Khas' => ['file' => 'makanan_riau.png', 'color' => '#FFF5B8'],
                            'Adat Istiadat' => ['file' => 'nikah_melayu.png', 'color' => '#D4F1BE'],
                        ];
                        $i = 1;
                    @endphp

                    @foreach($keberagaman as $judul => $data)
                        <div class="brutal-border brutal-shadow-sm rounded-[2rem] overflow-hidden hover:-translate-y-2 transition-all duration-300"
                            style="background-color: {{ $data['color'] }}">
                            <div
                                class="w-full h-40 bg-[#FFFEFA] brutal-border border-t-0 border-l-0 border-r-0 relative flex items-center justify-center overflow-hidden">
                                <img src="{{ asset('images/tahap4/' . $data['file']) }}" alt="{{ $judul }}"
                                    class="w-full h-full object-cover"
                                    onerror="this.parentElement.classList.add('bg-slate-100')">
                            </div>
                            <div class="p-4 text-center">
                                <h3 class="font-black text-black text-base md:text-lg">{{ $i++ }}. {{ $judul }}</h3>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Paragraf Sumpah Pemuda -->
                <div class="text-xl text-slate-700 leading-relaxed font-bold space-y-6">
                    <p>
                        Semua keberagaman tersebut membuat Indonesia menjadi bangsa yang kaya budaya. Namun, perbedaan
                        ini juga bisa membuat masyarakat sulit saling memahami jika tidak ada alat pemersatu. Karena
                        itu, manusia sebagai makhluk sosial membutuhkan komunikasi, interaksi, dan kerja sama dalam
                        kehidupan sehari-hari di keluarga, sekolah, dan masyarakat.
                    </p>
                    <p>
                        Untuk memudahkan semua orang dari berbagai daerah agar bisa saling mengerti, dibutuhkan bahasa
                        persatuan, yaitu Bahasa Indonesia. Pada tanggal 28 Oktober 1928 dalam kongres pemuda lahirlah
                        bahasa pemersatu yang dapat menjadi perantara komunikasi antar budaya yang berbeda-beda.
                    </p>
                </div>

                <!-- Video Section -->
                <div
                    class="mt-10 w-full bg-black brutal-border brutal-shadow rounded-[2rem] overflow-hidden aspect-video relative flex items-center justify-center">
                    <video controls class="w-full h-full object-cover z-10">
                        <source src="{{ asset('videos/sumpah_pemuda_isyarat.mp4') }}" type="video/mp4">
                        Browser kamu tidak mendukung tag video.
                    </video>
                </div>
            </div>
        </div>

        <!-- Tombol Lanjut -->
        <a href="{{ route('materi.belajar', ['step' => 5]) }}" onclick="tandaiSelesai(event, this.href, 4)"
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