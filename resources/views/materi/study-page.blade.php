<x-student-layout>
    <style>
        /* Brutal Grid Pattern Background */
        .brutal-grid-bg {
            background-color: #BEE9E8;
            background-image: radial-gradient(#000000 1.5px, transparent 1.5px);
            background-size: 25px 25px;
        }

        /* Garis Konektor Putus-Putus */
        .path-line {
            position: absolute;
            z-index: 0;
            border-left: 6px dashed #000;
        }

        /* Animasi Mengambang Lembut untuk Samsul */
        .hover-samsul {
            animation: samsul-float 2s ease-in-out infinite;
        }

        @keyframes samsul-float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }
    </style>

    <?php
// Simulasi progres aktif dari backend
$activePos = request('step', 1);

$posData = [
    1 => ['title' => 'Membaca Cerita', 'desc' => 'Cerita bergambar SIBI', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8 text-blue-500"><path opacity="0.2" d="M12 3v18c-3.333-1-5-1-8-1a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2c3 0 4.667 0 8 0z" /><path d="M12 3v18c3.333-1 5-1 8-1a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2c-3 0-4.667 0-8 0z" /></svg>', 'route' => route('materi.belajar', ['step' => 1])],
    2 => ['title' => 'Kosa Kata Visual', 'desc' => 'Mengenal isyarat baru', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8 text-purple-500"><path opacity="0.2" d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5z" /><circle cx="12" cy="12" r="3" /></svg>', 'route' => route('materi.belajar', ['step' => 2])],
    3 => ['title' => 'Praktik Kamera', 'desc' => 'Coba isyaratmu ke AI!', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8 text-pink-500"><path opacity="0.2" d="M3 8a2 2 0 0 1 2-2h3l1.5-2h5L16 6h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8z" /><circle cx="12" cy="13" r="3" /></svg>', 'route' => route('materi.belajar', ['step' => 3])],
    4 => ['title' => 'Tebak Isyarat', 'desc' => 'Kuis seru bergambar', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8 text-yellow-500"><path opacity="0.2" d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12c0 1.84.5 3.56 1.36 5.04L2 22l4.96-1.36A9.957 9.957 0 0 0 12 22z" /><path d="M12 17.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm.5-4.5c0-1.5 2-2 2-4a2.5 2.5 0 1 0-5 0h2c0-.5.5-1 1-1s1 .5 1 1-1 1.5-1 3.5h2z" /></svg>', 'route' => route('materi.belajar', ['step' => 4])],
    5 => ['title' => 'Bermain Memori', 'desc' => 'Cocokkan kartu isyarat', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8 text-green-500"><path opacity="0.2" d="M4 6h12v12H4z" /><path d="M8 4h12v12h-2v2h4V2H6v4h2z" /></svg>', 'route' => route('materi.belajar', ['step' => 5])],
    6 => ['title' => 'Ujian Akhir', 'desc' => 'Buktikan kemampuanmu!', 'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8 text-orange-500"><path opacity="0.2" d="M7 4h10v6a5 5 0 0 1-10 0V4z" /><path d="M11 15v4h-3v2h8v-2h-3v-4a7.02 7.02 0 0 0 4.9-5.32A3.5 3.5 0 0 0 20.5 7H18V4H6v3H3.5a3.5 3.5 0 0 0 2.6 4.68A7.02 7.02 0 0 0 11 15zM5 7h1v3H5V7zm13 3V7h1v3h-1z" /></svg>', 'route' => route('materi.belajar', ['step' => 6])],
];
    ?>

    <!-- Intro Overlay -->
    <div id="intro-overlay"
        class="fixed inset-0 z-[9999] bg-[#FFFEFA] flex flex-col items-center justify-center transition-opacity duration-1000 ease-in-out">
        <div class="text-center px-6">
            <div
                class="inline-block px-6 py-2 bg-[#FFF5B8] brutal-border brutal-shadow-sm rounded-2xl text-black text-sm font-bold mb-6 -rotate-2">
                Perjalanan Belajar
            </div>
            <h1
                class="text-6xl md:text-8xl font-black text-black text-outline transform -rotate-2 animate-bounce text-center drop-shadow-[0_10px_0_rgba(0,0,0,0.15)]">
                Perjalanan Samsul
            </h1>
            <p
                class="mt-6 text-2xl font-bold text-slate-500 bg-[#BEE9E8] brutal-border brutal-shadow-sm px-6 py-2 rounded-2xl inline-block rotate-1">
                Ayo Selesaikan Misimu!</p>
        </div>
    </div>

    <div class="brutal-grid-bg min-h-[calc(100vh-5rem)] w-full py-12 px-4 md:px-8 overflow-x-hidden relative">

        <div class="text-center mb-16 relative z-10">
            <div
                class="inline-block bg-[#FFF5B8] brutal-border brutal-shadow-sm px-6 py-2 rounded-2xl font-black text-black text-sm md:text-base uppercase tracking-widest mb-4 transform -rotate-2">
                Peta Perjalanan
            </div>
            <h1
                class="text-5xl md:text-7xl font-black text-white text-outline tracking-tighter drop-shadow-[0_8px_0_#000] transform rotate-1 uppercase">
                Petualangan Samsul!
            </h1>
        </div>

        <div class="max-w-4xl mx-auto relative pt-8 pb-48">

            <div class="path-line top-0 bottom-40 left-8 md:left-1/2 md:-translate-x-[3px]"></div>

            <div class="flex flex-col gap-16 md:gap-24 relative z-10">

                @foreach ($posData as $index => $pos)
                                <?php
                    $isCompleted = $index < $activePos;
                    $isActive = $index == $activePos;
                    $isLocked = $index > $activePos;

                    // Penentuan Warna dan Gaya berdasarkan Status
                    $bgColor = $isCompleted ? 'bg-[#D4F1BE]' : ($isActive ? 'bg-[#FFFEFA]' : 'bg-slate-200');
                    $borderColor = $isLocked ? 'border-slate-400 border-dashed' : 'border-black';

                    // Rotasi Asimetris Komik
                    $rotation = $index % 2 == 0 ? 'rotate-1' : '-rotate-1';

                    // Pengaturan Posisi Grid Tangguh (Kiri-Kanan Desktop, Menyesuaikan di Mobile)
                    $layoutClass = $index % 2 == 0 ? 'md:flex-row' : 'md:flex-row-reverse';
                    $alignClass = $index % 2 == 0 ? 'md:pr-16 md:text-right' : 'md:pl-16 md:text-left';
                                                                                                                                                                                                                                                                                                                                                    ?>

                                <div
                                    class="relative flex flex-col md:flex-row items-center w-full {{ $layoutClass }} pl-20 pr-4 md:px-0">

                                    <!-- Anchor Koordinat untuk Samsul -->
                                    <div id="pos-dot-{{ $index }}"
                                        class="absolute left-8 md:left-1/2 transform -translate-x-1/2 w-2 h-2 z-20 flex items-center justify-center text-sm font-black">
                                    </div>

                                    <div class="w-full md:w-1/2 {{ $alignClass }} relative">
                                        <a href="{{ $isLocked ? '#' : $pos['route'] }}"
                                            class="block w-full {{ $bgColor }} border-4 {{ $borderColor }} rounded-[2rem] p-5 md:p-6 transform {{ $rotation }} {{ $isLocked ? 'cursor-not-allowed opacity-75' : 'hover:-translate-y-2 brutal-hover transition-transform brutal-shadow' }} relative z-10 group">

                                            <div class="flex items-center gap-4 {{ $index % 2 == 0 ? 'md:flex-row-reverse' : '' }}">
                                                <div
                                                    class="w-14 h-14 shrink-0 rounded-2xl brutal-border flex items-center justify-center text-2xl {{ $isCompleted ? 'bg-white' : ($isActive ? 'bg-[#BEE9E8]' : 'bg-slate-300 grayscale') }} transform group-hover:rotate-6 transition-transform">
                                                    {!! $pos['icon'] !!}
                                                </div>

                                                <div class="flex-grow {{ $index % 2 == 0 ? 'md:text-right' : 'md:text-left' }}">
                                                    <div
                                                        class="text-[10px] md:text-xs font-black uppercase tracking-widest mb-1 {{ $isCompleted ? 'text-green-700' : ($isActive ? 'text-pink-600' : 'text-slate-500') }}">
                                                        Pos {{ $index }} •
                                                        @if($isCompleted) Selesai
                                                        @elseif($isActive) Jalur Aktif
                                                        @else Terkunci
                                                        @endif
                                                    </div>
                                                    <h3 class="text-lg md:text-2xl font-black text-black leading-tight mb-0.5">
                                                        {{ $pos['title'] }}
                                                    </h3>
                                                    <p class="text-xs md:text-sm font-bold text-slate-600 leading-tight">
                                                        {{ $pos['desc'] }}
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="hidden md:block w-1/2"></div>

                                </div>
                @endforeach

            </div>

            <!-- Samsul Animasi -->
            <div id="animated-samsul"
                class="absolute z-30 flex flex-col items-center pointer-events-none transition-all" style="opacity: 0;">
                <div id="samsul-bubble"
                    class="bg-white brutal-border px-3 py-0.5 rounded-full text-[10px] md:text-xs font-black text-black whitespace-nowrap brutal-shadow-sm mb-1 transform -rotate-3 opacity-0 transition-opacity duration-500">
                    KLIK POS INI!
                </div>
                <img src="{{ asset('images/keSekolah/samsul.png') }}" alt="Samsul"
                    class="w-20 md:w-28 drop-shadow-lg transform scale-x-[-1]">
            </div>

            <div id="finish-school"
                class="absolute bottom-0 left-8 md:left-1/2 transform -translate-x-1/2 z-20 flex flex-col items-center w-full max-w-xs text-center">
                <div
                    class="bg-[#FFF5B8] brutal-border brutal-shadow-sm px-5 py-1.5 rounded-full font-black text-xs md:text-sm mb-4 uppercase tracking-widest transform rotate-2 text-black">
                    🏁 Sekolah SLB (Garis Akhir)
                </div>
                <img src="{{ asset('images/keSekolah/SLB.png') }}"
                    class="w-44 md:w-56 h-auto drop-shadow-2xl filter transform hover:scale-105 transition-transform"
                    alt="Sekolah SLB">
            </div>

        </div>
    </div>

    <!-- Interactive Visual Tutorial Overlay -->
    <div id="tutorial-overlay"
        class="fixed inset-0 bg-slate-900/80 backdrop-blur-md z-[5000] flex items-center justify-center p-4 transition-opacity duration-500 opacity-0 pointer-events-none">
        <div class="bg-[#FFFEFA] brutal-border brutal-shadow p-8 md:p-12 rounded-[3rem] max-w-xl w-full flex flex-col items-center text-center relative transform scale-90 transition-transform duration-500"
            id="tutorial-modal-content">

            <div
                class="bg-[#FFF5B8] px-6 py-2 rounded-2xl brutal-border brutal-shadow-sm font-black text-sm mb-6 -rotate-2 text-black">
                TUTORIAL SINGKAT
            </div>

            <h2 class="text-3xl md:text-4xl font-black text-black tracking-tight mb-6">
                Cara Belajar di Peta!
            </h2>

            <!-- Animasi Simulasi Peta & Klik -->
            <div
                class="relative w-64 h-64 bg-[#BEE9E8] brutal-border rounded-3xl p-4 flex flex-col items-center mb-8 mx-auto overflow-hidden shadow-inner pt-8">
                <!-- Jalur Garis -->
                <div
                    class="absolute top-0 bottom-0 left-1/2 border-l-4 border-dashed border-black transform -translate-x-1/2 z-0">
                </div>

                <!-- Pos 1 (Awal) -->
                <div class="w-full flex items-center justify-start relative z-10 mb-12">
                    <!-- Anchor 1 -->

                    <!-- Samsul Mini -->
                    <div id="sim-samsul"
                        class="absolute left-1/2 transform -translate-x-1/2 -translate-y-8 z-20 transition-all duration-1000"
                        style="top: 0px;">
                        <img src="{{ asset('images/keSekolah/samsul.png') }}"
                            class="w-10 h-auto transform scale-x-[-1]">
                    </div>

                    <div id="sim-card-1"
                        class="w-3/4 ml-auto bg-[#FFFEFA] border-2 border-black rounded-xl p-2 text-[10px] font-black transition-all duration-300">
                        Pos 1</div>
                </div>

                <!-- Pos 2 (Tujuan) -->
                <div class="w-full flex items-center justify-start relative z-10">
                    <!-- Anchor 2 -->
                    <!-- Card Pos 2 -->
                    <div id="sim-card-2"
                        class="w-3/4 mr-auto bg-slate-200 border-2 border-dashed border-slate-400 rounded-xl p-2 text-[10px] font-black text-right transition-all duration-300 text-slate-500">
                        Pos 2</div>
                </div>

                <!-- Tangan Animasi Cursor -->
                <div id="sim-cursor"
                    class="absolute w-8 h-8 transition-all duration-700 pointer-events-none z-50 flex items-center justify-center text-3xl"
                    style="top: 100%; left: 50%; opacity: 0; transform: translate(-50%, -50%);">
                    👆
                </div>
            </div>

            <!-- Penjelasan Teks -->
            <div class="flex flex-col gap-4 text-left w-full bg-[#F8FAFC] brutal-border p-6 rounded-2xl mb-8 shadow-sm">
                <div class="flex items-start gap-3">
                    <span
                        class="bg-[#FFF5B8] w-8 h-8 rounded-xl brutal-border flex items-center justify-center font-black text-black text-sm shrink-0 mt-0.5">1</span>
                    <p class="font-bold text-slate-700 text-sm md:text-base">Samsul akan <b>berjalan ke Pos</b> yang
                        harus kamu selesaikan.</p>
                </div>
                <div class="flex items-start gap-3">
                    <span
                        class="bg-[#D4F1BE] w-8 h-8 rounded-xl brutal-border flex items-center justify-center font-black text-black text-sm shrink-0 mt-0.5">2</span>
                    <p class="font-bold text-slate-700 text-sm md:text-base"><b>Tap (Klik) kartu Pos tersebut</b> untuk
                        mulai belajar dan melaju ke pos berikutnya!</p>
                </div>
            </div>

            <button onclick="closeTutorial()"
                class="w-full md:w-auto bg-[#D4F1BE] text-black font-black text-lg md:text-xl px-10 py-4 rounded-3xl brutal-border brutal-shadow-sm brutal-hover">
                OKE, AKU MENGERTI!
            </button>
        </div>
    </div>

    <script>
        const activePos = {{ $activePos }};
        const samsul = document.getElementById('animated-samsul');
        let tutorialAnimTimer = null;

        document.addEventListener('DOMContentLoaded', () => {
            // Hilangkan intro overlay setelah 2 detik
            setTimeout(() => {
                const overlay = document.getElementById('intro-overlay');
                if (overlay) {
                    overlay.style.opacity = '0';
                    setTimeout(() => {
                        overlay.remove();
                        // Tampilkan tutorial hanya jika ini Pos 1
                        if (activePos === 1) {
                            showTutorial();
                        } else {
                            // Langsung jalankan animasi pergerakan Samsul
                            animateSamsulToPos();
                        }
                    }, 1000); // Tunggu animasi fade-out selesai
                }
            }, 2000);
        });

        function animateSamsulToPos() {
            if (!samsul) return;

            // Cari elemen titik pos saat ini
            const targetDot = document.getElementById('pos-dot-' + activePos);

            if (targetDot) {
                // Gunakan position top left dari offsetParent (quest-map container)
                const dotTop = targetDot.offsetTop;
                const dotLeft = targetDot.offsetLeft;

                // Jika Pos 1, Samsul datang dari langit (atas). Jika Pos > 1, Samsul datang dari pos sebelumnya
                let startTop = 0;
                let startLeft = 0;

                if (activePos === 1) {
                    startTop = dotTop - 300; // Mulai dari atas jauh
                    startLeft = dotLeft;
                } else {
                    const prevDot = document.getElementById('pos-dot-' + (activePos - 1));
                    if (prevDot) {
                        startTop = prevDot.offsetTop;
                        startLeft = prevDot.offsetLeft;
                    } else {
                        startTop = dotTop - 300;
                        startLeft = dotLeft;
                    }
                }

                // Atur posisi awal Samsul
                samsul.style.transition = 'none';
                samsul.style.top = startTop + 'px';
                samsul.style.left = startLeft + 'px';
                // Geser sedikit agar titik tengah bawah gambar pas dengan dot
                samsul.style.transform = 'translate(-50%, -100%)';
                samsul.style.opacity = '1';

                // Paksa reflow
                void samsul.offsetWidth;

                // Mulai Animasi Perjalanan
                samsul.style.transition = 'top 2s cubic-bezier(0.25, 0.8, 0.25, 1), left 2s cubic-bezier(0.25, 0.8, 0.25, 1)';

                setTimeout(() => {
                    samsul.style.top = (dotTop + 10) + 'px'; // +10 agar terlihat menapak di titik
                    samsul.style.left = dotLeft + 'px';

                    // Setelah sampai
                    setTimeout(() => {
                        // Tambahkan animasi melayang
                        samsul.style.transition = 'none';
                        samsul.classList.add('hover-samsul');
                        // Tampilkan bubble chat
                        document.getElementById('samsul-bubble').style.opacity = '1';
                    }, 2000);
                }, 100);
            }
        }

        function runTutorialAnimation() {
            const cursor = document.getElementById('sim-cursor');
            const samsul = document.getElementById('sim-samsul');
            const card1 = document.getElementById('sim-card-1');
            const card2 = document.getElementById('sim-card-2');

            if (!cursor || !samsul || !card1 || !card2) return;

            // Reset
            cursor.style.transition = 'none';
            cursor.style.top = '100%';
            cursor.style.left = '50%';
            cursor.style.opacity = '0';
            cursor.style.transform = 'translate(-50%, -50%) scale(1)';

            samsul.style.transition = 'none';
            samsul.style.top = '0px';

            card1.className = 'w-3/4 ml-auto bg-[#FFFEFA] border-2 border-black rounded-xl p-2 text-[10px] font-black transition-all duration-300';
            card1.innerText = 'Pos 1';

            card2.className = 'w-3/4 mr-auto bg-slate-200 border-2 border-dashed border-slate-400 rounded-xl p-2 text-[10px] font-black text-right transition-all duration-300 text-slate-500';
            card2.innerText = 'Pos 2';

            // Paksa Reflow
            void cursor.offsetWidth;
            void samsul.offsetWidth;

            // Kursor Muncul & Bergerak ke Kartu 1
            setTimeout(() => {
                cursor.style.transition = 'all 1s ease-out';
                cursor.style.opacity = '1';
                cursor.style.top = '30%'; // Menuju kartu 1 (atas)
                cursor.style.left = '65%'; // Menuju kartu kanan
            }, 500);

            // Kursor Klik Kartu 1
            setTimeout(() => {
                cursor.style.transform = 'translate(-50%, -50%) scale(0.8)';
                card1.classList.add('ring-4', 'ring-sky-400');
            }, 1600);

            // Kartu 1 Selesai (Ceklis)
            setTimeout(() => {
                cursor.style.transform = 'translate(-50%, -50%) scale(1)';
                card1.classList.replace('bg-[#FFFEFA]', 'bg-[#D4F1BE]');
                card1.innerText = 'Pos 1 ✓';

                // Cursor menghilang
                cursor.style.opacity = '0';
            }, 1900);

            // Samsul pindah ke Pos 2 & Pos 2 Aktif
            setTimeout(() => {
                samsul.style.transition = 'top 1s cubic-bezier(0.25, 0.8, 0.25, 1)';
                samsul.style.top = '72px'; // Jarak ke pos 2

                card2.className = 'w-3/4 mr-auto bg-[#FFFEFA] border-2 border-black rounded-xl p-2 text-[10px] font-black text-right transition-all duration-300';
                card2.innerText = 'Pos 2';
            }, 2500);
        }

        function showTutorial() {
            const overlay = document.getElementById('tutorial-overlay');
            const content = document.getElementById('tutorial-modal-content');
            if (!overlay || !content) return;

            overlay.classList.remove('opacity-0', 'pointer-events-none');
            overlay.classList.add('opacity-100', 'pointer-events-auto');
            content.classList.remove('scale-90');
            content.classList.add('scale-100');

            runTutorialAnimation();
            clearInterval(tutorialAnimTimer);
            tutorialAnimTimer = setInterval(runTutorialAnimation, 4500);
        }

        function closeTutorial() {
            const overlay = document.getElementById('tutorial-overlay');
            const content = document.getElementById('tutorial-modal-content');
            if (!overlay || !content) return;

            overlay.classList.remove('opacity-100', 'pointer-events-auto');
            overlay.classList.add('opacity-0', 'pointer-events-none');
            content.classList.remove('scale-100');
            content.classList.add('scale-90');

            clearInterval(tutorialAnimTimer);

            // Setelah tutorial ditutup, jalankan animasi Samsul jalan dari awal
            setTimeout(() => {
                animateSamsulToPos();
            }, 500);
        }
    </script>
</x-student-layout>