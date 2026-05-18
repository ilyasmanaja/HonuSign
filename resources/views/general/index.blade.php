<x-student-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Fredoka:wght@400;500;600;700&display=swap');

        * {
            font-family: 'Fredoka', sans-serif !important;
        }

        body {
            background-color: #FFFEFA !important;
        }

        .bb {
            border: 4px solid #000 !important;
        }

        .bs {
            box-shadow: 6px 6px 0 #000 !important;
        }

        .bs-sm {
            box-shadow: 3px 3px 0 #000 !important;
        }

        .bh {
            transition: all 0.2s ease-in-out !important;
        }

        .bh:hover {
            transform: translate(-4px, -4px) !important;
            box-shadow: 10px 10px 0 #000 !important;
        }

        .bh:active {
            transform: translate(2px, 2px) !important;
            box-shadow: 2px 2px 0 #000 !important;
        }

        .card-img {
            transition: transform 0.4s ease !important;
        }

        .game-card:hover .card-img {
            transform: scale(1.08) !important;
        }

        /* Back button */
        .btn-back {
            transition: all 0.15s ease-in-out !important;
        }

        .btn-back:hover {
            transform: translate(-2px, -2px) !important;
            box-shadow: 5px 5px 0 #000 !important;
        }

        .btn-back:active {
            transform: translate(1px, 1px) !important;
            box-shadow: 1px 1px 0 #000 !important;
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
            transition: all 0.15s ease-in-out !important;
        }

        .game-card:hover .play-btn {
            background-color: #D4F1BE !important;
            transform: translate(-2px, -2px);
            box-shadow: 5px 5px 0 #000 !important;
        }
    </style>

    <!-- Back button -->
    <div class="fixed top-5 left-5 z-[60]">
        <a href="{{ route('dashboard') }}"
            class="btn-back bg-[#FFB3B3] text-black bb bs-sm px-5 py-2.5 rounded-2xl font-bold text-sm flex items-center gap-2">
            Kembali
        </a>
    </div>

    <!-- Floating deco -->
    <div class="pointer-events-none fixed top-20 right-10 w-20 h-20 rounded-full bg-[#FFD1E3] bb opacity-40 float"
        style="--r:-8deg;animation-delay:0s;"></div>
    <div class="pointer-events-none fixed bottom-20 left-8  w-14 h-14 rounded-full bg-[#FFF5B8] bb opacity-50 float"
        style="--r:6deg;animation-delay:1.3s;"></div>
    <div class="pointer-events-none fixed top-1/2 left-12  w-10 h-10 rounded-full bg-[#D4F1BE] bb opacity-40 float"
        style="--r:-5deg;animation-delay:0.7s;"></div>

    <!-- Page content -->
    <div class="min-h-screen w-full flex flex-col items-center py-20 px-6">

        <!-- Header -->
        <div class="text-center mb-16 mt-6">
            <!-- Badge -->
            <!-- <div class="inline-block px-5 py-2 bg-[#FFD1E3] bb bs-sm rounded-2xl text-sm font-bold mb-5 -rotate-1">
                🎮 Pilih Permainan
            </div> -->
            <h1 class="text-5xl md:text-6xl font-bold text-black leading-tight mb-4">
                <span class="inline-block bg-[#FFD1E3] bb bs px-5 py-1 rounded-3xl -rotate-2 mx-1">
                    Permainan
                </span>
            </h1>
            <p class="text-xl font-medium text-slate-500 mt-4">Pilih permainan seru yang ingin kamu mainkan hari ini!
            </p>
        </div>

        <!-- Game Cards Grid -->
        <div class="w-full max-w-5xl grid grid-cols-1 md:grid-cols-3 gap-8 items-end">

            <!-- Card 1: Riau Discovery Puzzle -->
            <a href="{{ route('general.puzzle') }}"
                class="game-card bh block bg-[#BEE9E8] bb bs rounded-[2.5rem] overflow-hidden group">

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
                        <p class="text-sm font-medium text-slate-500 leading-relaxed">Susun kepingan peta Provinsi Riau
                            ke posisi yang tepat!</p>
                    </div>
                    <div
                        class="play-btn bb bs-sm w-full bg-[#FFF5B8] text-black text-lg py-3 rounded-2xl font-bold uppercase tracking-widest text-center">
                        Mainkan
                    </div>
                </div>
            </a>

            <!-- Card 2: Harmoni Alat Musik (elevated center) -->
            <a href="{{ route('general.puzzle_instrument') }}"
                class="game-card bh block bg-[#E0BBE4] bb bs rounded-[2.5rem] overflow-hidden group md:-translate-y-5">

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
                        <p class="text-sm font-medium text-slate-500 leading-relaxed">Susun puzzle gambar alat musik
                            tradisional Riau!</p>
                    </div>
                    <div
                        class="play-btn bb bs-sm w-full bg-[#FFF5B8] text-black text-lg py-3 rounded-2xl font-bold uppercase tracking-widest text-center">
                        Mainkan
                    </div>
                </div>
            </a>

            <!-- Card 3: Memori Visual -->
            <a href="{{ route('general.memory') }}"
                class="game-card bh block bg-[#FFF5B8] bb bs rounded-[2.5rem] overflow-hidden group">

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
                        <p class="text-sm font-medium text-slate-500 leading-relaxed">Temukan pasangan kartu isyarat
                            tangan yang sama!</p>
                    </div>
                    <div
                        class="play-btn bb bs-sm w-full bg-[#BEE9E8] text-black text-lg py-3 rounded-2xl font-bold uppercase tracking-widest text-center">
                        Mainkan
                    </div>
                </div>
            </a>
        </div>

        <!-- Footer brand -->
        <div class="mt-16 text-center">
            <p class="text-2xl font-bold text-black/20 tracking-tight">
                Honu<span class="text-stamp text-[#FFD1E3]/60">Sign</span>
            </p>
        </div>
    </div>
</x-student-layout>