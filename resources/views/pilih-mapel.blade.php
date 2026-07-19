<x-student-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Fredoka:wght@400;500;600;700&display=swap');

        .pilih-mapel-container {
            font-family: 'Fredoka', sans-serif;
        }

        .pilih-mapel-container * {
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

        .bs.bh:hover {
            transform: translate(-4px, -4px);
            box-shadow: 10px 10px 0 #000;
        }

        .bs.bh:active {
            transform: translate(2px, 2px);
            box-shadow: 4px 4px 0 #000;
        }

        .text-stamp {
            text-shadow: -2px -2px 0 #000, 2px -2px 0 #000, -2px 2px 0 #000, 2px 2px 0 #000, 3px 3px 0 #000;
        }

        .card-img {
            transition: transform 0.4s ease;
        }

        .menu-card:hover .card-img {
            transform: scale(1.08);
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
    </style>

    <div class="pilih-mapel-container">
        <div class="fixed top-5 left-5 z-[60] group/tooltip">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-12 h-12 bg-[#BEE9E8] text-black bb bs-sm bh rounded-xl flex items-center justify-center cursor-pointer"
                    aria-label="Keluar">
                    <svg class="w-6 h-6 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 12H5M12 19l-7-7 7-7" />
                    </svg>
                </button>
            </form>

            <div
                class="pointer-events-none absolute left-14 top-1/2 -translate-y-1/2 bg-[#FFF5B8] bb bs-sm px-3 py-1.5 rounded-lg text-sm font-bold opacity-0 scale-95 group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-150 whitespace-nowrap z-50 text-black">
                Keluar
            </div>
        </div>

        <div class="min-h-screen w-full flex flex-col items-center justify-center py-20 px-6 relative overflow-hidden">
            <div class="pointer-events-none absolute top-20 right-10 w-24 h-24 rounded-full bg-[#D4F1BE] bb opacity-40 float"
                style="--r:-8deg;animation-delay:0s;"></div>
            <div class="pointer-events-none absolute bottom-16 left-8  w-16 h-16 rounded-full bg-[#E0BBE4] bb opacity-40 float"
                style="--r:6deg;animation-delay:1.5s;"></div>

            <div class="text-center mb-10 md:mb-14 z-10">
                <h1 class="text-4xl md:text-5xl font-bold text-black tracking-tight leading-tight mb-3">
                    Mau Belajar <span
                        class="bg-[#FFF5B8] px-3 py-1 rounded-2xl bb bs-sm inline-block transform rotate-2">Apa Hari
                        Ini?</span>
                </h1>
                <p class="text-lg md:text-xl font-bold text-slate-700">Pilih mata pelajaran yang ingin kamu pelajari.
                </p>
            </div>

            <div class="w-full max-w-4xl grid grid-cols-1 md:grid-cols-2 gap-8 z-10">
                @foreach ($mapels as $index => $mapel)
                    @php
                        $colors = ['#FFD1E3', '#D4F1BE', '#E0BBE4', '#BEE9E8', '#FFF5B8'];
                        $bgColor = $colors[$index % count($colors)];
                    @endphp

                    <a href="{{ route('dashboard.mapel', ['mapel_slug' => $mapel->slug]) }}"
                        class="menu-card bh block bb bs rounded-[2.5rem] overflow-hidden group"
                        style="background-color: {{ $bgColor }};">

                        <div
                            class="h-48 overflow-hidden bg-[#FFFEFA] bb border-t-0 border-l-0 border-r-0 relative flex items-center justify-center">
                            @if ($mapel->icon)
                                <img src="{{ asset('images/' . $mapel->icon) }}" alt="{{ $mapel->nama }}"
                                    class="card-img w-full h-full object-cover">
                            @else
                                <img src="{{ asset('images/page/studies.png') }}" alt="Study Default"
                                    class="card-img w-full h-full object-cover"
                                    onerror="this.src='https://via.placeholder.com/400x300?text={{ urlencode($mapel->nama) }}'" />
                            @endif

                            <div class="absolute text-black top-4 right-4 bb bs-sm px-3 py-1 rounded-xl text-sm font-bold"
                                style="background-color: {{ $bgColor }};">
                                Mapel
                            </div>
                        </div>

                        <div class="p-6 md:p-8 text-center bg-white/40">
                            <h2 class="text-2xl md:text-3xl font-bold text-black uppercase tracking-tight">
                                {{ $mapel->nama }}</h2>
                            <p class="text-base font-medium text-black/70 mt-2">{{ $mapel->deskripsi }}</p>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-14 text-center z-10">
                <p class="text-xl font-bold text-black/30 tracking-tight">
                    Honu<span class="text-stamp text-[#FFD1E3]">Sign</span>
                </p>
            </div>
        </div>
    </div>
</x-student-layout>
