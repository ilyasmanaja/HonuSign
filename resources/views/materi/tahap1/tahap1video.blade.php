<x-student-layout>

    <!-- Main Container Wrapper -->
    <div class="max-w-5xl mx-auto w-full px-4 py-8 md:py-12 flex flex-col items-center">

        <!-- Progress Bar & Navigasi -->
        <div class="w-full mb-10">
            <!-- Header Kembali (Visual-Only) -->
            <div class="w-full mb-8 flex justify-start">
                <a href="{{ route('materi.belajar', ['step' => 1]) }}"
                    class="bg-[#FFB3B3] w-16 h-16 flex items-center justify-center brutal-border brutal-shadow-sm brutal-hover text-black rounded-full transform hover:-translate-y-2 transition-transform z-10"
                    title="Kembali ke Cerita">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10">
                        <circle cx="12" cy="12" r="10" opacity="0.2" />
                        <path d="M14 7l-5 5 5 5V7z" fill="currentColor" />
                    </svg>
                </a>
            </div>

            <!-- Progress Bar -->
            <div class="w-full max-w-3xl mx-auto">
                <div class="flex flex-col md:flex-row justify-between mb-4 items-start md:items-end gap-3">
                    <span class="font-black text-xl md:text-2xl tracking-widest uppercase text-black">Video
                        Peragaan</span>
                </div>
                <div class="w-full h-8 bg-white brutal-border brutal-shadow-sm rounded-2xl overflow-hidden p-1">
                    <div class="h-full bg-[#BEE9E8] rounded-xl transition-all duration-1000 border-r-4 border-black"
                        style="width: 16.6%"></div>
                </div>
            </div>
        </div>

        <!-- Header Judul Materi -->
        <div class="text-center mb-10">
            <h1
                class="text-4xl md:text-6xl font-black text-[#FFF5B8] text-outline uppercase tracking-tighter transform -rotate-1 drop-shadow-[0_6px_0_#000]">
                Festival Budaya Kemerdekaan Indonesia
            </h1>
        </div>

        <!-- Player Video -->
        <div
            class="w-full max-w-4xl bg-[#BEE9E8] brutal-border brutal-shadow rounded-[3rem] overflow-hidden flex flex-col relative">
            <!-- Mac window style top bar -->
            <div class="bg-white border-b-4 border-black px-6 py-4 flex items-center gap-3">
                <span class="w-4 h-4 md:w-5 md:h-5 rounded-full bg-[#FF6B6B] border-2 border-black"></span>
                <span class="w-4 h-4 md:w-5 md:h-5 rounded-full bg-[#FFF5B8] border-2 border-black"></span>
                <span class="w-4 h-4 md:w-5 md:h-5 rounded-full bg-[#D4F1BE] border-2 border-black"></span>
                <span class="ml-3 font-black text-sm md:text-base uppercase tracking-widest text-slate-700">Pemutar
                    Video SIBI</span>
            </div>

            <div class="flex-grow flex flex-col items-center justify-center p-6 md:p-10 bg-[#FFFEFA] relative">

                <!-- Video Player -->
                <div
                    class="w-full bg-black brutal-border brutal-shadow-sm rounded-3xl p-4 mb-8 flex items-center justify-center aspect-video relative overflow-hidden max-w-3xl">
                    <video id="sibi-video" controls class="w-full h-full object-cover rounded-2xl z-10">
                        <source src="{{ asset('videos/peragaan_sibi.mp4') }}" type="video/mp4">
                        Browser kamu tidak mendukung tag video.
                    </video>
                </div>

                <!-- Kontrol Video Khusus Tunarungu (Visual-Only) -->
                <div class="flex justify-center gap-6 w-full max-w-md mt-4">
                    <!-- Rewind 5 seconds (5-) -->
                    <button type="button" onclick="rewindVideo()"
                        class="bg-[#FFD1E3] w-20 h-20 flex items-center justify-center brutal-border brutal-shadow-sm brutal-hover text-black rounded-full transform hover:-translate-y-2 transition-transform cursor-pointer"
                        title="Mundur 5 Detik">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-12 h-12">
                            <circle cx="12" cy="12" r="10" opacity="0.2" fill="currentColor" />
                            <path d="M12.5 7.5v3.66l-4.5-3.37v8.42l4.5-3.37v3.66l6-4.5-6-4.5z" fill="currentColor" />
                            <text x="12" y="19" font-family="'Nunito', 'Fredoka', sans-serif" font-size="6" font-weight="900" text-anchor="middle" fill="currentColor">-5</text>
                        </svg>
                    </button>

                    <!-- Speed Toggle (0.5x / 1x) -->
                    <button type="button" id="btn-slow" onclick="toggleSlowMotion()"
                        class="bg-[#FFF5B8] w-20 h-20 flex items-center justify-center brutal-border brutal-shadow-sm brutal-hover text-black rounded-full transform hover:-translate-y-2 transition-transform cursor-pointer"
                        title="Percepat / Perlambat">
                        <span id="slow-icon-container">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-12 h-12">
                                <circle cx="12" cy="12" r="10" opacity="0.2" fill="currentColor" />
                                <path d="M12 3a9 9 0 0 0-9 9c0 1.25.25 2.44.7 3.53l1.45-1.45A5.996 5.996 0 0 1 12 6c3.31 0 6 2.69 6 6 0 1.27-.4 2.44-1.07 3.42l1.45 1.45A8.929 8.929 0 0 0 21 12a9 9 0 0 0-9-9zM12 8a4 4 0 0 0-4 4c0 .87.28 1.67.76 2.33l4.67-4.67A3.946 3.946 0 0 0 12 8z" fill="currentColor" />
                                <text x="12" y="19" font-family="'Nunito', 'Fredoka', sans-serif" font-size="6" font-weight="900" text-anchor="middle" fill="currentColor">0.5x</text>
                            </svg>
                        </span>
                    </button>

                    <!-- Forward 5 seconds (5+) -->
                    <button type="button" onclick="forwardVideo()"
                        class="bg-[#D4F1BE] w-20 h-20 flex items-center justify-center brutal-border brutal-shadow-sm brutal-hover text-black rounded-full transform hover:-translate-y-2 transition-transform cursor-pointer"
                        title="Maju 5 Detik">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-12 h-12">
                            <circle cx="12" cy="12" r="10" opacity="0.2" fill="currentColor" />
                            <path d="M11.5 7.5v3.66l4.5-3.37v8.42l-4.5-3.37v3.66l-6-4.5 6-4.5z" fill="currentColor" />
                            <text x="12" y="19" font-family="'Nunito', 'Fredoka', sans-serif" font-size="6" font-weight="900" text-anchor="middle" fill="currentColor">+5</text>
                        </svg>
                    </button>
                </div>

                <!-- Script untuk interaksi tombol video -->
                <script>
                    const videoPlayer = document.getElementById('sibi-video');
                    let isSlow = false;

                    const slowIcon = `
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-12 h-12">
                            <circle cx="12" cy="12" r="10" opacity="0.2" fill="currentColor" />
                            <path d="M12 3a9 9 0 0 0-9 9c0 1.25.25 2.44.7 3.53l1.45-1.45A5.996 5.996 0 0 1 12 6c3.31 0 6 2.69 6 6 0 1.27-.4 2.44-1.07 3.42l1.45 1.45A8.929 8.929 0 0 0 21 12a9 9 0 0 0-9-9zM12 8a4 4 0 0 0-4 4c0 .87.28 1.67.76 2.33l4.67-4.67A3.946 3.946 0 0 0 12 8z" fill="currentColor" />
                            <text x="12" y="19" font-family="'Nunito', 'Fredoka', sans-serif" font-size="6" font-weight="900" text-anchor="middle" fill="currentColor">0.5x</text>
                        </svg>
                    `;

                    const normalIcon = `
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-12 h-12">
                            <circle cx="12" cy="12" r="10" opacity="0.2" fill="currentColor" />
                            <path d="M12 3a9 9 0 0 0-9 9c0 1.25.25 2.44.7 3.53l1.45-1.45A5.996 5.996 0 0 1 12 6c3.31 0 6 2.69 6 6 0 1.27-.4 2.44-1.07 3.42l1.45 1.45A8.929 8.929 0 0 0 21 12a9 9 0 0 0-9-9zM12 8a4 4 0 0 0-4 4c0 .87.28 1.67.76 2.33l4.67-4.67A3.946 3.946 0 0 0 12 8z" fill="currentColor" />
                            <text x="12" y="19" font-family="'Nunito', 'Fredoka', sans-serif" font-size="6" font-weight="900" text-anchor="middle" fill="currentColor">1.0x</text>
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
            <a href="{{ route('materi.index') }}" onclick="tandaiSelesai(event, this.href, 1)"
                class="bg-[#FFB3B3] w-20 h-20 flex items-center justify-center brutal-border brutal-shadow-sm brutal-hover text-black rounded-full transform hover:-translate-y-2 transition-transform"
                title="Keluar & Simpan">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10">
                    <path opacity="0.2" d="M12 3L2 12h3v8h14v-8h3L12 3z" />
                    <path d="M12 3L2 12h3v8h14v-8h3L12 3zm0 2.83L18.17 12H17v6H7v-6H5.83L12 5.83z"
                        fill="currentColor" />
                </svg>
            </a>

            <!-- Tombol Lanjut (Visual Right Chevron Play Icon) -->
            <a href="{{ route('materi.belajar', ['step' => 2]) }}" onclick="tandaiSelesai(event, this.href, 1)"
                class="bg-[#D4F1BE] w-20 h-20 flex items-center justify-center brutal-border brutal-shadow-sm brutal-hover text-black rounded-full transform hover:-translate-y-2 transition-transform"
                title="Lanjut">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-12 h-12">
                    <circle cx="12" cy="12" r="10" opacity="0.2" />
                    <path d="M10 17V7l7 5-7 5z" fill="currentColor" />
                </svg>
            </a>
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
