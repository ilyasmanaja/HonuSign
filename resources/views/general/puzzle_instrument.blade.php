<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <title>HonuSign - Harmoni Alat Musik Riau</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;600;700;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Fredoka', sans-serif;
            background-color: #FFFEFA !important;
            overflow-x: hidden;
        }

        .brutal-border {
            border: 3px solid #000000 !important;
        }

        .brutal-shadow {
            box-shadow: 6px 6px 0px 0px #000000 !important;
        }

        .brutal-shadow-sm {
            box-shadow: 3px 3px 0px 0px #000000 !important;
        }

        .brutal-hover {
            transition: all 0.2s ease-in-out !important;
        }

        .brutal-hover:hover {
            transform: translate(-3px, -3px) !important;
            box-shadow: 9px 9px 0px 0px #000000 !important;
        }

        .brutal-hover:active {
            transform: translate(2px, 2px) !important;
            box-shadow: 2px 2px 0px 0px #000000 !important;
        }


        /* Screen Shake Animation */
        @keyframes screen-shake {
            0% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-10px) rotate(-0.5deg);
            }

            50% {
                transform: translateX(10px) rotate(0.5deg);
            }

            75% {
                transform: translateX(-5px) rotate(-0.25deg);
            }

            100% {
                transform: translateX(0);
            }
        }

        .screen-shake {
            animation: screen-shake 0.3s ease;
        }

        /* Correct Placement Glow */
        @keyframes correct-glow {
            0% {
                box-shadow: inset 0 0 0 0 #D4F1BE;
            }

            50% {
                box-shadow: inset 0 0 30px 10px #D4F1BE;
            }

            100% {
                box-shadow: inset 0 0 0 0 #D4F1BE;
            }
        }

        .correct-glow .tile-inner {
            animation: correct-glow 0.6s ease;
        }

        /* Selected Tile Glow (Mekanik Tukar) */
        @keyframes selected-pulse {
            from {
                box-shadow: inset 0 0 0px #BEE9E8;
                transform: scale(1);
                border-color: #000;
            }

            to {
                box-shadow: inset 0 0 30px #BEE9E8;
                transform: scale(0.92);
                border-color: #BEE9E8;
            }
        }

        .selected-glow .tile-inner {
            animation: selected-pulse 0.8s infinite alternate ease-in-out;
            z-index: 10;
        }

        /* Puzzle Container */
        .puzzle-board {
            position: relative;
            background-color: #E2E8F0;
            aspect-ratio: 1 / 1;
            width: 100%;
            max-width: 500px;
        }

        .tile {
            position: absolute;
            width: 33.333%;
            height: 33.333%;
            padding: 2px;
            /* Gap antar tile (2px tiap sisi = 4px antar tile) */
            transition: left 0.3s ease-in-out, top 0.3s ease-in-out;
            cursor: pointer;
            z-index: 1;
        }

        /* Prioritas z-index agar animasi glow tidak tertutup tile lain */
        .tile.selected-glow {
            z-index: 50;
        }

        .tile-inner {
            width: 100%;
            height: 100%;
            background-size: 300% 300%;
            background-repeat: no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            font-weight: 900;
            color: rgba(255, 255, 255, 0);
            text-shadow: none;
            transition: color 0.3s, text-shadow 0.3s, border-color 0.3s;
        }

        /* Mode Hint: Tampilkan angka tipis */
        .show-hint .tile-inner {
            color: rgba(255, 255, 255, 0.9);
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.8);
        }

        /* Victory State: Gabungkan tile */
        .victory-state .tile {
            padding: 0 !important;
        }

        .victory-state .tile-inner {
            border: none !important;
            border-radius: 0 !important;
        }

        .victory-state .puzzle-board {
            box-shadow: 0 0 40px 10px #D4F1BE, 6px 6px 0px 0px #000000 !important;
            transition: box-shadow 1s ease;
        }

        /* Timer Bar */
        .timer-bar-container {
            width: 100%;
            height: 24px;
            background-color: #E2E8F0;
            border-radius: 12px;
            overflow: hidden;
            border: 3px solid #000;
            box-shadow: inset 2px 2px 0 rgba(0, 0, 0, 0.2);
        }

        .timer-bar {
            height: 100%;
            width: 100%;
            background-color: #D4F1BE;
            transition: width 1s linear, background-color 0.5s;
        }

        .timer-bar.warning {
            background-color: #FFF5B8;
        }

        .timer-bar.danger {
            background-color: #FF6B6B;
        }

        /* Bintang terbang kemenangan */
        .victory-star {
            position: absolute;
            width: 24px;
            height: 24px;
            background: #facc15;
            clip-path: polygon(50% 0%, 61% 35%, 98% 35%, 68% 57%, 79% 91%, 50% 70%, 21% 91%, 32% 57%, 2% 35%, 39% 35%);
            animation: fly-up 1.5s ease-out forwards;
            z-index: 100;
        }

        @keyframes fly-up {
            0% {
                transform: translateY(0) scale(0);
                opacity: 1;
            }

            50% {
                transform: translateY(-100px) scale(1.5);
                opacity: 1;
            }

            100% {
                transform: translateY(-300px) scale(0.5);
                opacity: 0;
            }
        }
    </style>
