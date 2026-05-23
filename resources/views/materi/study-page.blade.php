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
    // Get the first materi
    $materi = \App\Models\Materi::orderBy('order', 'asc')->first();
    $materiId = $materi ? $materi->id : 1;
    
    // Fetch actual completed progress
    $highestCompletedTahap = 0;
    if (auth()->check()) {
        $highestCompletedTahap =
            \App\Models\UserProgress::where('user_id', auth()->id())
                ->where('materi_id', $materiId)
                ->where('is_completed', true)
                ->max('tahap') ?? 0;
    }
    
    // Determine active pos (can be overridden by query param for testing)
    $activePos = request('step') ? (int) request('step') : $highestCompletedTahap + 1;
    if ($activePos > 6) {
        $activePos = 6;
    }
    
    $posData = [
        1 => [
            'title' => 'Membaca',
            'desc' => 'Cerita bergambar SIBI',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8"><circle cx="12" cy="12" r="10" fill="currentColor" opacity="0.2"/><path d="M12 3v18c-3.333-1-5-1-8-1a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2c3 0 4.667 0 8 0z" /><path d="M12 3v18c3.333-1 5-1 8-1a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2c-3 0-4.667 0-8 0z" /></svg>',
            'route' => route('materi.belajar', ['step' => 1]),
            'color' => 'bg-[#BEE9E8]', // Soft Blue
        ],
        2 => [
            'title' => 'Kuis Kata',
            'desc' => 'Mengenal kuis baru',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8"><circle cx="12" cy="12" r="10" fill="currentColor" opacity="0.2"/><path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5z" /><circle cx="12" cy="12" r="3" /></svg>',
            'route' => route('materi.belajar', ['step' => 2]),
            'color' => 'bg-[#E0BBE4]', // Pastel Purple
        ],
        3 => [
            'title' => 'Isyarat AI',
            'desc' => 'Coba isyaratmu ke AI!',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8"><circle cx="12" cy="12" r="10" fill="currentColor" opacity="0.2"/><path d="M3 8a2 2 0 0 1 2-2h3l1.5-2h5L16 6h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8z" /><circle cx="12" cy="13" r="3" /></svg>',
            'route' => route('materi.belajar', ['step' => 3]),
            'color' => 'bg-[#FFD1E3]', // Soft Pink
        ],
        4 => [
            'title' => 'Keberagaman',
            'desc' => 'Kuis seru bergambar',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8"><circle cx="12" cy="12" r="10" fill="currentColor" opacity="0.2"/><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12c0 1.84.5 3.56 1.36 5.04L2 22l4.96-1.36A9.957 9.957 0 0 0 12 22z" /><path d="M12 17.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm.5-4.5c0-1.5 2-2 2-4a2.5 2.5 0 1 0-5 0h2c0-.5.5-1 1-1s1 .5 1 1-1 1.5-1 3.5h2z" /></svg>',
            'route' => route('materi.belajar', ['step' => 4]),
            'color' => 'bg-[#FFF5B8]', // Bright Yellow
        ],
        5 => [
            'title' => 'Perilaku',
            'desc' => 'Cocokkan kartu',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8"><circle cx="12" cy="12" r="10" fill="currentColor" opacity="0.2"/><path d="M4 6h12v12H4z" /><path d="M8 4h12v12h-2v2h4V2H6v4h2z" /></svg>',
            'route' => route('materi.belajar', ['step' => 5]),
            'color' => 'bg-[#D4F1BE]', // Mint Green
        ],
        6 => [
            'title' => 'Mewarnai',
            'desc' => 'Buktikan kemampuanmu!',
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8"><circle cx="12" cy="12" r="10" fill="currentColor" opacity="0.2"/><path d="M7 4h10v6a5 5 0 0 1-10 0V4z" /><path d="M11 15v4h-3v2h8v-2h-3v-4a7.02 7.02 0 0 0 4.9-5.32A3.5 3.5 0 0 0 20.5 7H18V4H6v3H3.5a3.5 3.5 0 0 0 2.6 4.68A7.02 7.02 0 0 0 11 15zM5 7h1v3H5V7zm13 3V7h1v3h-1z" /></svg>',
            'route' => route('materi.belajar', ['step' => 6]),
            'color' => 'bg-[#FFD8A8]', // Soft Orange
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
            <a href="{{ route('dashboard') }}"
                class="w-14 h-14 flex items-center justify-center bg-[#FFB3B3] brutal-border brutal-shadow-sm brutal-hover rounded-2xl text-black"
                title="Keluar">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8">
                    <path opacity="0.2" d="M12 3L2 12h3v8h14v-8h3L12 3z" />
                    <path d="M12 3L2 12h3v8h14v-8h3L12 3zm0 2.83L18.17 12H17v6H7v-6H5.83L12 5.83z"
                        fill="currentColor" />
                </svg>
            </a>

            <!-- Game Title (Comic Retro Header) -->
            <h1
                class="text-2xl md:text-4xl font-black text-[#FFF5B8] text-outline uppercase tracking-tight transform -rotate-1 drop-shadow-[0_4px_0_#000]">
                Petualangan Samsul
            </h1>

            <div class="flex gap-4">
                <!-- Reset Progress Button (Orange Button, Visual-Only) -->
                <button onclick="resetProgress()"
                    class="w-14 h-14 flex items-center justify-center bg-[#FFD8A8] brutal-border brutal-shadow-sm brutal-hover rounded-2xl text-black"
                    title="Reset Progress">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8">
                        <circle cx="12" cy="12" r="10" opacity="0.2" />
                        <path
                            d="M17.65 6.35A7.958 7.958 0 0 0 12 4c-4.42 0-7.99 3.58-7.99 8s3.57 8 7.99 8c3.73 0 6.84-2.55 7.73-6h-2.08A5.99 5.99 0 0 1 12 18c-3.31 0-6-2.69-6-6s2.69-6 6-6c1.66 0 3.14.69 4.22 1.78L13 11h7V4l-2.35 2.35z"
                            fill="currentColor" />
                    </svg>
                </button>

                <!-- Help / Tutorial Button (Yellow Button, Visual-Only) -->
                <button onclick="showTutorial()"
                    class="w-14 h-14 flex items-center justify-center bg-[#FFF5B8] brutal-border brutal-shadow-sm brutal-hover rounded-2xl text-black"
                    title="Bantuan">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8">
                        <circle cx="12" cy="12" r="10" opacity="0.2" />
                        <path
                            d="M12 22C6.486 22 2 17.514 2 12S6.486 2 12 2s10 4.486 10 10-4.486 10-10 10zm0-18c-4.411 0-8 3.589-8 8s3.589 8 8 8 8-3.589 8-8-3.589-8-8-8zm.5 11h-1v-1a1.5 1.5 0 0 1 1.5-1.5h1A1.5 1.5 0 0 0 15 11c0-1-1-1.5-1.5-1.5S12 10 12 11h-2c0-2.2 1.8-4 4-4s4 1.8 4 4c0 1.5-1.2 2.5-2.5 2.5h-.5v2zm-1 3h2v-2h-2v2z"
                            fill="currentColor" />
                    </svg>
                </button>
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
                        4 => ['left' => '78%', 'top' => '62%'],
                        5 => ['left' => '46%', 'top' => '52%'],
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

            <!-- Finish Node (SLB School building) -->
            <div class="absolute transform -translate-x-1/2 -translate-y-1/2 flex flex-col items-center z-10"
                style="left: 82%; top: 76%;">
                <!-- Finish Anchor Dot -->
                <div id="finish-dot" class="absolute w-1 h-1" style="top: 3.5rem; left: 3.5rem;"></div>

                <div
                    class="w-28 h-28 rounded-[2.5rem] border-4 border-black bg-[#FFD1E3] brutal-shadow-sm flex items-center justify-center relative overflow-hidden group">
                    <span
                        class="absolute -top-3 -right-3 w-8 h-8 rounded-full border-4 border-black bg-white flex items-center justify-center font-black text-black text-sm">
                        🏁
                    </span>
                    <img src="{{ asset('images/keSekolah/SLB.png') }}"
                        class="w-20 h-auto drop-shadow-md group-hover:scale-110 transition-transform" alt="Sekolah SLB">
                </div>

                <div
                    class="mt-2 text-[10px] md:text-xs font-black text-black bg-white px-3 py-1 rounded-xl brutal-border brutal-shadow-sm text-center whitespace-nowrap uppercase tracking-wider">
                    Sekolah
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
                    <path d="M 40 60 C 100 20, 160 100, 220 60" stroke="#000" stroke-width="4" stroke-dasharray="8,8"
                        fill="none" />
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

        function resetProgress() {
            if (confirm(
                    "Apakah kamu yakin ingin mengulang perjalanan Samsul dari awal? Semua kemajuan belajar kamu akan dihapus."
                    )) {
                fetch('{{ route('materi.reset_progress') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }).then(() => {
                    window.location.reload();
                });
            }
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
