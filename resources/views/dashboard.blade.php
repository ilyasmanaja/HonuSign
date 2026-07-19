<x-student-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Fredoka:wght@400;500;600;700&display=swap');

        .dashboard-container {
            font-family: 'Fredoka', sans-serif;
        }

        .dashboard-container * {
            font-family: 'Fredoka', sans-serif;
        }

        body {
            background-color: #FFFEFA;
        }

        /* ── Brutalism core ── */
        .bb {
            border: 4px solid #000;
        }

        .bs {
            box-shadow: 6px 6px 0 #000;
        }

        .bs-sm {
            box-shadow: 3px 3px 0 #000;
        }

        .bh {
            transition: all 0.15s ease-in-out;
        }

        /* Large card hover/active */
        .bs.bh:hover {
            transform: translate(-4px, -4px);
            box-shadow: 10px 10px 0 #000;
        }

        .bs.bh:active {
            transform: translate(2px, 2px);
            box-shadow: 4px 4px 0 #000;
        }

        /* Small element hover/active */
        .bs-sm.bh:hover {
            transform: translate(-2px, -2px);
            box-shadow: 5px 5px 0 #000;
        }

        .bs-sm.bh:active {
            transform: translate(1px, 1px);
            box-shadow: 2px 2px 0 #000;
        }

        /* Elevated card hover/active adjustments */
        @media (min-width: 768px) {
            .menu-card.md\:-translate-y-5.bh:hover {
                transform: translateY(-24px) translateX(-4px);
                box-shadow: 10px 10px 0 #000;
            }

            .menu-card.md\:-translate-y-5.bh:active {
                transform: translateY(-18px) translateX(2px);
                box-shadow: 4px 4px 0 #000;
            }
        }

        .text-stamp {
            text-shadow: -2px -2px 0 #000, 2px -2px 0 #000,
                -2px 2px 0 #000, 2px 2px 0 #000,
                3px 3px 0 #000;
        }

        /* Card image zoom */
        .card-img {
            transition: transform 0.4s ease;
        }

        .menu-card:hover .card-img {
            transform: scale(1.08);
        }

        /* Floating animation */
        @keyframes float-y {

            0%,
            100% {
                transform: translateY(0) rotate(var(--r, 0deg));
            }

            50% {
                transform: translateY(-10px) rotate(var(--r, 0deg));
            }
        }

        .float {
            animation: float-y 4s ease-in-out infinite;
        }

        /* Greeting highlight */
        .greeting-tag {
            display: inline-block;
            background: #FFF5B8;
            border: 3px solid #000;
            box-shadow: 3px 3px 0 #000;
            border-radius: 1.5rem;
            padding: 0.3rem 1.2rem;
            transform: rotate(-2deg);
        }
    </style>

    <div class="dashboard-container relative">
        <div class="fixed top-5 left-5 z-[60] group/tooltip">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('dashboard') }}"
                    class="w-12 h-12 bg-[#BEE9E8] text-black bb bs-sm bh rounded-xl flex items-center justify-center"
                    aria-label="Kembali">
                    <svg class="w-6 h-6 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 12H5M12 19l-7-7 7-7" />
                    </svg>
                </a>
            </form>
            <div
                class="pointer-events-none absolute left-14 top-1/2 -translate-y-1/2 bg-[#FFF5B8] bb bs-sm px-3 py-1.5 rounded-lg text-sm font-bold opacity-0 scale-95 group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-150 whitespace-nowrap z-50 text-black">
                Kembali
            </div>
        </div>

        <div class="min-h-screen w-full flex flex-col items-center justify-center py-20 px-6">

            <div class="pointer-events-none fixed top-20 right-10 w-24 h-24 rounded-full bg-[#FFD1E3] bb opacity-40 float"
                style="--r:-8deg;animation-delay:0s;"></div>
            <div class="pointer-events-none fixed bottom-16 left-8 w-16 h-16 rounded-full bg-[#BEE9E8] bb opacity-40 float"
                style="--r:6deg;animation-delay:1.5s;"></div>
            <div class="pointer-events-none fixed top-1/2 left-14 w-10 h-10 rounded-full bg-[#FFF5B8] bb opacity-50 float"
                style="--r:-5deg;animation-delay:0.8s;"></div>

            <div class="text-center mb-10 z-10">
                <h1 class="text-4xl md:text-5xl font-bold text-black tracking-tight leading-tight mb-4">
                    Halo,
                    <span class="greeting-tag text-black">{{ auth()->user()->name }}</span>
                    !
                </h1>
                <h2 class="text-2xl md:text-3xl font-bold text-slate-900 mt-2">
                    Selamat Belajar {{ $mapel->nama }}
                </h2>
                <p class="text-lg font-bold text-slate-900 mt-2">Pilih menu di bawah untuk memulai aktivitasmu.</p>
            </div>

            <div class="w-full max-w-6xl grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8 items-end z-10">

                <a href="{{ route('general.index') }}"
                    class="menu-card bh block bg-[#FFD1E3] bb bs rounded-[2.5rem] overflow-hidden group">
                    <div class="h-44 md:h-48 overflow-hidden bg-[#FFFEFA] bb border-t-0 border-l-0 border-r-0 relative">
                        <img src="{{ asset('images/page/fun&play.png') }}" alt="Fun & Play"
                            class="card-img w-full h-full object-cover"
                            onerror="this.src='https://via.placeholder.com/400x300?text=Fun+%26+Play'" />
                        <div
                            class="absolute text-black top-4 right-4 bg-[#FFD1E3] bb bs-sm px-3 py-1 rounded-xl text-sm font-bold">
                            Game</div>
                    </div>
                    <div class="p-6 text-center">
                        <span class="text-2xl md:text-3xl font-bold text-black uppercase tracking-tight">Bermain</span>
                        <p class="text-sm md:text-base font-medium text-black/60 mt-2">Main game seru sambil belajar!
                        </p>
                    </div>
                </a>

                <a href="{{ route('materi.index', ['mapel_slug' => $mapel->slug]) }}"
                    class="menu-card bh block bg-[#D4F1BE] bb bs rounded-[2.5rem] overflow-hidden group lg:-translate-y-5">
                    <div class="h-44 md:h-48 overflow-hidden bg-[#FFFEFA] bb border-t-0 border-l-0 border-r-0 relative">
                        <img src="{{ asset('images/page/studies.png') }}" alt="Study"
                            class="card-img w-full h-full object-cover"
                            onerror="this.src='https://via.placeholder.com/400x300?text=Study'" />
                        <div
                            class="absolute text-black top-4 right-4 bg-[#D4F1BE] bb bs-sm px-3 py-1 rounded-xl text-sm font-bold">
                            Materi</div>
                    </div>
                    <div class="p-6 text-center">
                        <span class="text-2xl md:text-3xl font-bold text-black uppercase tracking-tight">Belajar</span>
                        <p class="text-sm md:text-base font-medium text-black/60 mt-2">Pelajari isyarat SIBI bertahap.
                        </p>
                    </div>
                </a>

                <a href="{{ route('ai.index', ['mapel_slug' => $mapel->slug]) }}"
                    class="menu-card bh block bg-[#BEE9E8] bb bs rounded-[2.5rem] overflow-hidden group">
                    <div class="h-44 md:h-48 overflow-hidden bg-[#FFFEFA] bb border-t-0 border-l-0 border-r-0 relative">
                        <img src="{{ asset('images/page/studies.png') }}" alt="Kamera AI"
                            class="card-img w-full h-full object-cover"
                            onerror="this.src='https://via.placeholder.com/400x300?text=Kamera+AI'" />
                        <div
                            class="absolute text-black top-4 right-4 bg-[#BEE9E8] bb bs-sm px-3 py-1 rounded-xl text-sm font-bold">
                            Kamera</div>
                    </div>
                    <div class="p-6 text-center">
                        <span class="text-2xl md:text-3xl font-bold text-black uppercase tracking-tight">Latih AI</span>
                        <p class="text-sm md:text-base font-medium text-black/60 mt-2">Pilih kata & peragakan
                            isyaratnya!</p>
                    </div>
                </a>

                <a href="{{ route('evaluasi.index') }}"
                    class="menu-card bh block bg-[#E0BBE4] bb bs rounded-[2.5rem] overflow-hidden group lg:-translate-y-5">
                    <div class="h-44 md:h-48 overflow-hidden bg-[#FFFEFA] bb border-t-0 border-l-0 border-r-0 relative">
                        <img src="{{ asset('images/page/evaluasi.png') }}" alt="Evaluasi"
                            class="card-img w-full h-full object-cover"
                            onerror="this.src='https://via.placeholder.com/400x300?text=Evaluasi'" />
                        <div
                            class="absolute text-black top-4 right-4 bg-[#E0BBE4] bb bs-sm px-3 py-1 rounded-xl text-sm font-bold">
                            Kuis</div>
                    </div>
                    <div class="p-6 text-center">
                        <span class="text-2xl md:text-3xl font-bold text-black uppercase tracking-tight">Evaluasi</span>
                        <p class="text-sm md:text-base font-medium text-black/60 mt-2">Uji kemampuan bahasa isyaratmu!
                        </p>
                    </div>
                </a>

            </div>

            <div class="mt-16 text-center z-10">
                <p class="text-2xl font-bold text-black/30 tracking-tight">
                    Honu<span class="text-stamp text-[#FFD1E3]">Sign</span>
                </p>
            </div>
        </div>
    </div>
</x-student-layout>
