<x-student-layout>
    <style>
        /* Brutal Grid Pattern Background */
        .brutal-grid-bg {
            background-color: #BEE9E8;
            background-image: radial-gradient(#000000 1.5px, transparent 1.5px);
            background-size: 25px 25px;
        }

        /* Hover animation for active post */
        .hover-active-island {
            animation: island-bounce 3s ease-in-out infinite;
        }

        @keyframes island-bounce {

            0%,
            100% {
                transform: translateY(0) scale(1);
            }

            50% {
                transform: translateY(-4px) scale(1.02);
            }
        }
    </style>

    <?php
    // 1. Ambil materi spesifik untuk Mapel yang sedang dibuka saja
    $materi = \App\Models\Materi::where('mapel_id', $mapel->id)->orderBy('order', 'asc')->first();
    $materiId = $materi ? $materi->id : 0;
    
    // 2. Fetch actual completed progress
    $highestCompletedTahap = 0;
    if (auth()->check() && $materiId != 0) {
        $highestCompletedTahap =
            \App\Models\UserProgress::where('user_id', auth()->id())
                ->where('materi_id', $materiId)
                ->where('is_completed', true)
                ->max('tahap') ?? 0;
    }
    
    // 3. Determine active pos
    $activePos = request('step') ? (int) request('step') : $highestCompletedTahap + 1;
    if ($activePos > 6) {
        $activePos = 6;
    }
    
    // 4. Update route agar wajib membawa mapel_slug
    $posData = [
        1 => [
            'title' => 'Membaca',
            'desc' => 'Cerita bergambar SIBI',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-8 h-8 text-black" fill="#BEE9E8" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z" /><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z" /></svg>',
            'route' => route('materi.belajar', ['mapel_slug' => $mapel->slug, 'step' => 1]),
            'color' => 'bg-[#BEE9E8]',
        ],
        2 => [
            'title' => 'Kuis Kata',
            'desc' => 'Mengenal kuis baru',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-8 h-8 text-black" fill="#E0BBE4" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2" /><rect x="8" y="2" width="8" height="4" rx="1" ry="1" /><path d="M9 14l2 2 4-4" fill="none" /></svg>',
            'route' => route('materi.belajar', ['mapel_slug' => $mapel->slug, 'step' => 2]),
            'color' => 'bg-[#E0BBE4]',
        ],
        3 => [
            'title' => 'Isyarat AI',
            'desc' => 'Coba isyaratmu ke AI!',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-8 h-8 text-black" fill="#FFD1E3" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z" /><circle cx="12" cy="13" r="4" /></svg>',
            'route' => route('materi.belajar', ['mapel_slug' => $mapel->slug, 'step' => 3]),
            'color' => 'bg-[#FFD1E3]',
        ],
        4 => [
            'title' => 'Keberagaman',
            'desc' => 'Kuis seru bergambar',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-8 h-8 text-black" fill="#FFF5B8" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" /><circle cx="9" cy="7" r="4" /><path d="M23 21v-2a4 4 0 0 0-3-3.87" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /></svg>',
            'route' => route('materi.belajar', ['mapel_slug' => $mapel->slug, 'step' => 4]),
            'color' => 'bg-[#FFF5B8]',
        ],
        5 => [
            'title' => 'Perilaku',
            'desc' => 'Cocokkan kartu',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-8 h-8 text-black" fill="#D4F1BE" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="12" height="14" rx="2" ry="2" /><rect x="9" y="7" width="12" height="14" rx="2" ry="2" fill="#BEE9E8" /></svg>',
            'route' => route('materi.belajar', ['mapel_slug' => $mapel->slug, 'step' => 5]),
            'color' => 'bg-[#D4F1BE]',
        ],
        6 => [
            'title' => 'Mewarnai',
            'desc' => 'Buktikan kemampuanmu!',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-8 h-8 text-black" fill="#FFD8A8" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 14.7255 3.09032 17.1962 4.85857 19C5.35857 19.5 5.5 20 5 20.5C4 21.5 6 22 12 22Z" /><circle cx="7.5" cy="10.5" r="1.5" fill="currentColor" /><circle cx="11.5" cy="7.5" r="1.5" fill="currentColor" /><circle cx="16.5" cy="9.5" r="1.5" fill="currentColor" /><circle cx="15.5" cy="14.5" r="1.5" fill="currentColor" /></svg>',
            'route' => route('materi.belajar', ['mapel_slug' => $mapel->slug, 'step' => 6]),
            'color' => 'bg-[#FFD8A8]',
        ],
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
                Ayo Selesaikan Misimu!
            </p>
        </div>
    </div>

    <!-- Main Game Console Box (Fits Viewport Cleanly) -->
    <div
        class="w-full max-w-5xl h-[calc(100vh-3rem)] bg-white brutal-border brutal-shadow rounded-[3rem] overflow-hidden flex flex-col relative">

        <!-- Header (Menu Bar) -->
        <header class="h-20 flex items-center justify-between px-6 bg-white border-b-4 border-black relative z-40">
            <!-- Back to Dashboard / Keluar (Red Button, Visual-Only) -->
            <div class="relative group/tooltip inline-block">
                <a href="{{ route('dashboard') }}"
                    class="w-14 h-14 flex items-center justify-center bg-[#FFB3B3] brutal-border brutal-shadow-sm brutal-hover rounded-2xl text-black">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-8 h-8 text-black"
                        fill="#FFB3B3" stroke="currentColor" stroke-width="3" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                        <polyline points="9 22 9 12 15 12 15 22" />
                    </svg>
                </a>
                <div
                    class="pointer-events-none absolute top-full left-1/2 -translate-x-1/2 mt-3 bg-[#FFD1E3] brutal-border brutal-shadow-sm px-3 py-1.5 rounded-lg text-sm font-bold opacity-0 scale-95 group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-150 whitespace-nowrap z-50 text-black">
                    Keluar
                </div>
            </div>

            <!-- Game Title (Comic Retro Header) -->
            <h1
                class="text-2xl md:text-4xl font-black text-[#FFF5B8] text-outline uppercase tracking-tight transform -rotate-1 drop-shadow-[0_4px_0_#000]">
                Peta Perjalanan Samsul
            </h1>

            <div class="flex gap-4">
                <!-- Help / Tutorial Button (Yellow Button, Visual-Only) -->
                <div class="relative group/tooltip inline-block">
                    <button onclick="showTutorial()"
                        class="w-14 h-14 flex items-center justify-center bg-[#FFF5B8] brutal-border brutal-shadow-sm brutal-hover rounded-2xl text-black">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-8 h-8 text-black"
                            fill="#FFF5B8" stroke="currentColor" stroke-width="3" stroke-linecap="round"
                            stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10" />
                            <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" fill="none" />
                            <line x1="12" y1="17" x2="12.01" y2="17" />
                        </svg>
                    </button>
                    <div
                        class="pointer-events-none absolute top-full left-1/2 -translate-x-1/2 mt-3 bg-[#FFD1E3] brutal-border brutal-shadow-sm px-3 py-1.5 rounded-lg text-sm font-bold opacity-0 scale-95 group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-150 whitespace-nowrap z-50 text-black">
                        Bantuan
                    </div>
                </div>
            </div>
        </header>

        <!-- Map Container (Brutal Grid Background) -->
        <main class="flex-grow w-full brutal-grid-bg relative overflow-hidden" id="map-container">

            <!-- SVG Curve Path Connector -->
            <svg class="absolute inset-0 w-full h-full z-0 pointer-events-none">
                <path id="map-path" stroke="#000" stroke-width="8" stroke-dasharray="16,16" fill="none"
                    stroke-linecap="round" />
            </svg>

            <!-- Render all path steps -->
            @foreach ($posData as $index => $pos)
                @php
                    $isCompleted = $index < $activePos;
                    $isActive = $index == $activePos;
                    $isLocked = $index > $activePos;

                    // Absolute coordinates (winding layout)
                    $coords = [
                        1 => ['left' => '15%', 'top' => '22%'],
                        2 => ['left' => '50%', 'top' => '18%'],
                        3 => ['left' => '82%', 'top' => '28%'],
                        4 => ['left' => '82%', 'top' => '48%'],
                        5 => ['left' => '48%', 'top' => '48%'],
                        6 => ['left' => '15%', 'top' => '72%'],
                    ][$index];

                    $bgColor = $isCompleted ? 'bg-[#D4F1BE]' : ($isActive ? 'bg-[#FFF5B8]' : 'bg-slate-200');
                    $borderColor = $isLocked ? 'border-dashed border-slate-400' : 'border-black';
                    $shadowClass = $isLocked ? 'shadow-none' : 'brutal-shadow-sm';
                    $pointerClass = $isLocked ? 'pointer-events-none cursor-not-allowed opacity-50' : 'brutal-hover';
                    $activeAnimClass = $isActive ? 'hover-active-island' : '';
                @endphp

                <div class="absolute transform -translate-x-1/2 -translate-y-1/2 flex flex-col items-center z-10 {{ $activeAnimClass }}"
                    style="left: {{ $coords['left'] }}; top: {{ $coords['top'] }};">

                    <!-- Anchor Dot (for JS path generation) -->
                    <div id="pos-dot-{{ $index }}" class="absolute w-1 h-1" style="top: 3rem; left: 3rem;"></div>

                    <a href="{{ $isLocked ? '#' : $pos['route'] }}"
                        class="w-24 h-24 rounded-[2rem] border-4 {{ $borderColor }} {{ $bgColor }} {{ $shadowClass }} {{ $pointerClass }} flex items-center justify-center relative transition-all duration-150 group">

                        <!-- Mini Badge Number -->
                        <span
                            class="absolute -top-3 -right-3 w-8 h-8 rounded-full border-4 border-black bg-white flex items-center justify-center font-black text-black text-sm">
                            {{ $index }}
                        </span>

                        <!-- Icon -->
                        <div class="transform group-hover:scale-110 transition-transform">
                            {!! $pos['icon'] !!}
                        </div>
                    </a>

                    <!-- Compact Caption -->
                    <div
                        class="mt-2 text-[10px] md:text-xs font-black text-black bg-white px-3 py-1 rounded-xl brutal-border brutal-shadow-sm text-center whitespace-nowrap uppercase tracking-wider">
                        {{ $pos['title'] }}
                    </div>
                </div>
            @endforeach

            <!-- Finish Node (Checkered Flag) -->
            <div class="absolute transform -translate-x-1/2 -translate-y-1/2 flex flex-col items-center z-10"
                style="left: 82%; top: 78%;">
                <!-- Finish Anchor Dot -->
                <div id="finish-dot" class="absolute w-1 h-1" style="top: 3.5rem; left: 3.5rem;"></div>

                <div
                    class="w-28 h-28 rounded-[2.5rem] border-4 border-black bg-[#FFD1E3] brutal-shadow-sm flex items-center justify-center relative overflow-hidden group">
                    <span
                        class="absolute -top-3 -right-3 w-8 h-8 rounded-full border-4 border-black bg-white flex items-center justify-center font-black text-black text-sm">
                        ★
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        class="w-14 h-14 text-black group-hover:scale-110 transition-transform duration-200"
                        fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round"
                        stroke-linejoin="round">
                        <!-- Flag pole -->
                        <line x1="4" y1="2" x2="4" y2="22" />
                        <!-- Flag wave outline -->
                        <path d="M4 4c4-2 6 2 10 0s6-2 6 0v8c0 2-2 2-6 0s-6-2-10 0z" fill="#FFFFFF" />
                        <!-- Checker patterns -->
                        <path d="M4 4c2-1 3 1 5 0v4c-2 1-3-1-5 0z" fill="currentColor" />
                        <path d="M14 4c2-1 3 1 5 0v4c-2 1-3-1-5 0z" fill="currentColor" />
                        <path d="M9 6c2-1 3 1 5 0v4c-2 1-3-1-5 0z" fill="currentColor" />
                    </svg>
                </div>

                <div
                    class="mt-2 text-[10px] md:text-xs font-black text-black bg-white px-3 py-1 rounded-xl brutal-border brutal-shadow-sm text-center whitespace-nowrap uppercase tracking-wider">
                    Garis Finish
                </div>
            </div>

            <!-- Samsul Walking Character -->
            <div id="animated-samsul"
                class="absolute z-30 flex flex-col items-center pointer-events-none transition-all"
                style="opacity: 0; width: 90px; height: 110px;">
                <div id="samsul-bubble"
                    class="bg-white brutal-border px-3 py-0.5 rounded-full text-[10px] font-black text-black whitespace-nowrap brutal-shadow-sm mb-1 transform -rotate-3 opacity-0 transition-opacity duration-500">
                    KLIK POS INI!
                </div>
                <img src="{{ asset('images/keSekolah/samsul.png') }}" alt="Samsul"
                    class="w-20 md:w-24 drop-shadow-lg transform scale-x-[-1] transition-transform duration-200"
                    id="samsul-img">
            </div>

        </main>
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

            <!-- Simulating Curvy Walk in Tutorial -->
            <div
                class="relative w-64 h-64 bg-[#BEE9E8] brutal-border rounded-3xl p-4 flex flex-col items-center mb-8 mx-auto overflow-hidden shadow-inner pt-8">
                <!-- Curve Path -->
                <svg class="absolute inset-0 w-full h-full pointer-events-none">
                    <path d="M 40 60 C 100 20, 160 100, 220 60" stroke="#000" stroke-width="4"
                        stroke-dasharray="8,8" fill="none" />
                </svg>

                <div
                    class="absolute left-[20px] top-[40px] w-8 h-8 rounded-full bg-[#FFF5B8] border-2 border-black flex items-center justify-center text-[10px] font-black z-10">
                    1</div>
                <div
                    class="absolute right-[20px] top-[40px] w-8 h-8 rounded-full bg-slate-200 border-2 border-dashed border-slate-400 flex items-center justify-center text-[10px] font-black text-slate-400 z-10">
                    2</div>

                <div id="sim-samsul" class="absolute z-20"
                    style="left: 40px; top: 60px; transform: translate(-50%, -50%) scale-x(-1);">
                    <img src="{{ asset('images/keSekolah/samsul.png') }}" class="w-10 h-auto">
                </div>

                <!-- Cursor Finger -->
                <div id="sim-cursor"
                    class="absolute w-8 h-8 transition-all duration-700 pointer-events-none z-50 flex items-center justify-center text-3xl"
                    style="top: 90%; left: 50%; opacity: 0; transform: translate(-50%, -50%);">
                    👆
                </div>
            </div>

            <!-- Steps text -->
            <div
                class="flex flex-col gap-4 text-left w-full bg-[#F8FAFC] brutal-border p-6 rounded-2xl mb-8 shadow-sm">
                <div class="flex items-start gap-3">
                    <span
                        class="bg-[#FFF5B8] w-8 h-8 rounded-xl brutal-border flex items-center justify-center font-black text-black text-sm shrink-0 mt-0.5">1</span>
                    <p class="font-bold text-slate-700 text-sm md:text-base">Samsul akan berjalan ke Pos berikutnya.
                    </p>
                </div>
                <div class="flex items-start gap-3">
                    <span
                        class="bg-[#D4F1BE] w-8 h-8 rounded-xl brutal-border flex items-center justify-center font-black text-black text-sm shrink-0 mt-0.5">2</span>
                    <p class="font-bold text-slate-700 text-sm md:text-base"><b>Klik tombol Pos</b> tersebut untuk
                        masuk dan mulai belajar!</p>
                </div>
            </div>

            <!-- Confirm Button (Visual Icon Ok / Checklist) -->
            <button onclick="closeTutorial()"
                class="w-20 h-20 bg-[#D4F1BE] text-black rounded-full brutal-border brutal-shadow-sm brutal-hover flex items-center justify-center"
                title="Mengerti">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10">
                    <circle cx="12" cy="12" r="10" opacity="0.2" />
                    <path d="M10 15.172l-3.5-3.5-1.414 1.414 4.914 4.914 9.9-9.9-1.414-1.414z" fill="currentColor" />
                </svg>
            </button>
        </div>
    </div>

    <script>
        const activePos = {{ $activePos }};
        const samsul = document.getElementById('animated-samsul');
        const samsulImg = document.getElementById('samsul-img');
        const mapPath = document.getElementById('map-path');
        let calculatedPoints = [];
        let calculatedSegments = [];
        let tutorialTimer = null;

        // Formula for cubic Bezier coordinate calculation
        function getBezierPoint(t, p1, cp1, cp2, p2) {
            const mt = 1 - t;
            const mt2 = mt * mt;
            const mt3 = mt2 * mt;
            const t2 = t * t;
            const t3 = t2 * t;

            return {
                x: mt3 * p1.x + 3 * mt2 * t * cp1.x + 3 * mt * t2 * cp2.x + t3 * p2.x,
                y: mt3 * p1.y + 3 * mt2 * t * cp1.y + 3 * mt * t2 * cp2.y + t3 * p2.y
            };
        }

        // Generate smooth Bezier S-curve between all dots
        function calculateMapCurve() {
            const container = document.getElementById('map-container');
            if (!container || !mapPath) return;

            const rect = container.getBoundingClientRect();
            const points = [];

            // Add stages dots
            for (let i = 1; i <= 6; i++) {
                const dot = document.getElementById('pos-dot-' + i);
                if (dot) {
                    const dotRect = dot.getBoundingClientRect();
                    points.push({
                        x: dotRect.left - rect.left,
                        y: dotRect.top - rect.top
                    });
                }
            }

            // Add finish dot
            const finish = document.getElementById('finish-dot');
            if (finish) {
                const finishRect = finish.getBoundingClientRect();
                points.push({
                    x: finishRect.left - rect.left,
                    y: finishRect.top - rect.top
                });
            }

            calculatedPoints = points;
            if (points.length < 2) return;

            let d = `M ${points[0].x} ${points[0].y}`;
            calculatedSegments = [];

            for (let i = 0; i < points.length - 1; i++) {
                const p1 = points[i];
                const p2 = points[i + 1];
                const dx = p2.x - p1.x;
                const dy = p2.y - p1.y;

                let cp1 = {
                    x: 0,
                    y: 0
                };
                let cp2 = {
                    x: 0,
                    y: 0
                };

                // Draw curves horizontally and vertically based on winding
                if (Math.abs(dx) > Math.abs(dy)) {
                    cp1 = {
                        x: p1.x + dx / 2,
                        y: p1.y
                    };
                    cp2 = {
                        x: p2.x - dx / 2,
                        y: p2.y
                    };
                } else {
                    cp1 = {
                        x: p1.x,
                        y: p1.y + dy / 2
                    };
                    cp2 = {
                        x: p2.x,
                        y: p2.y - dy / 2
                    };
                }

                d += ` C ${cp1.x} ${cp1.y}, ${cp2.x} ${cp2.y}, ${p2.x} ${p2.y}`;

                calculatedSegments.push({
                    p1: p1,
                    cp1: cp1,
                    cp2: cp2,
                    p2: p2
                });
            }

            mapPath.setAttribute('d', d);
        }

        // Move Samsul smoothly along the Bezier curves
        function animateSamsulWalking() {
            if (!samsul || calculatedSegments.length === 0) return;

            // Target step index is activePos - 1
            const targetSegmentIdx = activePos - 2; // e.g. for step 2, walk segment index 0 (Pos 1 -> Pos 2)

            // If we are at Pos 1, just place him at Pos 1 dot
            if (targetSegmentIdx < 0) {
                const startPos = calculatedPoints[0];
                samsul.style.left = startPos.x + 'px';
                samsul.style.top = startPos.y + 'px';
                samsul.style.transform = 'translate(-50%, -85%)';
                samsul.style.opacity = '1';
                document.getElementById('samsul-bubble').style.opacity = '1';
                return;
            }

            const segment = calculatedSegments[targetSegmentIdx];
            const duration = 2000; // 2 seconds walking animation
            const startTime = performance.now();
            let lastX = segment.p1.x;

            samsul.style.opacity = '1';

            function updateProgress(now) {
                const elapsed = now - startTime;
                const t = Math.min(elapsed / duration, 1);

                const currentCoord = getBezierPoint(t, segment.p1, segment.cp1, segment.cp2, segment.p2);

                samsul.style.left = currentCoord.x + 'px';
                samsul.style.top = currentCoord.y + 'px';
                samsul.style.transform = 'translate(-50%, -85%)';

                // Face the character towards direction of walking
                if (currentCoord.x > lastX + 0.5) {
                    samsulImg.style.transform = 'scale-x(1)'; // Flip to face right
                } else if (currentCoord.x < lastX - 0.5) {
                    samsulImg.style.transform = 'scale-x(-1)'; // Face left
                }
                lastX = currentCoord.x;

                if (t < 1) {
                    requestAnimationFrame(updateProgress);
                } else {
                    // Reached destination, show bubble
                    document.getElementById('samsul-bubble').style.opacity = '1';
                }
            }

            requestAnimationFrame(updateProgress);
        }

        // Interactive tutorial simulation inside modal
        function runTutorialSimulation() {
            const cursor = document.getElementById('sim-cursor');
            const simSamsul = document.getElementById('sim-samsul');

            if (!cursor || !simSamsul) return;

            // Reset positions
            cursor.style.opacity = '0';
            cursor.style.top = '90%';
            cursor.style.left = '50%';
            cursor.style.transform = 'translate(-50%, -50%) scale(1)';

            simSamsul.style.left = '40px';
            simSamsul.style.top = '60px';

            setTimeout(() => {
                // Move cursor to pos 1
                cursor.style.transition = 'all 1s ease-in-out';
                cursor.style.opacity = '1';
                cursor.style.left = '36px';
                cursor.style.top = '56px';
            }, 500);

            setTimeout(() => {
                // Click
                cursor.style.transform = 'translate(-50%, -50%) scale(0.8)';
            }, 1600);

            setTimeout(() => {
                // Release click, move Samsul along curve
                cursor.style.transform = 'translate(-50%, -50%) scale(1)';
                cursor.style.opacity = '0';

                // Simulate curve movement
                let t = 0;
                const p1 = {
                    x: 40,
                    y: 60
                };
                const cp1 = {
                    x: 100,
                    y: 20
                };
                const cp2 = {
                    x: 160,
                    y: 100
                };
                const p2 = {
                    x: 220,
                    y: 60
                };

                function stepSim() {
                    t += 0.05;
                    const coord = getBezierPoint(t, p1, cp1, cp2, p2);
                    simSamsul.style.left = coord.x + 'px';
                    simSamsul.style.top = coord.y + 'px';

                    if (t < 1) {
                        requestAnimationFrame(stepSim);
                    }
                }
                stepSim();
            }, 2000);
        }

        function showTutorial() {
            const overlay = document.getElementById('tutorial-overlay');
            const content = document.getElementById('tutorial-modal-content');

            overlay.classList.remove('opacity-0', 'pointer-events-none');
            overlay.classList.add('opacity-100', 'pointer-events-auto');
            content.classList.remove('scale-90');
            content.classList.add('scale-100');

            runTutorialSimulation();
            clearInterval(tutorialTimer);
            tutorialTimer = setInterval(runTutorialSimulation, 4500);
        }

        function closeTutorial() {
            const overlay = document.getElementById('tutorial-overlay');
            const content = document.getElementById('tutorial-modal-content');

            overlay.classList.add('opacity-0', 'pointer-events-none');
            overlay.classList.remove('opacity-100', 'pointer-events-auto');
            content.classList.add('scale-90');
            content.classList.remove('scale-100');

            clearInterval(tutorialTimer);

            // Trigger Samsul walking animation after tutorial closes
            setTimeout(animateSamsulWalking, 300);
        }

        document.addEventListener('DOMContentLoaded', () => {
            calculateMapCurve();

            setTimeout(() => {
                const overlay = document.getElementById('intro-overlay');
                if (overlay) {
                    overlay.style.opacity = '0';
                    setTimeout(() => {
                        overlay.remove();
                        if (activePos === 1) {
                            showTutorial();
                        } else {
                            animateSamsulWalking();
                        }
                    }, 1000);
                }
            }, 1800);

            // Re-render curves on window resize
            window.addEventListener('resize', () => {
                calculateMapCurve();
                // Snap Samsul to target node instantly on resize
                const targetIdx = activePos - 1;
                if (calculatedPoints[targetIdx]) {
                    samsul.style.left = calculatedPoints[targetIdx].x + 'px';
                    samsul.style.top = calculatedPoints[targetIdx].y + 'px';
                }
            });
        });
    </script>
</x-student-layout>