</head>

<body class="transition-transform">

    <!-- Intro Overlay -->
    <div id="intro-overlay"
        class="fixed inset-0 z-[9999] bg-[#FFFEFA] flex flex-col items-center justify-center transition-opacity duration-1000 ease-in-out">
        <div class="text-center px-6">
            <div
                class="inline-block px-6 py-2 bg-[#E0BBE4] brutal-border brutal-shadow-sm rounded-2xl text-sm font-bold mb-6 -rotate-2">
                Sliding Puzzle
            </div>
            <h1
                class="text-6xl md:text-8xl font-black text-black transform -rotate-2 animate-bounce text-center drop-shadow-[0_10px_0_rgba(0,0,0,0.15)]">
                Harmoni Riau
            </h1>
            <p
                class="mt-6 text-2xl font-bold text-slate-500 bg-[#FFF5B8] brutal-border brutal-shadow-sm px-6 py-2 rounded-2xl inline-block rotate-1">
                Mari Belajar Bersama!</p>
        </div>
    </div>

    <a href="{{ route('general.index') }}" aria-label="Kembali"
        class="absolute top-4 left-4 md:top-6 md:left-6 z-[110] bg-[#FFB3B3] text-black p-3.5 rounded-2xl font-bold brutal-border brutal-shadow-sm brutal-hover flex items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-7 h-7 text-black">
            <circle cx="12" cy="12" r="10" fill="currentColor" class="opacity-20" />
            <path d="M12 8l-4 4 4 4M16 12H8" stroke="currentColor" stroke-width="3" stroke-linecap="round"
                stroke-linejoin="round" fill="none" />
        </svg>
    </a>

    <!-- Judul Halaman (Dipindah ke atas agar selalu konsisten di Mobile & Desktop) -->
    <div class="pt-16 md:pt-20 px-4 flex justify-center max-w-7xl mx-auto">
        <h1 id="puzzle-title"
            class="mb-4 bg-[#FFF5B8] brutal-border brutal-shadow-sm px-8 py-3 rounded-2xl text-2xl md:text-3xl font-black uppercase tracking-widest text-center transform -rotate-1 min-w-[220px] shadow-sm">
            Alat Musik
        </h1>
    </div>

    <!-- Main Container Layout: Bento Grid Style dengan lg:flex-row-reverse agar Target Gambar di atas saat Mobile -->
    <div
        class="pb-8 pt-4 px-4 md:px-8 flex flex-col lg:flex-row-reverse items-center lg:items-stretch justify-center gap-6 md:gap-8 max-w-6xl mx-auto">

        <!-- Area Kanan (Muncul Pertama di Mobile): Panel Kontrol & Referensi -->
        <div class="w-full lg:w-[360px] flex flex-col justify-between gap-5">

            <!-- Referensi Gambar -->
            <div class="bg-[#FFFEFA] brutal-border brutal-shadow-sm rounded-3xl p-5 flex flex-col items-center">
                <h2 class="text-lg font-black uppercase tracking-widest mb-3 text-slate-800">Target Gambar</h2>
                <div
                    class="w-44 h-44 md:w-52 md:h-52 brutal-border brutal-shadow-sm rounded-2xl overflow-hidden relative bg-slate-100">
                    <img id="reference-img" src="" alt="Referensi Alat Musik"
                        class="w-full h-full object-cover">
                </div>
            </div>

            <!-- Progress & Kontrol -->
            <div class="bg-[#E0BBE4] brutal-border brutal-shadow rounded-3xl p-5 flex flex-col gap-4">

                <div class="flex justify-between items-end">
                    <span class="font-black text-base uppercase tracking-widest">Langkah:</span>
                    <span id="moves-count"
                        class="text-3xl font-black bg-[#FFFEFA] brutal-border px-4 py-0.5 rounded-2xl transform rotate-2 shadow-sm">0</span>
                </div>

                <div class="flex flex-col gap-1.5">
                    <span class="font-black text-base uppercase tracking-widest">Waktu Tersisa:</span>
                    <div class="timer-bar-container h-4">
                        <div id="timer-bar" class="timer-bar"></div>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-2 mt-1">
                    <button id="btn-shuffle" aria-label="Acak"
                        class="bg-[#FFF5B8] brutal-border brutal-shadow-sm brutal-hover py-3.5 rounded-2xl flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 h-6 text-black"
                            fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                            stroke-linejoin="round">
                            <polyline points="16 3 21 3 21 8"></polyline>
                            <line x1="4" y1="20" x2="21" y2="3"></line>
                            <polyline points="21 16 21 21 16 21"></polyline>
                            <line x1="15" y1="15" x2="21" y2="21"></line>
                            <line x1="4" y1="4" x2="9" y2="9"></line>
                        </svg>
                    </button>
                    <button id="btn-hint" aria-label="Bantuan"
                        class="bg-[#BEE9E8] brutal-border brutal-shadow-sm brutal-hover py-3.5 rounded-2xl flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 h-6 text-black"
                            fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path
                                d="M15 14c.2-1 .7-1.7 1.5-2.5 1-.9 1.5-2.2 1.5-3.5A5 5 0 0 0 8 8c0 1 .3 2.2 1.5 3.5.7.7 1.3 1.5 1.5 2.5">
                            </path>
                            <line x1="9" y1="18" x2="15" y2="18"></line>
                            <line x1="10" y1="22" x2="14" y2="22"></line>
                        </svg>
                    </button>
                    <button id="btn-tutorial" onclick="showTutorial()" aria-label="Tutorial"
                        class="bg-[#FFD1E3] brutal-border brutal-shadow-sm brutal-hover py-3.5 rounded-2xl flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 h-6 text-black"
                            fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                            stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                            <line x1="12" y1="17" x2="12.01" y2="17"></line>
                        </svg>
                    </button>
                </div>

            </div>
        </div>

        <!-- Area Kiri (Muncul Kedua di Mobile, Kiri di Desktop): Puzzle Board -->
        <div class="w-full lg:w-[500px] flex flex-col items-center justify-center">
            <!-- Board 3x3 -->
            <div id="board-container"
                class="puzzle-board brutal-border brutal-shadow rounded-2xl p-1 w-full aspect-square">
                <!-- Tiles will be generated by JS -->
            </div>
        </div>

    </div>

    <!-- Interactive Visual Tutorial Overlay -->
    <div id="tutorial-overlay"
        class="fixed inset-0 bg-slate-900/80 backdrop-blur-md z-[5000] flex items-center justify-center p-4 transition-opacity duration-500 opacity-0 pointer-events-none">
        <div class="bg-[#FFFEFA] brutal-border brutal-shadow p-8 md:p-12 rounded-[3rem] max-w-xl w-full flex flex-col items-center text-center relative transform scale-90 transition-transform duration-500"
            id="tutorial-modal-content">

            <div
                class="bg-[#FFF5B8] px-6 py-2 rounded-2xl brutal-border brutal-shadow-sm font-black text-sm mb-6 -rotate-2">
                TUTORIAL SINGKAT
            </div>

            <h2 class="text-3xl md:text-5xl font-black text-black tracking-tight mb-6">
                Cara Menukar Kotak!
            </h2>

            <!-- Animasi Simulasi Papan -->
            <div
                class="relative w-48 h-48 bg-[#E2E8F0] brutal-border rounded-2xl p-2 grid grid-cols-2 gap-2 mb-8 mx-auto overflow-hidden shadow-inner">
                <!-- Kotak 1 (Kuning) -->
                <div id="sim-box-1"
                    class="bg-[#FFF5B8] brutal-border rounded-xl flex items-center justify-center font-black text-2xl transition-all duration-500 shadow-sm">
                    A
                </div>
                <!-- Kotak 2 (Biru) -->
                <div id="sim-box-2"
                    class="bg-[#BEE9E8] brutal-border rounded-xl flex items-center justify-center font-black text-2xl transition-all duration-500 shadow-sm">
                    B
                </div>
                <!-- Kotak 3 & 4 (Abu-abu pasif) -->
                <div
                    class="bg-slate-300 brutal-border rounded-xl flex items-center justify-center font-bold text-slate-500">
                    C</div>
                <div
                    class="bg-slate-300 brutal-border rounded-xl flex items-center justify-center font-bold text-slate-500">
                    D</div>

                <!-- Tangan Animasi Cursor -->
                <div id="sim-cursor"
                    class="absolute w-10 h-10 transition-all duration-700 pointer-events-none z-50 flex items-center justify-center text-3xl"
                    style="top: 70%; left: 70%;">
                    👆
                </div>
            </div>

            <!-- Penjelasan Teks -->
            <div
                class="flex flex-col gap-4 text-left w-full bg-[#F8FAFC] brutal-border p-6 rounded-2xl mb-8 shadow-sm">
                <div class="flex items-start gap-3">
                    <span
                        class="bg-[#FFF5B8] w-8 h-8 rounded-xl brutal-border flex items-center justify-center font-black text-sm shrink-0 mt-0.5">1</span>
                    <p class="font-bold text-slate-700 text-sm md:text-base"><b>Klik kotak pertama</b> yang ingin
                        dipindah (misal kotak A).</p>
                </div>
                <div class="flex items-start gap-3">
                    <span
                        class="bg-[#BEE9E8] w-8 h-8 rounded-xl brutal-border flex items-center justify-center font-black text-sm shrink-0 mt-0.5">2</span>
                    <p class="font-bold text-slate-700 text-sm md:text-base"><b>Klik kotak kedua</b> (misal kotak B)
                        untuk menukar posisi mereka!</p>
                </div>
            </div>

            <button onclick="closeTutorial()" aria-label="Mengerti"
                class="w-full md:w-auto bg-[#D4F1BE] text-black p-4 rounded-3xl brutal-border brutal-shadow-sm brutal-hover flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-10 h-10 text-black">
                    <circle cx="12" cy="12" r="10" fill="currentColor" class="opacity-20" />
                    <polyline points="20 6 9 17 4 12" stroke="currentColor" stroke-width="3" stroke-linecap="round"
                        stroke-linejoin="round" fill="none" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Victory Modal -->
    <div id="win-modal"
        class="hidden fixed inset-0 z-[120] bg-black/60 backdrop-blur-sm flex-col items-center justify-center p-4">
        <div class="bg-[#FFFEFA] p-8 md:p-12 rounded-[3rem] brutal-border brutal-shadow flex flex-col items-center text-center transform scale-90 opacity-0 transition-all duration-500"
            id="win-modal-content">

            <div class="flex gap-4 mb-6 animate-bounce">
                <!-- Smiling Face Icon -->
                <div
                    class="relative w-20 h-20 bg-[#BEE9E8] rounded-full brutal-border brutal-shadow-sm flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-12 h-12 text-black">
                        <circle cx="12" cy="12" r="10" fill="#FFF5B8" class="opacity-20" />
                        <circle cx="12" cy="12" r="10" fill="none" stroke="currentColor"
                            stroke-width="2.5" />
                        <circle cx="8.5" cy="10.5" r="1.5" fill="currentColor" />
                        <circle cx="15.5" cy="10.5" r="1.5" fill="currentColor" />
                        <path d="M8 15c1.5 2 4.5 2 6 0" fill="none" stroke="currentColor" stroke-width="2.5"
                            stroke-linecap="round" />
                    </svg>
                </div>
                <!-- Thumbs Up Icon -->
                <div
                    class="relative w-20 h-20 bg-[#FFD1E3] rounded-full brutal-border brutal-shadow-sm flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-12 h-12 text-black">
                        <path
                            d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"
                            fill="#BEE9E8" class="opacity-20" />
                        <path
                            d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"
                            fill="none" stroke="currentColor" stroke-width="2.5" stroke-linejoin="round"
                            stroke-linecap="round" />
                    </svg>
                </div>
            </div>

            <h2 class="text-5xl md:text-7xl font-black text-black mb-3 transform -rotate-2">SELAMAT!</h2>
            <p class="text-xl font-bold text-slate-600 mb-4 max-w-md">Anda berhasil menyusun gambar alat musik ini
                dengan sangat baik.</p>
            <h3 id="win-instrument-name"
                class="text-3xl md:text-4xl font-black text-black mb-8 bg-[#FFF5B8] brutal-border brutal-shadow-sm px-6 py-2 rounded-2xl transform rotate-1">
                Nama Alat</h3>

            <div class="flex justify-center gap-4">
                <button id="btn-lanjut" onclick="initGame()" aria-label="Lanjut"
                    class="hidden bg-[#D4F1BE] text-black p-5 rounded-3xl brutal-border brutal-shadow-sm brutal-hover flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-10 h-10 text-black">
                        <circle cx="12" cy="12" r="10" fill="currentColor" class="opacity-20" />
                        <polyline points="12 8 16 12 12 16" stroke="currentColor" stroke-width="3"
                            stroke-linecap="round" stroke-linejoin="round" fill="none" />
                        <line x1="8" y1="12" x2="16" y2="12" stroke="currentColor"
                            stroke-width="3" stroke-linecap="round" fill="none" />
                    </svg>
                </button>
                <button id="btn-ulangi" onclick="initGame()" aria-label="Main Lagi"
                    class="hidden bg-[#FFF5B8] text-black p-5 rounded-3xl brutal-border brutal-shadow-sm brutal-hover flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-10 h-10 text-black">
                        <circle cx="12" cy="12" r="10" fill="currentColor" class="opacity-20" />
                        <path d="M21.5 2v6h-6M21.34 15.57a10 10 0 1 1-.57-8.38l.57-1.19" stroke="currentColor"
                            stroke-width="3" stroke-linecap="round" stroke-linejoin="round" fill="none" />
                    </svg>
                </button>
                <button onclick="window.location.href='{{ route('general.index') }}'" aria-label="Keluar"
                    class="bg-[#FFB3B3] text-black p-5 rounded-3xl brutal-border brutal-shadow-sm brutal-hover flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-10 h-10 text-black">
                        <circle cx="12" cy="12" r="10" fill="currentColor" class="opacity-20" />
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" stroke="currentColor"
                            stroke-width="3" stroke-linecap="round" stroke-linejoin="round" fill="none" />
                        <polyline points="9 22 9 12 15 12 15 22" stroke="currentColor" stroke-width="3"
                            stroke-linecap="round" stroke-linejoin="round" fill="none" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <script>
        // Data Gambar Alat Musik
        const instruments = [{
                id: 3,
                name: 'Kompang',
                src: 'Kompang.png'
            },
            {
                id: 1,
                name: 'Gambus',
                src: 'Gambus.png'
            },
            {
                id: 2,
                name: 'Gedombak',
                src: 'Gedombak.png'
            },
            {
                id: 4,
                name: 'Marwas',
                src: 'marwas.png'
            }
        ];

        let playedInstrumentIds = [];

        let currentImage = '';
        let tiles = [];
        const gridSize = 3; // 3x3
        let isVictory = false;
        let moves = 0;

        let selectedTile = null;

        // Timer
        let timeTotal = 180; // 3 Menit dalam detik
        let timeLeft = timeTotal;
        let timerInterval = null;

        const board = document.getElementById('board-container');
        const movesEl = document.getElementById('moves-count');
        const timerBar = document.getElementById('timer-bar');
        const refImg = document.getElementById('reference-img');

        function initGame() {
            // Reset state
            isVictory = false;
            moves = 0;
            movesEl.innerText = moves;
            selectedTile = null;
            board.innerHTML = '';
            board.classList.remove('victory-state', 'show-hint');
            document.getElementById('win-modal').classList.add('hidden');
            document.getElementById('win-modal').classList.remove('flex');

            // Pilih instrumen secara sekuensial
            let nextIndex = playedInstrumentIds.length;
            if (nextIndex >= instruments.length) {
                playedInstrumentIds = [];
                nextIndex = 0;
            }
            const inst = instruments[nextIndex];
            playedInstrumentIds.push(inst.id); // Tandai sudah dimainkan di ronde ini

            currentImage = `{{ asset('images/general/musik') }}/${inst.src}`;
            refImg.src = currentImage;

            // Set Title
            document.getElementById('puzzle-title').innerText = inst.name;
            document.title = `HonuSign - ${inst.name}`;

            // Set Instrument name for victory modal
            document.getElementById('win-instrument-name').innerText = inst.name;

            // Create Tiles
            tiles = [];
            for (let r = 0; r < gridSize; r++) {
                for (let c = 0; c < gridSize; c++) {
                    const tile = document.createElement('div');
                    tile.className = 'tile';

                    // The visual inside
                    const inner = document.createElement('div');
                    inner.className = 'tile-inner brutal-border rounded-xl bg-white';
                    inner.style.backgroundImage = `url('${currentImage}')`;

                    // Background position mapping
                    const bgPosX = (c / (gridSize - 1)) * 100;
                    const bgPosY = (r / (gridSize - 1)) * 100;
                    inner.style.backgroundPosition = `${bgPosX}% ${bgPosY}%`;
                    inner.innerText = (r * gridSize + c + 1); // For hint

                    tile.appendChild(inner);

                    // Store logical state
                    const tileData = {
                        el: tile,
                        inner: inner,
                        correctR: r,
                        correctC: c,
                        currentR: r,
                        currentC: c
                    };

                    updateTilePos(tileData);

                    tile.addEventListener('click', () => handleTileClick(tileData));

                    tiles.push(tileData);
                    board.appendChild(tile);
                }
            }

            // Shuffle directly
            shuffleBoard(50);
        }

        function updateTilePos(tileData) {
            tileData.el.style.left = `${(tileData.currentC * 100) / gridSize}%`;
            tileData.el.style.top = `${(tileData.currentR * 100) / gridSize}%`;
        }

        function handleTileClick(tileData) {
            if (isVictory) return;

            if (selectedTile === null) {
                // Pilih tile pertama
                selectedTile = tileData;
                tileData.el.classList.add('selected-glow');
            } else if (selectedTile === tileData) {
                // Batal pilih jika klik tile yang sama
                selectedTile.el.classList.remove('selected-glow');
                selectedTile = null;
            } else {
                // Lakukan Swap
                const tempR = selectedTile.currentR;
                const tempC = selectedTile.currentC;

                selectedTile.currentR = tileData.currentR;
                selectedTile.currentC = tileData.currentC;

                tileData.currentR = tempR;
                tileData.currentC = tempC;

                updateTilePos(selectedTile);
                updateTilePos(tileData);

                selectedTile.el.classList.remove('selected-glow');

                moves++;
                movesEl.innerText = moves;

                // Check correct placement glow
                if (selectedTile.currentR === selectedTile.correctR && selectedTile.currentC === selectedTile.correctC) {
                    selectedTile.el.classList.add('correct-glow');
                    setTimeout(() => selectedTile.el.classList.remove('correct-glow'), 600);
                }
                if (tileData.currentR === tileData.correctR && tileData.currentC === tileData.correctC) {
                    tileData.el.classList.add('correct-glow');
                    setTimeout(() => tileData.el.classList.remove('correct-glow'), 600);
                }

                selectedTile = null;
                checkVictory();
            }
        }

        function checkVictory() {
            const won = tiles.every(t => t.currentR === t.correctR && t.currentC === t.correctC);
            if (won) {
                isVictory = true;
                clearInterval(timerInterval);

                // Trigger visual changes
                setTimeout(() => {
                    board.classList.add('victory-state'); // Removes borders and gaps
                    board.classList.remove('show-hint'); // Hide hints
                    spawnVictoryStars();
                }, 300);

                setTimeout(() => {
                    showWinModal();
                }, 1500);
            }
        }

        function shuffleBoard(steps) {
            // Random swap untuk mengacak puzzle
            for (let i = 0; i < steps; i++) {
                const idx1 = Math.floor(Math.random() * tiles.length);
                const idx2 = Math.floor(Math.random() * tiles.length);

                const tempR = tiles[idx1].currentR;
                const tempC = tiles[idx1].currentC;

                tiles[idx1].currentR = tiles[idx2].currentR;
                tiles[idx1].currentC = tiles[idx2].currentC;

                tiles[idx2].currentR = tempR;
                tiles[idx2].currentC = tempC;
            }

            // Apply visual positions without animation delay for fast shuffle
            tiles.forEach(t => {
                t.el.style.transition = 'none';
                updateTilePos(t);
                setTimeout(() => t.el.style.transition = 'left 0.3s ease-in-out, top 0.3s ease-in-out', 50);
            });
        }

        function spawnVictoryStars() {
            for (let i = 0; i < 10; i++) {
                const star = document.createElement('div');
                star.className = 'victory-star';
                star.style.left = `${Math.random() * 80 + 10}%`;
                star.style.top = `${Math.random() * 80 + 10}%`;
                star.style.animationDelay = `${Math.random() * 0.5}s`;
                board.appendChild(star);
                setTimeout(() => star.remove(), 2000);
            }
        }

        function showWinModal() {
            const modal = document.getElementById('win-modal');
            const content = document.getElementById('win-modal-content');

            const btnLanjut = document.getElementById('btn-lanjut');
            const btnUlangi = document.getElementById('btn-ulangi');

            // Cek apakah masih ada alat musik yang belum dimainkan
            if (playedInstrumentIds.length < instruments.length) {
                btnLanjut.classList.remove('hidden');
                btnUlangi.classList.add('hidden');
            } else {
                // Sudah 4 gambar dimainkan semua
                btnLanjut.classList.add('hidden');
                btnUlangi.classList.remove('hidden');
            }

            modal.classList.remove('hidden');
            modal.classList.add('flex');

            setTimeout(() => {
                content.classList.remove('scale-90', 'opacity-0');
                content.classList.add('scale-100', 'opacity-100');
            }, 50);
        }

        function resetTimer() {
            clearInterval(timerInterval);
            timeLeft = timeTotal;
            updateTimerVisual();
            timerInterval = setInterval(() => {
                if (isVictory) return;
                timeLeft--;
                updateTimerVisual();
                if (timeLeft <= 0) {
                    clearInterval(timerInterval);
                    // Jika waktu habis, biarkan anak tetap lanjut bermain
                }
            }, 1000);
        }

        function updateTimerVisual() {
            const pct = Math.max(0, (timeLeft / timeTotal) * 100);
            timerBar.style.width = `${pct}%`;

            if (pct > 50) {
                timerBar.className = 'timer-bar';
            } else if (pct > 20) {
                timerBar.className = 'timer-bar warning';
            } else {
                timerBar.className = 'timer-bar danger';
            }
        }

        // Event Listeners
        document.getElementById('btn-shuffle').addEventListener('click', () => {
            if (isVictory) return;
            shuffleBoard(50);
            moves = 0;
            movesEl.innerText = moves;
        });

        document.getElementById('btn-hint').addEventListener('click', () => {
            board.classList.toggle('show-hint');
        });

        let tutorialAnimTimer = null;

        function runTutorialAnimation() {
            const box1 = document.getElementById('sim-box-1');
            const box2 = document.getElementById('sim-box-2');
            const cursor = document.getElementById('sim-cursor');
            if (!box1 || !box2 || !cursor) return;

            // Reset posisi awal
            box1.className =
                'bg-[#FFF5B8] brutal-border rounded-xl flex items-center justify-center font-black text-2xl transition-all duration-500 shadow-sm';
            box2.className =
                'bg-[#BEE9E8] brutal-border rounded-xl flex items-center justify-center font-black text-2xl transition-all duration-500 shadow-sm';
            box1.innerText = 'A';
            box2.innerText = 'B';
            cursor.style.top = '70%';
            cursor.style.left = '70%';

            // Langkah 1: Gerak ke Kotak 1 (A)
            setTimeout(() => {
                cursor.style.top = '15%';
                cursor.style.left = '15%';
            }, 600);

            // Langkah 2: Klik Kotak 1 (A)
            setTimeout(() => {
                box1.classList.add('ring-4', 'ring-pink-400', 'scale-95');
                cursor.style.transform = 'scale(0.8)';
            }, 1400);

            // Langkah 3: Gerak ke Kotak 2 (B)
            setTimeout(() => {
                box1.classList.remove('scale-95');
                cursor.style.transform = 'scale(1)';
                cursor.style.top = '15%';
                cursor.style.left = '65%';
            }, 2000);

            // Langkah 4: Klik Kotak 2 (B) & Tukar Posisi
            setTimeout(() => {
                box2.classList.add('scale-95');
                cursor.style.transform = 'scale(0.8)';
            }, 2800);

            // Langkah 5: Tukar Teks / Warna
            setTimeout(() => {
                box2.classList.remove('scale-95');
                cursor.style.transform = 'scale(1)';
                box1.classList.remove('ring-4', 'ring-pink-400');

                // Tukar isi
                box1.innerText = 'B';
                box1.classList.replace('bg-[#FFF5B8]', 'bg-[#BEE9E8]');

                box2.innerText = 'A';
                box2.classList.replace('bg-[#BEE9E8]', 'bg-[#FFF5B8]');
            }, 3200);
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
            // Mulai timer saat anak mulai bermain
            if (timeLeft === timeTotal) {
                resetTimer();
            }
        }

        // Initialize on load with Intro Overlay
        document.addEventListener('DOMContentLoaded', () => {
            initGame();

            setTimeout(() => {
                const overlay = document.getElementById('intro-overlay');
                if (overlay) {
                    overlay.style.opacity = '0';
                    setTimeout(() => {
                        overlay.remove();
                        showTutorial();
                    }, 1000);
                }
            }, 2500);
        });
    </script>
</body>

</html>
