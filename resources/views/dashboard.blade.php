<x-student-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Fredoka:wght@400;500;600;700&display=swap');

        * {
            font-family: 'Fredoka', sans-serif !important;
        }

        body {
            background-color: #FFFEFA !important;
        }

        /* ── Brutalism core ── */
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
            box-shadow: 3px 3px 0 #000 !important;
        }

        .text-stamp {
            text-shadow: -2px -2px 0 #000, 2px -2px 0 #000,
                -2px 2px 0 #000, 2px 2px 0 #000,
                3px 3px 0 #000;
        }

        /* Logout button */
        .btn-logout {
            transition: all 0.15s ease-in-out !important;
        }

        .btn-logout:hover {
            transform: translate(-2px, -2px) !important;
            box-shadow: 5px 5px 0 #000 !important;
        }

        .btn-logout:active {
            transform: translate(1px, 1px) !important;
            box-shadow: 1px 1px 0 #000 !important;
        }

        /* Card image zoom */
        .card-img {
            transition: transform 0.4s ease !important;
        }

        .menu-card:hover .card-img {
            transform: scale(1.08) !important;
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

    <!-- ── Top-left: Logout Button ── -->
    <div class="fixed top-5 left-5 z-[60]">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="btn-logout bg-[#FFB3B3] text-black bb bs-sm px-5 py-2.5 rounded-2xl font-bold text-sm flex items-center gap-2">
                Keluar
            </button>
        </form>
    </div>

    <!-- ── Page Container ── -->
    <div class="min-h-screen w-full flex flex-col items-center justify-center py-16 px-6">

        <!-- Decorative floating blobs -->
        <div class="pointer-events-none fixed top-20 right-10 w-24 h-24 rounded-full bg-[#FFD1E3] bb opacity-40 float"
            style="--r:-8deg;animation-delay:0s;"></div>
        <div class="pointer-events-none fixed bottom-16 left-8  w-16 h-16 rounded-full bg-[#BEE9E8] bb opacity-40 float"
            style="--r:6deg;animation-delay:1.5s;"></div>
        <div class="pointer-events-none fixed top-1/2 left-14  w-10 h-10 rounded-full bg-[#FFF5B8] bb opacity-50 float"
            style="--r:-5deg;animation-delay:0.8s;"></div>

        <!-- ── Greeting Header ── -->
        <div class="text-center mb-14 mt-8">
            <!-- Avatar circle -->
            <!-- <div class="w-20 h-20 rounded-full bg-[#E0BBE4] bb bs-sm mx-auto mb-6 flex items-center justify-center text-4xl">
                🐢
            </div> -->

            <h1 class="text-4xl md:text-5xl font-bold text-black tracking-tight leading-tight mb-4">
                Halo,
                <span class="greeting-tag text-black">{{ auth()->user()->name }}</span>
                !
            </h1>
            <h2 class="text-2xl md:text-3xl font-bold text-slate-500 mt-2">
                Selamat Belajar
            </h2>
            <p class="text-xl font-medium text-slate-400 mt-4">Pilih menu di bawah untuk memulai aktivitasmu.</p>
        </div>

        <!-- ── Main Menu Grid ── -->
        <div class="w-full max-w-5xl grid grid-cols-1 md:grid-cols-3 gap-8 items-end">

            <!-- ── Card 1: Fun & Play ── -->
            <a href="{{ route('general.index') }}"
                class="menu-card bh block bg-[#FFD1E3] bb bs rounded-[2.5rem] overflow-hidden group">

                <!-- Image -->
                <div class="h-52 overflow-hidden bg-[#FFFEFA] bb border-t-0 border-l-0 border-r-0 relative">
                    <img src="{{ asset('images/page/fun&play.png') }}" alt="Fun & Play"
                        class="card-img w-full h-full object-cover"
                        onerror="this.src='https://via.placeholder.com/400x300?text=Fun+%26+Play'" />
                    <!-- Overlay badge -->
                    <div
                        class="absolute text-black top-4 right-4 bg-[#FFD1E3] bb bs-sm px-3 py-1 rounded-xl text-sm font-bold">
                        Game
                    </div>
                </div>

                <!-- Label -->
                <div class="p-7 text-center">
                    <span class="text-3xl font-bold text-black uppercase tracking-tight">Bermain</span>
                    <p class="text-base font-medium text-black/60 mt-2">Main game seru sambil belajar!</p>
                </div>
            </a>

            <!-- ── Card 2: Study (elevated) ── -->
            <a href="{{ route('materi.index') }}"
                class="menu-card bh block bg-[#D4F1BE] bb bs rounded-[2.5rem] overflow-hidden group md:-translate-y-5">

                <!-- Image -->
                <div class="h-52 overflow-hidden bg-[#FFFEFA] bb border-t-0 border-l-0 border-r-0 relative">
                    <img src="{{ asset('images/page/studies.png') }}" alt="Study"
                        class="card-img w-full h-full object-cover"
                        onerror="this.src='https://via.placeholder.com/400x300?text=Study'" />
                    <!-- Overlay badge -->
                    <div
                        class="absolute text-black top-4 right-4 bg-[#D4F1BE] bb bs-sm px-3 py-1 rounded-xl text-sm font-bold">
                        Materi
                    </div>
                </div>

                <!-- Label -->
                <div class="p-7 text-center">
                    <span class="text-3xl font-bold text-black uppercase tracking-tight">Belajar</span>
                    <p class="text-base font-medium text-black/60 mt-2">Pelajari isyarat SIBI langkah demi langkah.</p>
                </div>
            </a>

            <!-- ── Card 3: Evaluasi ── -->
            <a href="{{ route('evaluasi.index') }}"
                class="menu-card bh block bg-[#E0BBE4] bb bs rounded-[2.5rem] overflow-hidden group">

                <!-- Image -->
                <div class="h-52 overflow-hidden bg-[#FFFEFA] bb border-t-0 border-l-0 border-r-0 relative">
                    <img src="{{ asset('images/page/evaluasi.png') }}" alt="Evaluasi"
                        class="card-img w-full h-full object-cover"
                        onerror="this.src='https://via.placeholder.com/400x300?text=Evaluasi'" />
                    <!-- Overlay badge -->
                    <div
                        class="absolute text-black top-4 right-4 bg-[#E0BBE4] bb bs-sm px-3 py-1 rounded-xl text-sm font-bold">
                        Kuis
                    </div>
                </div>

                <!-- Label -->
                <div class="p-7 text-center">
                    <span class="text-3xl font-bold text-black uppercase tracking-tight">Evaluasi</span>
                    <p class="text-base font-medium text-black/60 mt-2">Uji kemampuan bahasa isyaratmu!</p>
                </div>
            </a>
        </div>

        <!-- ── Footer brand ── -->
        <div class="mt-14 text-center">
            <p class="text-2xl font-bold text-black/30 tracking-tight">
                Honu<span class="text-stamp text-[#FFD1E3]">Sign</span>
            </p>
        </div>
    </div>
</x-student-layout>