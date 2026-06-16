<x-student-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Fredoka:wght@400;500;600;700&display=swap');

        .game-index-container {
            font-family: 'Fredoka', sans-serif;
        }

        .game-index-container * {
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
            .game-card.md\:-translate-y-5.bh:hover {
                transform: translateY(-24px) translateX(-4px);
                box-shadow: 10px 10px 0 #000;
            }

            .game-card.md\:-translate-y-5.bh:active {
                transform: translateY(-18px) translateX(2px);
                box-shadow: 4px 4px 0 #000;
            }
        }

        .card-img {
            transition: transform 0.4s ease;
        }

        .game-card:hover .card-img {
            transform: scale(1.08);
        }

        /* Text stamp */
        .text-stamp {
            text-shadow: -2px -2px 0 #000, 2px -2px 0 #000,
                -2px 2px 0 #000, 2px 2px 0 #000,
                3px 3px 0 #000;
        }

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

        /* Play button on hover */
        .play-btn {
            transition: all 0.15s ease-in-out;
        }

        .game-card:hover .play-btn {
            background-color: #D4F1BE;
            transform: translate(-2px, -2px);
            box-shadow: 5px 5px 0 #000;
        }
    </style>

    <div class="game-index-container">
        <!-- Back Button with Tooltip -->
        <div class="fixed top-6 left-6 z-[60] group/tooltip">
            <a href="{{ route('dashboard') }}"
                class="w-12 h-12 bg-[#FFF5B8] bb bs-sm bh rounded-xl flex items-center justify-center group"
                aria-label="Kembali ke Dashboard">
                <svg class="w-6 h-6 text-black group-hover:-translate-x-1 transition-transform" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="3" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M19 12H5M12 19l-7-7 7-7" />
                </svg>
            </a>
            <!-- Neobrutalist Tooltip -->
            <div
                class="pointer-events-none absolute left-14 top-1/2 -translate-y-1/2 bg-[#FFD1E3] bb bs-sm px-3 py-1.5 rounded-lg text-sm font-bold opacity-0 scale-95 group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-150 whitespace-nowrap z-50 text-black">
                Kembali
            </div>
        </div>

        <!-- Floating deco -->
        <div class="pointer-events-none fixed top-20 right-10 w-20 h-20 rounded-full bg-[#FFD1E3] bb opacity-40 float"
            style="--r:-8deg;animation-delay:0s;"></div>
        <div class="pointer-events-none fixed bottom-20 left-8  w-14 h-14 rounded-full bg-[#FFF5B8] bb opacity-50 float"
            style="--r:6deg;animation-delay:1.3s;"></div>
        <div class="pointer-events-none fixed top-1/2 left-12  w-10 h-10 rounded-full bg-[#D4F1BE] bb opacity-40 float"
            style="--r:-5deg;animation-delay:0.7s;"></div>

        <!-- Page content -->
        <div
            class="min-h-screen md:h-screen md:overflow-hidden w-full flex flex-col items-center justify-center md:justify-evenly py-20 md:py-8 px-6">

            <!-- Header -->
            <div class="text-center md:mb-16 md:mt-4">
                <h1 class="text-5xl md:text-6xl font-bold text-black leading-tight mb-4">
                    <span class="inline-block bg-[#FFD1E3] bb bs px-5 py-1 rounded-3xl -rotate-2 mx-1">
                        Permainan
                    </span>
                </h1>
            </div>

            <!-- Game Cards Grid -->
            <div class="w-full max-w-5xl grid grid-cols-1 md:grid-cols-3 gap-8 items-end relative z-10">

                <!-- Card 1: Riau Discovery Puzzle -->
                <a href="{{ route('general.puzzle') }}"
                    class="game-card bh block bg-[#BEE9E8] bb bs rounded-3xl overflow-hidden group">

                    <!-- Image area -->
                    <div class="h-56 overflow-hidden bg-[#FFFEFA] bb border-t-0 border-l-0 border-r-0 relative">
                        <img src="{{ asset('images/page/puzzle page.png') }}" alt="Riau Discovery"
                            class="card-img w-full h-full object-cover"
                            onerror="this.src='https://via.placeholder.com/400x300?text=Riau+Discovery'" />
                        <div
                            class="absolute text-black top-4 left-4 bg-[#BEE9E8] bb bs-sm px-3 py-1 rounded-xl text-xs font-bold">
                            Drag & Drop
                        </div>
                    </div>

                    <!-- Card body -->
                    <div class="p-7 flex flex-col gap-4">
                        <div>
                            <h2 class="text-2xl font-bold text-black mb-1">Riau Discovery</h2>
                            <p class="text-base font-semibold text-slate-700 leading-relaxed">Susun kepingan peta
                                Provinsi Riau
                                ke posisi yang tepat!</p>
                        </div>
                        <div class="relative group/tooltip">
                            <div
                                class="play-btn bb bs-sm w-full bg-[#FFF5B8] text-black py-3 rounded-2xl flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-8 h-8 text-black">
                                    <polygon points="5 3 19 12 5 21" fill="currentColor" class="opacity-20" />
                                    <polygon points="5 3 19 12 5 21" fill="none" stroke="currentColor" stroke-width="2.5"
                                        stroke-linejoin="round" />
                                </svg>
                            </div>
                            <!-- Neobrutalist Tooltip -->
                            <div
                                class="pointer-events-none absolute bottom-full left-1/2 -translate-x-1/2 mb-3 bg-[#FFD1E3] bb bs-sm px-3 py-1.5 rounded-lg text-sm font-bold opacity-0 scale-95 group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-150 whitespace-nowrap z-50 text-black text-center">
                                Mainkan Game!
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Card 2: Harmoni Alat Musik (elevated center) -->
                <a href="{{ route('general.puzzle_instrument') }}"
                    class="game-card bh block bg-[#E0BBE4] bb bs rounded-3xl overflow-hidden group md:-translate-y-5">

                    <!-- Image area -->
                    <div class="h-56 overflow-hidden bg-[#FFFEFA] bb border-t-0 border-l-0 border-r-0 relative">
                        <img src="{{ asset('images/page/sliding page.png') }}" alt="Harmoni Riau"
                            class="card-img w-full h-full object-cover"
                            onerror="this.src='https://via.placeholder.com/400x300?text=Harmoni+Riau'" />
                        <div
                            class="absolute text-black top-4 left-4 bg-[#E0BBE4] bb bs-sm px-3 py-1 rounded-xl text-xs font-bold">
                            Sliding Puzzle
                        </div>
                    </div>

                    <!-- Card body -->
                    <div class="p-7 flex flex-col gap-4">
                        <div>
                            <h2 class="text-2xl font-bold text-black mb-1">Harmoni Alat Musik</h2>
                            <p class="text-base font-semibold text-slate-700 leading-relaxed">Susun puzzle gambar alat
                                musik
                                tradisional Riau!</p>
                        </div>
                        <div class="relative group/tooltip">
                            <div
                                class="play-btn bb bs-sm w-full bg-[#FFF5B8] text-black py-3 rounded-2xl flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-8 h-8 text-black">
                                    <polygon points="5 3 19 12 5 21" fill="currentColor" class="opacity-20" />
                                    <polygon points="5 3 19 12 5 21" fill="none" stroke="currentColor" stroke-width="2.5"
                                        stroke-linejoin="round" />
                                </svg>
                            </div>
                            <!-- Neobrutalist Tooltip -->
                            <div
                                class="pointer-events-none absolute bottom-full left-1/2 -translate-x-1/2 mb-3 bg-[#FFD1E3] bb bs-sm px-3 py-1.5 rounded-lg text-sm font-bold opacity-0 scale-95 group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-150 whitespace-nowrap z-50 text-black text-center">
                                Mainkan Game!
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Card 3: Memori Visual -->
                <a href="{{ route('general.memory') }}"
                    class="game-card bh block bg-[#FFF5B8] bb bs rounded-3xl overflow-hidden group">

                    <!-- Image area -->
                    <div class="h-56 overflow-hidden bg-[#FFFEFA] bb border-t-0 border-l-0 border-r-0 relative">
                        <img src="{{ asset('images/page/memory page.png') }}" alt="Memori Visual"
                            class="card-img w-full h-full object-cover"
                            onerror="this.src='https://via.placeholder.com/400x300?text=Memori+Visual'" />
                        <div
                            class="absolute text-black top-4 left-4 bg-[#FFF5B8] bb bs-sm px-3 py-1 rounded-xl text-xs font-bold">
                            Memory Game
                        </div>
                    </div>

                    <!-- Card body -->
                    <div class="p-7 flex flex-col gap-4">
                        <div>
                            <h2 class="text-2xl font-bold text-black mb-1">Memori Visual SIBI</h2>
                            <p class="text-base font-semibold text-slate-700 leading-relaxed">Temukan pasangan kartu
                                isyarat
                                tangan yang sama!</p>
                        </div>
                        <div class="relative group/tooltip">
                            <div
                                class="play-btn bb bs-sm w-full bg-[#BEE9E8] text-black py-3 rounded-2xl flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-8 h-8 text-black">
                                    <polygon points="5 3 19 12 5 21" fill="currentColor" class="opacity-20" />
                                    <polygon points="5 3 19 12 5 21" fill="none" stroke="currentColor" stroke-width="2.5"
                                        stroke-linejoin="round" />
                                </svg>
                            </div>
                            <!-- Neobrutalist Tooltip -->
                            <div
                                class="pointer-events-none absolute bottom-full left-1/2 -translate-x-1/2 mb-3 bg-[#FFD1E3] bb bs-sm px-3 py-1.5 rounded-lg text-sm font-bold opacity-0 scale-95 group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-150 whitespace-nowrap z-50 text-black text-center">
                                Mainkan Game!
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Footer brand -->
            <div class="mt-16 text-center md:mt-4">
                <p class="text-2xl font-bold text-black/20 tracking-tight">
                    Honu<span class="text-stamp text-[#FFD1E3]/60">Sign</span>
                </p>
            </div>
        </div>
    </div>
</x-student-layout>
