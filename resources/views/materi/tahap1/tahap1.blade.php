<x-student-layout>
    <!-- Interactive Visual Tutorial Overlay (Tetap Statis) -->
    <div id="tutorial-overlay"
        class="fixed inset-0 bg-slate-900/80 backdrop-blur-md z-[5000] flex items-center justify-center p-4 transition-opacity duration-500 opacity-0 pointer-events-none">
        <div class="bg-[#FFFEFA] brutal-border brutal-shadow p-8 md:p-12 rounded-[3rem] max-w-xl w-full flex flex-col items-center text-center relative transform scale-90 transition-transform duration-500"
            id="tutorial-modal-content">
            <div
                class="bg-[#FFF5B8] px-6 py-2 rounded-2xl brutal-border brutal-shadow-sm font-black text-sm mb-6 -rotate-2 text-black">
                AKTIVITAS KELAS
            </div>
            <h2 class="text-3xl md:text-4xl font-black text-black tracking-tight mb-6">Membaca Bersama</h2>

            <div
                class="relative w-full max-w-sm h-64 bg-[#BEE9E8] brutal-border rounded-[2rem] p-4 flex items-center justify-between mb-8 mx-auto overflow-hidden shadow-inner">
                <div class="flex flex-col items-center z-10 w-1/3">
                    <span class="text-5xl animate-bounce">👩‍🏫</span>
                    <span
                        class="text-xs font-black text-black bg-[#FFF5B8] px-3 py-1 rounded-xl brutal-border mt-3 shadow-[2px_2px_0_#000]">Guru</span>
                </div>
                <div class="flex gap-1.5 items-center justify-center flex-grow px-2 z-10 h-24">
                    <span class="w-2.5 h-10 bg-black rounded-full animate-pulse" style="animation-delay: 0.1s"></span>
                    <span class="w-2.5 h-16 bg-black rounded-full animate-pulse" style="animation-delay: 0.3s"></span>
                    <span class="w-2.5 h-8 bg-black rounded-full animate-pulse" style="animation-delay: 0.5s"></span>
                </div>
                <div class="flex flex-col items-center z-10 w-1/3">
                    <span class="text-5xl animate-pulse">🧑‍🎓</span>
                    <span
                        class="text-xs font-black text-black bg-[#D4F1BE] px-3 py-1 rounded-xl brutal-border mt-3 shadow-[2px_2px_0_#000]">Murid</span>
                </div>
                <div class="absolute right-4 top-4 text-3xl animate-ping opacity-75">👂</div>
            </div>

            <div class="flex flex-col gap-4 text-left w-full bg-[#F8FAFC] brutal-border p-6 rounded-2xl mb-8 shadow-sm">
                <div class="flex items-start gap-3">
                    <span
                        class="bg-[#FFF5B8] w-8 h-8 rounded-xl brutal-border flex items-center justify-center font-black text-black text-sm shrink-0 mt-0.5">1</span>
                    <p class="font-bold text-slate-700 text-sm md:text-base"><b>Bersama Guru</b>: Aktivitas membaca ini
                        dilakukan bersama guru di dalam kelas.</p>
                </div>
                <div class="flex items-start gap-3">
                    <span
                        class="bg-[#D4F1BE] w-8 h-8 rounded-xl brutal-border flex items-center justify-center font-black text-black text-sm shrink-0 mt-0.5">2</span>
                    <p class="font-bold text-slate-700 text-sm md:text-base"><b>Perhatikan Cerita</b>: Perhatikan gambar
                        dan baca teks cerita dengan tertib.</p>
                </div>
            </div>

            <div class="relative group/tooltip">
                <button onclick="closeTutorial()"
                    class="w-20 h-20 bg-[#D4F1BE] text-black rounded-full brutal-border brutal-shadow-sm brutal-hover flex items-center justify-center cursor-pointer animate-pulse">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-10 h-10 text-black"
                        fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round"
                        stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div class="max-w-5xl w-full px-6 py-12 flex flex-col items-center">
        <!-- Progress Bar -->
        <div class="w-full mb-10 max-w-3xl">
            <div class="flex justify-between mb-4 items-end">
                <span class="font-black text-xl tracking-widest uppercase text-black">Membaca</span>
            </div>
            <div class="w-full h-8 bg-white brutal-border brutal-shadow-sm rounded-2xl overflow-hidden p-1">
                <div class="h-full bg-[#BEE9E8] rounded-xl transition-all duration-1000 border-r-4 border-black"
                    style="width: 16.6%"></div>
            </div>
        </div>

        <!-- Header Judul Materi DINAMIS -->
        <div class="text-center mb-10">
            <h1
                class="text-4xl md:text-6xl font-black text-[#FFF5B8] text-outline uppercase tracking-tighter transform -rotate-1 drop-shadow-[0_6px_0_#000]">
                {{ $materi->judul }}
            </h1>
        </div>

        <!-- Konten Materi -->
        <div class="w-full flex justify-center mb-10">
            <div
                class="w-full max-w-5xl bg-[#FFD1E3] brutal-border brutal-shadow rounded-[3rem] p-6 md:p-8 flex flex-col h-full">
                <div
                    class="bg-[#FFFEFA] brutal-border brutal-shadow-sm rounded-[2rem] p-6 md:p-10 flex-grow flex flex-col relative">

                    <!-- Header Card & Tombol Video -->
                    <div class="flex justify-between items-center mb-10 gap-6 border-b-4 border-slate-200 pb-6">
                        <h3
                            class="font-black text-black uppercase tracking-widest text-xl md:text-2xl flex items-center gap-4">
                            <span
                                class="p-3 bg-[#FFF5B8] brutal-border brutal-shadow-sm rounded-2xl transform -rotate-3">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-8 h-8 text-black"
                                    fill="#FFF5B8" stroke="currentColor" stroke-width="3" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z" />
                                    <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z" />
                                </svg>
                            </span>
                            Bacaan Materi
                        </h3>

                        <!-- Tombol Ganti ke Video -->
                        <div class="relative group/tooltip">
                            <a href="{{ route('materi.tahap1.video', ['mapel_slug' => $mapel->slug]) }}"
                                class="bg-[#BEE9E8] brutal-border brutal-shadow-sm brutal-hover p-4 rounded-2xl flex items-center justify-center transform hover:-translate-y-1 transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-9 h-9 text-black"
                                    fill="#BEE9E8" stroke="currentColor" stroke-width="3" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <rect x="2" y="7" width="20" height="14" rx="2" ry="2" />
                                    <polyline points="17 2 12 7 7 2" />
                                    <polygon points="10 11 15 14 10 17 10 11" fill="currentColor" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="text-xl md:text-2xl text-slate-700 leading-relaxed font-bold flex-grow space-y-6">

                        <!-- ILUSTRASI ATAS DINAMIS -->
                        @php $ilustrasiAtas = $materi->images->where('tipe', 'ilustrasi_atas')->first(); @endphp
                        @if ($ilustrasiAtas)
                            <div class="my-10 flex justify-center transform -rotate-1">
                                <div
                                    class="bg-white p-4 brutal-border brutal-shadow-sm rounded-[2.5rem] inline-block hover:scale-105 transition-transform duration-300">
                                    <img src="{{ asset('images/materi/tahap1/' . $ilustrasiAtas->path) }}"
                                        alt="Ilustrasi" class="w-full max-w-lg rounded-3xl brutal-border">
                                </div>
                            </div>
                        @endif

                        <!-- PARAGRAF 1 DINAMIS -->
                        {!! $materi->deskripsi !!}

                        <!-- STORYBOARD 1 DINAMIS -->
                        @php $cerita1 = $materi->images->where('tipe', 'cerita_1')->sortBy('urutan'); @endphp
                        @if ($cerita1->count() > 0)
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 my-10 relative">
                                @foreach ($cerita1 as $index => $item)
                                    @php
                                        $rotations = ['rotate-2', '-rotate-2', 'rotate-1'];
                                        $bgColors = ['#D4F1BE', '#BEE9E8', '#FFF5B8'];
                                        $rot = $rotations[$index % 3];
                                        $bg = $bgColors[$index % 3];
                                    @endphp
                                    <div class="p-6 brutal-border brutal-shadow rounded-[2.5rem] flex flex-col items-center text-center hover:-translate-y-2 transition-transform duration-300 z-10"
                                        style="background-color: {{ $bg }}">
                                        <div
                                            class="bg-white p-3 brutal-border brutal-shadow-sm rounded-3xl mb-6 transform {{ $rot }} hover:rotate-0 transition-transform">
                                            <img src="{{ asset('images/materi/tahap1/' . $item->path) }}"
                                                alt="{{ $item->teks }}"
                                                class="w-full max-w-[200px] rounded-2xl brutal-border">
                                        </div>
                                        <p class="text-xl md:text-2xl font-black text-black">{{ $item->teks }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <!-- ILUSTRASI TENGAH DINAMIS -->
                        @php $ilustrasiTengah = $materi->images->where('tipe', 'ilustrasi_tengah')->first(); @endphp
                        @if ($ilustrasiTengah)
                            <div class="my-10 flex justify-center transform rotate-1">
                                <div
                                    class="bg-white p-4 brutal-border brutal-shadow-sm rounded-[2.5rem] inline-block hover:scale-105 transition-transform duration-300">
                                    <img src="{{ asset('images/materi/tahap1/' . $ilustrasiTengah->path) }}"
                                        alt="Ilustrasi" class="w-full max-w-lg rounded-3xl brutal-border">
                                </div>
                            </div>
                        @endif

                        <!-- PARAGRAF 2 DINAMIS -->
                        {!! $materi->deskripsi_tambahan !!}

                        <!-- STORYBOARD 2 DINAMIS -->
                        @php $cerita2 = $materi->images->where('tipe', 'cerita_2')->sortBy('urutan'); @endphp
                        @if ($cerita2->count() > 0)
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 my-10 relative">
                                @foreach ($cerita2 as $index => $item)
                                    <!-- (Isi looping kartu cerita 2 milikmu biarkan seperti ini...) -->
                                    @php
                                        $rotations = ['rotate-2', '-rotate-2', 'rotate-1'];
                                        $bgColors = ['#D4F1BE', '#BEE9E8', '#FFF5B8'];
                                        $rot = $rotations[$index % 3];
                                        $bg = $bgColors[$index % 3];
                                    @endphp
                                    <div class="p-6 brutal-border brutal-shadow rounded-[2.5rem] flex flex-col items-center text-center hover:-translate-y-2 transition-transform duration-300 z-10"
                                        style="background-color: {{ $bg }}">
                                        <div
                                            class="bg-white p-3 brutal-border brutal-shadow-sm rounded-3xl mb-6 transform {{ $rot }} hover:rotate-0 transition-transform">
                                            <img src="{{ asset('images/materi/tahap1/' . $item->path) }}"
                                                alt="{{ $item->teks }}"
                                                class="w-full max-w-[200px] rounded-2xl brutal-border">
                                        </div>
                                        <p class="text-xl md:text-2xl font-black text-black">{{ $item->teks }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <!-- PARAGRAF 3 (AKHIR) DINAMIS -->
                        @php $paragrafAkhir = $materi->images->where('tipe', 'paragraf_akhir')->first(); @endphp
                        @if ($paragrafAkhir)
                            {!! $paragrafAkhir->teks !!}
                        @endif

                        <!-- ILUSTRASI BAWAH DINAMIS -->
                        @php $ilustrasiBawah = $materi->images->where('tipe', 'ilustrasi_bawah')->first(); @endphp
                        @if ($ilustrasiBawah)
                            <div class="my-10 flex justify-center transform rotate-1">
                                <div
                                    class="bg-white p-4 brutal-border brutal-shadow-sm rounded-[2.5rem] inline-block hover:scale-105 transition-transform duration-300">
                                    <img src="{{ asset('images/materi/tahap1/' . $ilustrasiBawah->path) }}"
                                        alt="Ilustrasi" class="w-full max-w-lg rounded-3xl brutal-border">
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="w-full max-w-5xl flex justify-center gap-12 items-center mt-8 px-4">
            <div class="relative group/tooltip">
                <a href="{{ route('dashboard.mapel', ['mapel_slug' => $mapel->slug]) }}"
                    onclick="tandaiSelesai(event, this.href, 1)"
                    class="bg-[#FFB3B3] w-20 h-20 flex items-center justify-center brutal-border brutal-shadow-sm brutal-hover text-black rounded-full transform hover:-translate-y-2 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-10 h-10 text-black"
                        fill="#FFB3B3" stroke="currentColor" stroke-width="3.5" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                        <polyline points="9 22 9 12 15 12 15 22" />
                    </svg>
                </a>
                <div
                    class="pointer-events-none absolute bottom-full left-1/2 -translate-x-1/2 mb-3 bg-[#FFD1E3] brutal-border brutal-shadow-sm px-3 py-1.5 rounded-lg text-sm font-bold opacity-0 scale-95 group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-150 whitespace-nowrap z-50 text-black">
                    Keluar & Simpan
                </div>
            </div>

            <div class="relative group/tooltip">
                <a href="{{ route('materi.belajar', ['mapel_slug' => $mapel->slug, 'step' => 2]) }}"
                    onclick="tandaiSelesai(event, this.href, 1)"
                    class="bg-[#D4F1BE] w-20 h-20 flex items-center justify-center brutal-border brutal-shadow-sm brutal-hover text-black rounded-full transform hover:-translate-y-2 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-10 h-10 text-black"
                        fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round"
                        stroke-linejoin="round">
                        <polygon points="5 3 19 12 5 21 5 3" fill="#D4F1BE" />
                    </svg>
                </a>
                <div
                    class="pointer-events-none absolute bottom-full left-1/2 -translate-x-1/2 mb-3 bg-[#FFF5B8] brutal-border brutal-shadow-sm px-3 py-1.5 rounded-lg text-sm font-bold opacity-0 scale-95 group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-150 whitespace-nowrap z-50 text-black">
                    Lanjut
                </div>
            </div>
        </div>
    </div>

    <script>
        function showTutorial() {
            const overlay = document.getElementById('tutorial-overlay');
            const content = document.getElementById('tutorial-modal-content');
            if (overlay && content) {
                overlay.classList.remove('opacity-0', 'pointer-events-none');
                overlay.classList.add('opacity-100', 'pointer-events-auto');
                content.classList.remove('scale-90');
                content.classList.add('scale-100');
            }
        }

        function closeTutorial() {
            const overlay = document.getElementById('tutorial-overlay');
            const content = document.getElementById('tutorial-modal-content');
            if (overlay && content) {
                overlay.classList.add('opacity-0', 'pointer-events-none');
                overlay.classList.remove('opacity-100', 'pointer-events-auto');
                content.classList.add('scale-90');
                content.classList.remove('scale-100');
            }
        }
        window.addEventListener('DOMContentLoaded', () => {
            showTutorial();
        });

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
                })
                .catch(() => {
                    window.location.href = nextUrl;
                });
        }
    </script>
</x-student-layout>
