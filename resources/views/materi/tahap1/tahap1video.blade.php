<x-student-layout>

    <!-- Main Container Wrapper -->
    <div class="max-w-5xl mx-auto w-full px-4 py-8 md:py-12 flex flex-col items-center">

        <!-- Progress Bar & Navigasi -->
        <div class="w-full mb-10">
            <!-- Header Kembali (Visual-Only) -->
            <div class="w-full mb-8 flex justify-start">
                <div class="relative group/tooltip">
                    <!-- RUTE DIPERBAIKI DENGAN SLUG -->
                    <a href="{{ route('materi.belajar', ['mapel_slug' => $mapel->slug, 'step' => 1]) }}"
                        class="bg-[#FFB3B3] w-16 h-16 flex items-center justify-center brutal-border brutal-shadow-sm brutal-hover text-black rounded-full transform hover:-translate-y-2 transition-transform z-10">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-10 h-10 text-black" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="19" y1="12" x2="5" y2="12" />
                            <polyline points="12 19 5 12 12 5" />
                        </svg>
                    </a>
                    <div class="pointer-events-none absolute top-full left-1/2 -translate-x-1/2 mt-3 bg-[#FFD1E3] brutal-border brutal-shadow-sm px-3 py-1.5 rounded-lg text-sm font-bold opacity-0 scale-95 group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-150 whitespace-nowrap z-50 text-black">
                        Kembali ke Cerita
                    </div>
                </div>
            </div>

            <!-- Progress Bar -->
            <div class="w-full max-w-3xl mx-auto">
                <div class="flex flex-col md:flex-row justify-between mb-4 items-start md:items-end gap-3">
                    <span class="font-black text-xl md:text-2xl tracking-widest uppercase text-black">Video Peragaan</span>
                </div>
                <div class="w-full h-8 bg-white brutal-border brutal-shadow-sm rounded-2xl overflow-hidden p-1">
                    <div class="h-full bg-[#BEE9E8] rounded-xl transition-all duration-1000 border-r-4 border-black" style="width: 16.6%"></div>
                </div>
            </div>
        </div>

        <!-- Header Judul Materi DINAMIS -->
        <div class="text-center mb-10">
            <h1 class="text-4xl md:text-6xl font-black text-[#FFF5B8] text-outline uppercase tracking-tighter transform -rotate-1 drop-shadow-[0_6px_0_#000]">
                {{ $materi->judul }}
            </h1>
        </div>

        <!-- Player Video -->
        <div class="w-full max-w-4xl bg-[#BEE9E8] brutal-border brutal-shadow rounded-[3rem] overflow-hidden flex flex-col relative">
            <!-- Mac window style top bar -->
            <div class="bg-white border-b-4 border-black px-6 py-4 flex items-center gap-3">
                <span class="w-4 h-4 md:w-5 md:h-5 rounded-full bg-[#FF6B6B] border-2 border-black"></span>
                <span class="w-4 h-4 md:w-5 md:h-5 rounded-full bg-[#FFF5B8] border-2 border-black"></span>
                <span class="w-4 h-4 md:w-5 md:h-5 rounded-full bg-[#D4F1BE] border-2 border-black"></span>
                <span class="ml-3 font-black text-sm md:text-base uppercase tracking-widest text-slate-700">Pemutar Video SIBI</span>
            </div>

            <div class="flex-grow flex flex-col items-center justify-center p-6 md:p-10 bg-[#FFFEFA] relative">

                <!-- Video Player DINAMIS DENGAN FALLBACK -->
                <div class="w-full bg-black brutal-border brutal-shadow-sm rounded-3xl p-4 mb-8 flex items-center justify-center aspect-video relative overflow-hidden max-w-3xl">
                    <video id="sibi-video" controls class="w-full h-full object-cover rounded-2xl z-10">
                        <source src="{{ $materi->video_peragaan ? asset('videos/' . $materi->video_peragaan) : asset('videos/peragaan_sibi.mp4') }}" type="video/mp4">
                        Browser kamu tidak mendukung tag video.
                    </video>
                </div>

                <!-- Kontrol Video Khusus Tunarungu (Visual-Only) -->
                <div class="flex justify-center gap-6 w-full max-w-md mt-4">
                    <!-- Rewind 5 seconds (5-) -->
                    <div class="relative group/tooltip">
                        <button type="button" onclick="rewindVideo()"
                            class="bg-[#FFD1E3] w-20 h-20 flex items-center justify-center brutal-border brutal-shadow-sm brutal-hover text-black rounded-full transform hover:-translate-y-2 transition-transform cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-12 h-12 text-black" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                                <polygon points="11 19 2 12 11 5 11 19" fill="currentColor" />
                                <polygon points="22 19 13 12 22 5 22 19" fill="currentColor" />
                            </svg>
                        </button>
                        <div class="pointer-events-none absolute bottom-full left-1/2 -translate-x-1/2 mb-3 bg-[#FFF5B8] brutal-border brutal-shadow-sm px-3 py-1.5 rounded-lg text-sm font-bold opacity-0 scale-95 group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-150 whitespace-nowrap z-50 text-black">
                            Mundur 5 Detik
                        </div>
                    </div>

                    <!-- Speed Toggle (0.5x / 1x) -->
                    <div class="relative group/tooltip">
                        <button type="button" id="btn-slow" onclick="toggleSlowMotion()"
                            class="bg-[#FFF5B8] w-20 h-20 flex items-center justify-center brutal-border brutal-shadow-sm brutal-hover text-black rounded-full transform hover:-translate-y-2 transition-transform cursor-pointer">
                            <span id="slow-icon-container" class="flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-12 h-12 text-black" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10" fill="#FFF5B8" />
                                    <polyline points="12 6 12 12 16 14" />
                                    <text x="12" y="20" font-family="sans-serif" font-size="5" font-weight="900" text-anchor="middle" fill="currentColor">0.5x</text>
                                </svg>
                            </span>
                        </button>
                        <div class="pointer-events-none absolute bottom-full left-1/2 -translate-x-1/2 mb-3 bg-[#FFF5B8] brutal-border brutal-shadow-sm px-3 py-1.5 rounded-lg text-sm font-bold opacity-0 scale-95 group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-150 whitespace-nowrap z-50 text-black">
                            Kecepatan Video
                        </div>
                    </div>

                    <!-- Forward 5 seconds (5+) -->
                    <div class="relative group/tooltip">
                        <button type="button" onclick="forwardVideo()"
                            class="bg-[#D4F1BE] w-20 h-20 flex items-center justify-center brutal-border brutal-shadow-sm brutal-hover text-black rounded-full transform hover:-translate-y-2 transition-transform cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-12 h-12 text-black" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                                <polygon points="13 19 22 12 13 5 13 19" fill="currentColor" />
                                <polygon points="2 19 11 12 2 5 2 19" fill="currentColor" />
                            </svg>
                        </button>
                        <div class="pointer-events-none absolute bottom-full left-1/2 -translate-x-1/2 mb-3 bg-[#FFF5B8] brutal-border brutal-shadow-sm px-3 py-1.5 rounded-lg text-sm font-bold opacity-0 scale-95 group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-150 whitespace-nowrap z-50 text-black">
                            Maju 5 Detik
                        </div>
                    </div>
                </div>

                <!-- Script untuk interaksi tombol video -->
                <script>
                    const videoPlayer = document.getElementById('sibi-video');
                    let isSlow = false;

                     const slowIcon = `
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-12 h-12 text-black" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10" fill="#FFF5B8" />
                            <polyline points="12 6 12 12 16 14" />
                            <text x="12" y="20" font-family="sans-serif" font-size="5" font-weight="900" text-anchor="middle" fill="currentColor">0.5x</text>
                        </svg>
                    `;

                    const normalIcon = `
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-12 h-12 text-black" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10" fill="#FFF5B8" />
                            <polyline points="12 6 12 12 16 14" />
                            <text x="12" y="20" font-family="sans-serif" font-size="5" font-weight="900" text-anchor="middle" fill="currentColor">1.0x</text>
                        </svg>
                    `;

                    function toggleSlowMotion() {
                        isSlow = !isSlow;
                        videoPlayer.playbackRate = isSlow ? 0.5 : 1.0;
                        document.getElementById('slow-icon-container').innerHTML = isSlow ? normalIcon : slowIcon;
                    }

                    function rewindVideo() {
                        videoPlayer.currentTime = Math.max(0, videoPlayer.currentTime - 5);
                        videoPlayer.play();
                    }

                    function forwardVideo() {
                        videoPlayer.currentTime = Math.min(videoPlayer.duration || 0, videoPlayer.currentTime + 5);
                        videoPlayer.play();
                    }
                </script>

            </div>
        </div>

        <!-- Tombol Aksi (Visual-Only - Centered for better UX) -->
        <div class="w-full max-w-5xl flex justify-center gap-12 items-center mt-8 px-4">
            <!-- Tombol Keluar & Simpan (Visual House Icon) -->
            <div class="relative group/tooltip">
                <!-- RUTE DIPERBAIKI DENGAN SLUG (Kembali ke Peta) -->
                <a href="{{ route('materi.index', ['mapel_slug' => $mapel->slug]) }}" onclick="tandaiSelesai(event, this.href, 1)"
                    class="bg-[#FFB3B3] w-20 h-20 flex items-center justify-center brutal-border brutal-shadow-sm brutal-hover text-black rounded-full transform hover:-translate-y-2 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-10 h-10 text-black" fill="#FFB3B3" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                        <polyline points="9 22 9 12 15 12 15 22" />
                    </svg>
                </a>
                <div class="pointer-events-none absolute bottom-full left-1/2 -translate-x-1/2 mb-3 bg-[#FFD1E3] brutal-border brutal-shadow-sm px-3 py-1.5 rounded-lg text-sm font-bold opacity-0 scale-95 group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-150 whitespace-nowrap z-50 text-black">
                    Keluar & Simpan
                </div>
            </div>

            <!-- Tombol Lanjut (Visual Right Chevron Play Icon) -->
            <div class="relative group/tooltip">
                <!-- RUTE DIPERBAIKI DENGAN SLUG -->
                <a href="{{ route('materi.belajar', ['mapel_slug' => $mapel->slug, 'step' => 2]) }}" onclick="tandaiSelesai(event, this.href, 1)"
                    class="bg-[#D4F1BE] w-20 h-20 flex items-center justify-center brutal-border brutal-shadow-sm brutal-hover text-black rounded-full transform hover:-translate-y-2 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-10 h-10 text-black" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="5 3 19 12 5 21 5 3" fill="#D4F1BE" />
                    </svg>
                </a>
                <div class="pointer-events-none absolute bottom-full left-1/2 -translate-x-1/2 mb-3 bg-[#FFF5B8] brutal-border brutal-shadow-sm px-3 py-1.5 rounded-lg text-sm font-bold opacity-0 scale-95 group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-150 whitespace-nowrap z-50 text-black">
                    Lanjut
                </div>
            </div>
        </div>

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
                    score: 0
                })
            }).then(() => {
                window.location.href = nextUrl; // Kalau sukses simpan, baru pindah halaman
            }).catch(() => {
                window.location.href = nextUrl; // Kalau internet nge-lag, tetap izinkan pindah halaman
            });
        }
    </script>

</x-student-layout>