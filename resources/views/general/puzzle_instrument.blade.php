<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <title>HonuSign - Harmoni Alat Musik Riau</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;600;700;900&display=swap" rel="stylesheet">
    <style>
        .puzzle-instrument-container {
            font-family: 'Fredoka', sans-serif;
            min-height: 100vh;
            width: 100vw;
            background-color: #FFFEFA;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
        }

        .puzzle-instrument-container * {
            font-family: 'Fredoka', sans-serif;
        }

        body {
            background-color: #FFFEFA;
            overflow-x: hidden;
        }

        .puzzle-instrument-container .brutal-border {
            border: 3px solid #000000;
        }

        .puzzle-instrument-container .brutal-shadow {
            box-shadow: 6px 6px 0px 0px #000000;
        }

        .puzzle-instrument-container .brutal-shadow-sm {
            box-shadow: 3px 3px 0px 0px #000000;
        }

        .puzzle-instrument-container .brutal-hover {
            transition: all 0.15s ease-in-out;
        }

        .puzzle-instrument-container .brutal-hover:hover {
            transform: translate(-2px, -2px);
            box-shadow: 5px 5px 0px 0px #000000;
        }

        .puzzle-instrument-container .brutal-hover:active {
            transform: translate(1px, 1px);
            box-shadow: 2px 2px 0px 0px #000000;
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
    <div class="puzzle-instrument-container">

        <!-- Intro Overlay -->
        <div id="intro-overlay"
            class="fixed inset-0 z-[9999] bg-[#FFFEFA] flex flex-col items-center justify-center transition-opacity duration-500 ease-in-out">
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
                    class="mt-6 text-2xl font-bold text-slate-900 bg-[#FFF5B8] brutal-border brutal-shadow-sm px-6 py-2 rounded-2xl inline-block rotate-1">
                    Mari Belajar Bersama!</p>
            </div>
        </div>

        <!-- Back Button with Tooltip -->
        <div class="absolute top-4 left-4 md:top-6 md:left-6 z-[110] group/tooltip pointer-events-auto">
            <a href="{{ route('general.index') }}" aria-label="Kembali"
                class="bg-[#FFB3B3] text-black p-3.5 rounded-2xl font-bold brutal-border brutal-shadow-sm brutal-hover flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-7 h-7 text-black" fill="none"
                    stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 12H5M12 19l-7-7 7-7" />
                </svg>
            </a>
            <div
                class="pointer-events-none absolute left-0 top-full mt-3 bg-[#FFD1E3] brutal-border brutal-shadow-sm px-3 py-1.5 rounded-lg text-sm font-bold opacity-0 scale-95 group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-150 whitespace-nowrap z-50 text-black">
                Kembali
            </div>
        </div>

        <!-- Judul Halaman -->
        <div class="pt-16 md:pt-20 px-4 flex justify-center max-w-7xl mx-auto">
            <h1 id="puzzle-title"
                class="mb-4 bg-[#FFF5B8] brutal-border brutal-shadow-sm px-8 py-3 rounded-2xl text-2xl md:text-3xl font-black uppercase tracking-widest text-center transform -rotate-1 min-w-[220px] shadow-sm">
                Alat Musik
            </h1>
        </div>

        <!-- Main Container Layout -->
        <div
            class="pb-8 pt-4 px-4 md:px-8 flex flex-col lg:flex-row-reverse items-center lg:items-stretch justify-center gap-6 md:gap-8 max-w-6xl mx-auto">

            <!-- Area Kanan -->
            <div class="w-full lg:w-[360px] flex flex-col justify-between gap-5">

                <!-- Referensi Gambar -->
                <div class="bg-[#FFFEFA] brutal-border brutal-shadow-sm rounded-3xl p-5 flex flex-col items-center">
                    <h2 class="text-lg font-black uppercase tracking-widest mb-3 text-slate-800">Target Gambar</h2>
                    <div
                        class="w-44 h-44 md:w-52 md:h-52 brutal-border brutal-shadow-sm rounded-2xl overflow-hidden relative bg-slate-100">
                        <img id="reference-img" src="" alt="Referensi Alat Musik"
                            class="w-full h-full object-cover"
                            onerror="this.onerror=null; this.src='https://via.placeholder.com/200?text=Alat+Musik';">
                    </div>
                </div>

                <!-- Progress & Kontrol -->
                <div class="bg-[#E0BBE4] brutal-border brutal-shadow rounded-3xl p-5 flex flex-col gap-4">

                    <div class="flex justify-between items-end">
                        <span class="font-black text-base uppercase tracking-widest">Langkah:</span>
                        <span id="moves-count"
                            class="text-3xl font-black bg-[#FFFEFA] brutal-border px-4 py-0.5 rounded-2xl transform rotate-2 shadow-sm">0</span>
                    </div>

                    <div class="grid grid-cols-3 gap-2 mt-1">
                        <!-- Shuffle Button with Tooltip -->
                        <div class="relative group/tooltip">
                            <button id="btn-shuffle" aria-label="Acak"
                                class="w-full bg-[#FFF5B8] brutal-border brutal-shadow-sm brutal-hover py-3.5 rounded-2xl flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 h-6 text-black"
                                    fill="#BEE9E8" stroke="currentColor" stroke-width="3.5" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <polyline points="16 3 21 3 21 8"></polyline>
                                    <line x1="4" y1="20" x2="21" y2="3"></line>
                                    <polyline points="21 16 21 21 16 21"></polyline>
                                    <line x1="15" y1="15" x2="21" y2="21"></line>
                                    <line x1="4" y1="4" x2="9" y2="9"></line>
                                </svg>
                            </button>
                            <div
                                class="pointer-events-none absolute bottom-full left-1/2 -translate-x-1/2 mb-3 bg-[#FFD1E3] brutal-border brutal-shadow-sm px-3 py-1.5 rounded-lg text-sm font-bold opacity-0 scale-95 group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-150 whitespace-nowrap z-50 text-black">
                                Acak Papan
                            </div>
                        </div>

                        <!-- Hint Button with Tooltip -->
                        <div class="relative group/tooltip">
                            <button id="btn-hint" aria-label="Bantuan"
                                class="w-full bg-[#BEE9E8] brutal-border brutal-shadow-sm brutal-hover py-3.5 rounded-2xl flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 h-6 text-black"
                                    fill="#facc15" stroke="currentColor" stroke-width="3.5" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path
                                        d="M15 14c.2-1 .7-1.7 1.5-2.5 1-.9 1.5-2.2 1.5-3.5A5 5 0 0 0 8 8c0 1 .3 2.2 1.5 3.5.7.7 1.3 1.5 1.5 2.5">
                                    </path>
                                    <line x1="9" y1="18" x2="15" y2="18"></line>
                                    <line x1="10" y1="22" x2="14" y2="22"></line>
                                </svg>
                            </button>
                            <div
                                class="pointer-events-none absolute bottom-full left-1/2 -translate-x-1/2 mb-3 bg-[#FFD1E3] brutal-border brutal-shadow-sm px-3 py-1.5 rounded-lg text-sm font-bold opacity-0 scale-95 group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-150 whitespace-nowrap z-50 text-black">
                                Bantuan
                            </div>
                        </div>

                        <!-- Tutorial Button with Tooltip -->
                        <div class="relative group/tooltip">
                            <button id="btn-tutorial" onclick="showTutorial()" aria-label="Tutorial"
                                class="w-full bg-[#FFD1E3] brutal-border brutal-shadow-sm brutal-hover py-3.5 rounded-2xl flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 h-6 text-black"
                                    fill="#FFD1E3" stroke="currentColor" stroke-width="3.5" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" fill="none"></path>
                                    <line x1="12" y1="17" x2="12.01" y2="17"></line>
                                </svg>
                            </button>
                            <div
                                class="pointer-events-none absolute bottom-full left-1/2 -translate-x-1/2 mb-3 bg-[#FFD1E3] brutal-border brutal-shadow-sm px-3 py-1.5 rounded-lg text-sm font-bold opacity-0 scale-95 group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-150 whitespace-nowrap z-50 text-black">
                                Petunjuk
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Area Kiri -->
            <div class="w-full lg:w-[500px] flex flex-col items-center justify-center">
                <!-- Board 3x3 -->
                <div id="board-container"
                    class="puzzle-board brutal-border brutal-shadow rounded-3xl p-1 w-full aspect-square">
                    <!-- Tiles will be generated by JS -->
                </div>
            </div>

        </div>

        <!-- Interactive Visual Tutorial Overlay -->
        <div id="tutorial-overlay"
            class="fixed inset-0 bg-slate-900/80 backdrop-blur-md z-[5000] flex items-center justify-center p-4 transition-opacity duration-500 opacity-0 pointer-events-none">
            <div class="bg-[#FFFEFA] brutal-border brutal-shadow p-8 md:p-12 rounded-3xl max-w-xl w-full flex flex-col items-center text-center relative transform scale-90 transition-transform duration-500"
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
                    class="relative w-48 h-48 bg-[#E2E8F0] brutal-border rounded-3xl p-2 grid grid-cols-2 gap-2 mb-8 mx-auto overflow-hidden shadow-inner">
                    <!-- Kotak 1 -->
                    <div id="sim-box-1"
                        class="bg-[#FFF5B8] brutal-border rounded-xl flex items-center justify-center font-black text-2xl transition-all duration-500 shadow-sm">
                        A
                    </div>
                    <!-- Kotak 2 -->
                    <div id="sim-box-2"
                        class="bg-[#BEE9E8] brutal-border rounded-xl flex items-center justify-center font-black text-2xl transition-all duration-500 shadow-sm">
                        B
                    </div>
                    <!-- Kotak 3 & 4 -->
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
                        <p class="font-bold text-slate-900 text-base md:text-lg"><b>Klik kotak pertama</b> yang ingin
                            dipindah (misal kotak A).</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <span
                            class="bg-[#BEE9E8] w-8 h-8 rounded-xl brutal-border flex items-center justify-center font-black text-sm shrink-0 mt-0.5">2</span>
                        <p class="font-bold text-slate-900 text-base md:text-lg"><b>Klik kotak kedua</b> (misal kotak
                            B)
                            untuk menukar posisi mereka!</p>
                    </div>
                </div>

                <div class="relative group/tooltip w-full md:w-auto">
                    <button onclick="closeTutorial()" aria-label="Mengerti"
                        class="w-full md:w-auto bg-[#D4F1BE] text-black p-4 rounded-2xl brutal-border brutal-shadow-sm brutal-hover flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-10 h-10 text-black"
                            fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round"
                            stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12" />
                        </svg>
                    </button>
                    <div
                        class="pointer-events-none absolute bottom-full left-1/2 -translate-x-1/2 mb-3 bg-[#FFD1E3] brutal-border brutal-shadow-sm px-3 py-1.5 rounded-lg text-sm font-bold opacity-0 scale-95 group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-150 whitespace-nowrap z-50 text-black">
                        Mengerti
                    </div>
                </div>
            </div>
        </div>

        <!-- Victory Modal -->
        <div id="win-modal"
            class="hidden fixed inset-0 z-[120] bg-black/60 backdrop-blur-sm flex-col items-center justify-center p-4">
            <div class="relative w-full max-w-[480px] aspect-square transform scale-90 opacity-0 transition-all duration-500 select-none"
                id="win-modal-content">

                <!-- Main Image -->
                <img src="{{ asset('images/selamat.png') }}" alt="Selamat!"
                    class="w-full h-full object-contain rounded-3xl brutal-border brutal-shadow">

                <!-- Interactive Buttons Overlaid over pre-rendered spots -->
                <div class="absolute bottom-[9%] left-0 right-0 flex justify-center gap-[8%]">
                    <!-- Left Slot: Replay OR Lanjut -->
                    <div class="w-[18%] aspect-square relative">
                        <!-- Button Lanjut (Next) -->
                        <div class="relative group/tooltip w-full h-full">
                            <button id="btn-lanjut" onclick="initGame()" aria-label="Lanjut"
                                class="hidden bg-[#D4F1BE] text-black w-full h-full rounded-2xl brutal-border brutal-shadow-sm brutal-hover flex items-center justify-center cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    class="w-1/2 h-1/2 text-black fill-none stroke-current" stroke-width="3.5"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </button>
                            <div
                                class="pointer-events-none absolute bottom-full left-1/2 -translate-x-1/2 mb-3 bg-[#FFD1E3] brutal-border brutal-shadow-sm px-3 py-1.5 rounded-lg text-sm font-bold opacity-0 scale-95 group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-150 whitespace-nowrap z-50 text-black">
                                Lanjut
                            </div>
                        </div>
                        <!-- Button Ulangi (Replay) -->
                        <div class="relative group/tooltip w-full h-full">
                            <button id="btn-ulangi" onclick="initGame()" aria-label="Main Lagi"
                                class="hidden bg-[#FFF5B8] text-black w-full h-full rounded-2xl brutal-border brutal-shadow-sm brutal-hover flex items-center justify-center cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                    class="w-1/2 h-1/2 text-black fill-none stroke-current" stroke-width="3.5"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21.5 2v6h-6M21.34 15.57a10 10 0 1 1-.57-8.38l.57-1.19" />
                                </svg>
                            </button>
                            <div
                                class="pointer-events-none absolute bottom-full left-1/2 -translate-x-1/2 mb-3 bg-[#FFD1E3] brutal-border brutal-shadow-sm px-3 py-1.5 rounded-lg text-sm font-bold opacity-0 scale-95 group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-150 whitespace-nowrap z-50 text-black">
                                Main Lagi
                            </div>
                        </div>
                    </div>
                    <!-- Right Slot: Home -->
                    <div class="relative group/tooltip w-[18%] aspect-square">
                        <button onclick="window.location.href='{{ route('general.index') }}'" aria-label="Keluar"
                            class="bg-[#FFB3B3] text-black w-full h-full rounded-2xl brutal-border brutal-shadow-sm brutal-hover flex items-center justify-center cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                class="w-1/2 h-1/2 text-black fill-none stroke-current" stroke-width="3.5"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                                <polyline points="9 22 9 12 15 12 15 22" />
                            </svg>
                        </button>
                        <div
                            class="pointer-events-none absolute bottom-full left-1/2 -translate-x-1/2 mb-3 bg-[#FFD1E3] brutal-border brutal-shadow-sm px-3 py-1.5 rounded-lg text-sm font-bold opacity-0 scale-95 group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-150 whitespace-nowrap z-50 text-black">
                            Keluar
                        </div>
                    </div>
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

            const board = document.getElementById('board-container');
            const movesEl = document.getElementById('moves-count');
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

                // Set Instrument name for victory modal if element exists
                const winInstrumentNameEl = document.getElementById('win-instrument-name');
                if (winInstrumentNameEl) {
                    winInstrumentNameEl.innerText = inst.name;
                }

                // Create Tiles
                tiles = [];
                for (let r = 0; r < gridSize; r++) {
                    for (let c = 0; c < gridSize; c++) {
                        const tile = document.createElement('div');
                        // group/tile untuk trigger hover, relative + overflow-hidden dicabut agar stiker bisa meletup cantik
                        tile.className = 'tile group/tile relative';

                        // Mengubah inner tile menjadi flexbox agar stiker terkunci tepat di tengah-tengah kepingan gambar
                        const inner = document.createElement('div');
                        inner.className =
                            'tile-inner brutal-border rounded-xl bg-white flex items-center justify-center relative overflow-hidden';
                        inner.style.backgroundImage = `url('${currentImage}')`;

                        const bgPosX = (c / (gridSize - 1)) * 100;
                        const bgPosY = (r / (gridSize - 1)) * 100;
                        inner.style.backgroundPosition = `${bgPosX}% ${bgPosY}%`;
                        inner.innerText = (r * gridSize + c + 1);

                        // ── REVISI: STIKER SEPERTI GAME MEMORI (MELETUP & MEMUTAR) ──
                        const tileSticker = document.createElement('div');
                        // Meniru persis efek memori: dari -rotate-6 dan scale-75 meluncur membesar ke rotate-3 saat di-hover
                        tileSticker.className =
                            'pointer-events-none bg-[#FFD1E3] brutal-border brutal-shadow-sm px-3 py-1.5 rounded-full text-xs md:text-sm font-black text-black opacity-0 scale-75 -rotate-6 group-hover/tile:opacity-100 group-hover/tile:scale-100 group-hover/tile:rotate-3 transition-all duration-200 z-20 uppercase tracking-wider select-none text-center';
                        tileSticker.innerHTML = 'Klik Aku!';
                        inner.appendChild(tileSticker);

                        tile.appendChild(inner);

                        const tileData = {
                            el: tile,
                            inner: inner,
                            correctR: r,
                            correctC: c,
                            currentR: r,
                            currentC: c
                        };

                        updateTilePos(tileData);

                        tile.addEventListener('click', () => {
                            // Hilangkan stiker instan saat kepingan diklik agar tidak mengganggu visual perpindahan tempat
                            tileSticker.style.display = 'none';
                            handleTileClick(tileData);
                        });

                        // Munculkan kembali stiker saat kursor keluar (mouseleave) agar siap di-hover lagi nanti
                        tile.addEventListener('mouseleave', () => {
                            tileSticker.style.display = 'block';
                        });

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
                const wrapperLanjut = btnLanjut ? btnLanjut.closest('.group\\/tooltip') : null;
                const wrapperUlangi = btnUlangi ? btnUlangi.closest('.group\\/tooltip') : null;

                // Cek apakah masih ada alat musik yang belum dimainkan
                if (playedInstrumentIds.length < instruments.length) {
                    if (btnLanjut) btnLanjut.classList.remove('hidden');
                    if (wrapperLanjut) wrapperLanjut.classList.remove('hidden');
                    if (btnUlangi) btnUlangi.classList.add('hidden');
                    if (wrapperUlangi) wrapperUlangi.classList.add('hidden');
                } else {
                    // Sudah 4 gambar dimainkan semua
                    if (btnLanjut) btnLanjut.classList.add('hidden');
                    if (wrapperLanjut) wrapperLanjut.classList.add('hidden');
                    if (btnUlangi) btnUlangi.classList.remove('hidden');
                    if (wrapperUlangi) wrapperUlangi.classList.remove('hidden');
                }

                modal.classList.remove('hidden');
                modal.classList.add('flex');

                setTimeout(() => {
                    content.classList.remove('scale-90', 'opacity-0');
                    content.classList.add('scale-100', 'opacity-100');
                }, 50);
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
                        }, 500);
                    }
                }, 1000);
            });
        </script>
    </div>
</body>

</html>
