<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <title>HonuSign - Memori Visual SIBI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;600;700;900&display=swap" rel="stylesheet">
    <meta name="description"
        content="Game kartu memori bahasa isyarat SIBI HonuSign — cocokkan pasangan kartu isyarat tangan!">
    <style>
        .memory-game-container {
            font-family: 'Fredoka', sans-serif;
            min-height: 100vh;
            width: 100vw;
            background-color: #FFFEFA;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
        }

        .memory-game-container * {
            font-family: 'Fredoka', sans-serif;
        }

        body {
            background-color: #FFFEFA;
            overflow-x: hidden;
            overflow-y: auto;
            margin: 0;
            padding: 0;
        }

        .memory-game-container .brutal-border {
            border: 4px solid #000;
        }

        .memory-game-container .brutal-shadow {
            box-shadow: 6px 6px 0 #000;
        }

        .memory-game-container .brutal-shadow-sm {
            box-shadow: 3px 3px 0 #000;
        }

        .memory-game-container .brutal-hover {
            transition: all 0.15s ease-in-out;
        }

        .memory-game-container .brutal-hover:hover {
            transform: translate(-2px, -2px);
            box-shadow: 5px 5px 0 #000;
        }

        .memory-game-container .brutal-hover:active {
            transform: translate(1px, 1px);
            box-shadow: 2px 2px 0 #000;
        }

        /* Card Mechanics */
        .card {
            perspective: 1000px;
            cursor: pointer;
            width: 100%;
            aspect-ratio: 3 / 4;
        }

        .card-inner {
            position: relative;
            width: 100%;
            height: 100%;
            text-align: center;
            transition: transform 0.6s cubic-bezier(0.4, 0.2, 0.2, 1);
            transform-style: preserve-3d;
        }

        .card.flipped .card-inner {
            transform: rotateY(180deg);
        }

        .card-front,
        .card-back {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            border-radius: 1.875rem;
            border: 4px solid #000;
        }

        /* Sisi Belakang (Closed) - Secara teknis Front di CSS */
        .card-front {
            background-color: #BEE9E8;
            /* Pastel Biru Muda */
            background-image: radial-gradient(#FFF5B8 15%, transparent 16%), radial-gradient(#FFF5B8 15%, transparent 16%);
            background-size: 20px 20px;
            background-position: 0 0, 10px 10px;
            box-shadow: 6px 6px 0px 0px #000000;
            transition: border-color 0.3s;
        }

        /* Sisi Depan (Open) - Secara teknis Back di CSS */
        .card-back {
            background-color: #FFFEFA;
            transform: rotateY(180deg);
            box-shadow: 2px 2px 0px 0px #000000;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10%;
        }

        .card-back img {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
            filter: drop-shadow(2px 2px 0px #000);
        }

        /* Jiggle untuk kartu terpilih */
        @keyframes jiggle {
            0% {
                transform: rotate(-2deg) scale(1.05);
            }

            50% {
                transform: rotate(2deg) scale(1.05);
            }

            100% {
                transform: rotate(-2deg) scale(1.05);
            }
        }

        .card.selected .card-back {
            border-color: #FFD1E3;
            /* Pink Pastel Glow border */
            box-shadow: 0 0 15px #FFD1E3, 2px 2px 0px 0px #000000;
        }

        .card.selected {
            animation: jiggle 0.5s infinite;
        }

        /* Hint (Kartu Pasangan Bergetar) */
        @keyframes hint-shake {

            0%,
            100% {
                transform: rotate(0);
                box-shadow: none;
            }

            20% {
                transform: rotate(-5deg);
                box-shadow: 0 0 20px #FFF5B8;
            }

            40% {
                transform: rotate(5deg);
                box-shadow: 0 0 20px #FFF5B8;
            }

            60% {
                transform: rotate(-5deg);
                box-shadow: 0 0 20px #FFF5B8;
            }

            80% {
                transform: rotate(5deg);
                box-shadow: 0 0 20px #FFF5B8;
            }
        }

        .card.hint {
            animation: hint-shake 1.5s ease-in-out infinite;
        }

        /* Match Glow */
        @keyframes match-glow {
            0% {
                box-shadow: 0 0 0 0 #D4F1BE, 2px 2px 0px 0px #000000;
            }

            50% {
                box-shadow: 0 0 40px 10px #D4F1BE, 2px 2px 0px 0px #000000;
                transform: scale(1.1);
            }

            100% {
                box-shadow: 0 0 0 0 #D4F1BE, 2px 2px 0px 0px #000000;
                transform: scale(1);
            }
        }

        .card.matched {
            pointer-events: none;
            animation: matched-disappear 0.8s ease-out forwards;
        }

        .card.matched .card-back {
            border-color: #D4F1BE;
            background-color: #F0FDF4;
        }

        @keyframes matched-disappear {
            0% {
                opacity: 1;
                transform: scale(1);
            }

            40% {
                opacity: 1;
                transform: scale(1.08);
            }

            100% {
                opacity: 0;
                transform: scale(0);
            }
        }

        /* Mismatch Shake */
        @keyframes mismatch-shake {
            0% {
                transform: translateX(0);
            }

            20% {
                transform: translateX(-12px) rotate(-3deg);
            }

            40% {
                transform: translateX(12px) rotate(3deg);
            }

            60% {
                transform: translateX(-8px) rotate(-2deg);
            }

            80% {
                transform: translateX(8px) rotate(2deg);
            }

            100% {
                transform: translateX(0);
            }
        }

        .card.mismatched .card-back {
            border-color: #FF6B6B;
            background-color: #FEF2F2;
            box-shadow: 0 0 20px #FF6B6B, 2px 2px 0px 0px #000000;
        }

        .card.mismatched {
            animation: mismatch-shake 0.6s ease-in-out;
        }

        /* Bintang terbang */
        .victory-star {
            position: fixed;
            width: 32px;
            height: 32px;
            background: #facc15;
            border: 2px solid #000;
            clip-path: polygon(50% 0%, 61% 35%, 98% 35%, 68% 57%, 79% 91%, 50% 70%, 21% 91%, 32% 57%, 2% 35%, 39% 35%);
            animation: fly-up 1.5s ease-out forwards;
            z-index: 9999;
            pointer-events: none;
        }

        @keyframes fly-up {
            0% {
                transform: translateY(0) scale(0) rotate(0deg);
                opacity: 1;
            }

            50% {
                transform: translateY(-80px) scale(1.5) rotate(180deg);
                opacity: 1;
            }

            100% {
                transform: translateY(-200px) scale(0.5) rotate(360deg);
                opacity: 0;
            }
        }

        /* Full screen victory glow */
        body.victory-glow {
            box-shadow: inset 0 0 80px 20px #D4F1BE;
            transition: box-shadow 1s ease-in-out;
        }

        /* Tampilan Teks untuk Mode Sulit */
        .letter-text {
            font-size: clamp(2rem, 8vh, 4.5rem);
            font-weight: 900;
            color: #000;
            text-shadow: 3px 3px 0px #FFF5B8;
            line-height: 1;
        }

        /* Custom bounce untuk hint scroll */
        @keyframes scroll-bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .scroll-bounce {
            animation: scroll-bounce 1.5s infinite ease-in-out;
        }
    </style>
</head>

<body>
    <div class="memory-game-container">

        <!-- Intro Overlay -->
        <div id="intro-overlay"
            class="fixed inset-0 z-[9999] bg-[#FFFEFA] flex flex-col items-center justify-center transition-opacity duration-1000 ease-in-out">
            <div class="text-center px-6">
                <div
                    class="inline-block px-6 py-2 bg-[#FFD1E3] brutal-border brutal-shadow-sm rounded-2xl text-sm font-bold mb-6 -rotate-2">
                    Memory Game
                </div>
                <h1
                    class="text-6xl md:text-8xl font-black text-black transform -rotate-2 animate-bounce text-center drop-shadow-[0_10px_0_rgba(0,0,0,0.15)]">
                    Memori Visual
                </h1>
                <p
                    class="mt-6 text-2xl font-bold text-slate-900 bg-[#FFF5B8] brutal-border brutal-shadow-sm px-6 py-2 rounded-2xl inline-block rotate-1">
                    Cocokkan Isyarat Tangan!</p>
            </div>
        </div>

        <!-- Header Navigation -->
        <div class="fixed top-0 left-0 right-0 p-4 md:p-6 flex justify-between items-start z-[110] pointer-events-none">
            <!-- Back Button with Tooltip -->
            <div class="relative group/tooltip pointer-events-auto">
                <a href="{{ route('general.index') }}" aria-label="Kembali"
                    class="bg-[#FFB3B3] text-black p-3.5 rounded-2xl font-bold brutal-border brutal-shadow-sm brutal-hover flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-7 h-7 text-black"
                        fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M19 12H5M12 19l-7-7 7-7" />
                    </svg>
                </a>
                <!-- Tooltip -->
                <div
                    class="pointer-events-none absolute left-0 top-full mt-3 bg-[#FFD1E3] brutal-border brutal-shadow-sm px-3 py-1.5 rounded-lg text-sm font-bold opacity-0 scale-95 group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-150 whitespace-nowrap z-50 text-black">
                    Kembali
                </div>
            </div>

            <!-- Difficulty Toggles (1 Star vs 3 Stars) -->
            <div class="flex gap-3 pointer-events-auto">
                <!-- Easy Button with Tooltip -->
                <div class="relative group/tooltip">
                    <button onclick="setMode('easy')" id="btn-easy" aria-label="Mode Mudah"
                        class="brutal-border brutal-shadow-sm p-2.5 rounded-2xl transition-all bg-[#FFF5B8] brutal-hover flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-8 h-8 text-black"
                            fill="#facc15" stroke="currentColor" stroke-width="2.5" stroke-linejoin="round">
                            <polygon
                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                        </svg>
                    </button>
                    <!-- Tooltip -->
                    <div
                        class="pointer-events-none absolute right-0 top-full mt-3 bg-[#FFD1E3] brutal-border brutal-shadow-sm px-3 py-1.5 rounded-lg text-sm font-bold opacity-0 scale-95 group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-150 whitespace-nowrap z-50 text-black">
                        Mode Mudah
                    </div>
                </div>

                <!-- Hard Button with Tooltip -->
                <div class="relative group/tooltip">
                    <button onclick="setMode('hard')" id="btn-hard" aria-label="Mode Sulit"
                        class="w-14 h-14 brutal-border brutal-shadow-sm p-1.5 rounded-2xl transition-all bg-[#E2E8F0] brutal-hover flex flex-col items-center justify-center gap-0.5">

                        <div class="flex gap-0.5 justify-center w-full">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-4 h-4 text-black"
                                fill="#facc15" stroke="currentColor" stroke-width="2.5" stroke-linejoin="round">
                                <polygon
                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-4 h-4 text-black"
                                fill="#facc15" stroke="currentColor" stroke-width="2.5" stroke-linejoin="round">
                                <polygon
                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                            </svg>
                        </div>
                        <div class="flex justify-center w-full">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-4 h-4 text-black"
                                fill="#facc15" stroke="currentColor" stroke-width="2.5" stroke-linejoin="round">
                                <polygon
                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                            </svg>
                        </div>

                    </button>
                    <div
                        class="pointer-events-none absolute right-0 top-full mt-3 bg-[#FFD1E3] brutal-border brutal-shadow-sm px-3 py-1.5 rounded-lg text-sm font-bold opacity-0 scale-95 group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-150 whitespace-nowrap z-50 text-black">
                        Mode Sulit
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Board -->
        <div class="flex flex-col items-center justify-center w-full max-w-5xl px-4 md:px-8 mt-24 md:mt-28">

            <!-- Mode Banner & Instruction Box -->
            <div class="mb-6 w-full max-w-2xl flex flex-col items-center gap-4">
                <h2 id="mode-title"
                    class="text-2xl md:text-3xl font-black text-black bg-[#D4F1BE] brutal-border brutal-shadow-sm px-6 py-2 rounded-3xl transform -rotate-1 text-center">
                    Cari Pasangan Gambar!
                </h2>

                <p id="mode-desc"
                    class="text-lg md:text-xl font-bold text-slate-900 bg-[#FFF5B8] brutal-border px-5 py-2.5 rounded-2xl shadow-sm transform rotate-1 text-center max-w-lg">
                    Ingat gambarnya dan <b>cari isyarat tangan</b> yang persis sama!
                </p>
            </div>

            <!-- Kartu 4 Kolom x 4 Baris = 16 Kartu -->
            <div id="board-container"
                style="display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); width: min(95vw, 1000px); height: auto; gap: 16px; margin: 0 auto; padding-bottom: 50px;">
                <!-- JS generates cards here -->
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
                    Cara Mencocokkan Kartu!
                </h2>

                <!-- Animasi Simulasi Balik Kartu -->
                <div
                    class="relative w-64 h-36 bg-[#E2E8F0] brutal-border rounded-3xl p-4 grid grid-cols-3 gap-3 mb-8 mx-auto overflow-hidden shadow-inner">
                    <!-- Kartu 1 (A) -->
                    <div id="sim-card-1"
                        class="brutal-border rounded-xl flex items-center justify-center font-black text-2xl transition-all duration-500 shadow-sm bg-[#FFB3B3] text-transparent select-none border-black">
                        A
                    </div>
                    <!-- Kartu 2 (B - Salah) -->
                    <div id="sim-card-2"
                        class="brutal-border rounded-xl flex items-center justify-center font-black text-2xl transition-all duration-500 shadow-sm bg-[#FFB3B3] text-transparent select-none border-black">
                        B
                    </div>
                    <!-- Kartu 3 (A - Benar) -->
                    <div id="sim-card-3"
                        class="brutal-border rounded-xl flex items-center justify-center font-black text-2xl transition-all duration-500 shadow-sm bg-[#FFB3B3] text-transparent select-none border-black">
                        A
                    </div>

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
                            class="bg-[#FFB3B3] w-8 h-8 rounded-xl brutal-border flex items-center justify-center font-black text-sm shrink-0 mt-0.5">❌</span>
                        <p class="font-bold text-slate-900 text-base md:text-lg">Jika gambar <b>berbeda (salah)</b>,
                            kartu
                            akan berwarna merah dan menutup kembali.</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <span
                            class="bg-[#D4F1BE] w-8 h-8 rounded-xl brutal-border flex items-center justify-center font-black text-sm shrink-0 mt-0.5">✔️</span>
                        <p class="font-bold text-slate-900 text-base md:text-lg">Jika gambar <b>sama (benar)</b>, kartu
                            akan
                            berwarna hijau dan menghilang!</p>
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
                    <!-- Replay Button -->
                    <div class="relative group/tooltip w-[18%] aspect-square">
                        <button onclick="initGame()" aria-label="Main Lagi"
                            class="bg-[#FFF5B8] text-black w-full h-full rounded-2xl brutal-border brutal-shadow-sm brutal-hover flex items-center justify-center cursor-pointer">
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
                    <!-- Home Button -->
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

        <!-- Floating Scroll Hint for Kids -->
        <div id="scroll-hint"
            class="fixed bottom-6 left-1/2 transform -translate-x-1/2 z-[100] pointer-events-none transition-all duration-500 opacity-0 scale-90">
            <div
                class="bg-[#FFF5B8] brutal-border brutal-shadow-sm p-3.5 rounded-full border-black scroll-bounce flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                    class="w-8 h-8 text-black fill-none stroke-current" stroke-width="3" stroke-linecap="round"
                    stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <polyline points="19 12 12 19 5 12"></polyline>
                </svg>
            </div>
        </div>

        <script>
            const allLetters = 'abcdefghijklmnopqrstuvwxyz'.split('');
            let currentMode = 'easy'; // 'easy' or 'hard'
            let cardsData = [];
            let flippedCards = [];
            let lockBoard = false;
            let hintTimer = null;

            const board = document.getElementById('board-container');
            const btnEasy = document.getElementById('btn-easy');
            const btnHard = document.getElementById('btn-hard');
            const modeTitle = document.getElementById('mode-title');
            const modeDesc = document.getElementById('mode-desc');

            function setMode(mode) {
                currentMode = mode;
                if (mode === 'easy') {
                    btnEasy.classList.remove('bg-[#E2E8F0]');
                    btnEasy.classList.add('bg-[#FFF5B8]');
                    btnHard.classList.remove('bg-[#FFF5B8]');
                    btnHard.classList.add('bg-[#E2E8F0]');
                    modeTitle.innerText = "Cari Pasangan Gambar!";
                    modeDesc.innerHTML = "Ingat gambarnya dan <b>cari isyarat tangan</b> yang persis sama!";
                } else {
                    btnHard.classList.remove('bg-[#E2E8F0]');
                    btnHard.classList.add('bg-[#FFF5B8]');
                    btnEasy.classList.remove('bg-[#FFF5B8]');
                    btnEasy.classList.add('bg-[#E2E8F0]');
                    modeTitle.innerText = "Pasangkan Gambar & Huruf!";
                    modeDesc.innerHTML = "Ingat gambarnya dan cocokkan dengan <b>Huruf Abjadnya</b>!";
                }
                initGame();
            }

            function getRandomLetters(count) {
                const shuffled = [...allLetters].sort(() => 0.5 - Math.random());
                return shuffled.slice(0, count);
            }

            function initGame() {
                // Reset state
                flippedCards = [];
                lockBoard = false;
                clearTimeout(hintTimer);
                if (typeof scrollHintTimeout !== 'undefined') {
                    clearTimeout(scrollHintTimeout);
                }
                const scrollHintEl = document.getElementById('scroll-hint');
                if (scrollHintEl) {
                    scrollHintEl.classList.remove('opacity-100', 'scale-100');
                    scrollHintEl.classList.add('opacity-0', 'scale-90');
                }
                board.innerHTML = '';
                document.body.classList.remove('victory-glow');

                const winModal = document.getElementById('win-modal');
                winModal.classList.add('hidden');
                winModal.classList.remove('flex');

                // Generate Data: Mudah = 5 Pasang (10 Kartu), Sulit = 10 Pasang (20 Kartu)
                cardsData = [];
                const numPairs = currentMode === 'easy' ? 5 : 10;
                const selectedLetters = getRandomLetters(numPairs);

                // Set grid columns: 5 kolom untuk semua mode
                board.style.gridTemplateColumns = 'repeat(5, minmax(0, 1fr))';

                selectedLetters.forEach(letter => {
                    // Card 1: Gambar Isyarat
                    cardsData.push({
                        id: letter + '-img',
                        matchId: letter,
                        type: 'image',
                        content: `{{ asset('images/general/sibi tangan') }}/${letter}.png`
                    });

                    // Card 2: Pasangan
                    if (currentMode === 'easy') {
                        // Gambar Isyarat yang sama
                        cardsData.push({
                            id: letter + '-img2',
                            matchId: letter,
                            type: 'image',
                            content: `{{ asset('images/general/sibi tangan') }}/${letter}.png`
                        });
                    } else {
                        // Huruf Teks
                        cardsData.push({
                            id: letter + '-txt',
                            matchId: letter,
                            type: 'text',
                            content: letter.toUpperCase()
                        });
                    }
                });

                // Shuffle
                cardsData.sort(() => 0.5 - Math.random());

                // Render
                cardsData.forEach(data => {
                    const card = document.createElement('div');
                    // group/card untuk trigger hover, relative untuk mengunci posisi stiker di dalam kartu
                    card.className = 'card w-full relative group/card';
                    card.style.aspectRatio = '3/4';
                    card.dataset.matchId = data.matchId;

                    const inner = document.createElement('div');
                    inner.className = 'card-inner';

                    // Front (Punggung Kartu)
                    const front = document.createElement('div');
                    // flex dan items-center agar stiker otomatis berada tepat di tengah-tengah kartu
                    front.className = 'card-front flex items-center justify-center relative overflow-hidden';

                    // ── TAMBAHAN: ELEMEN STIKER DI DALAM PUNGGUNG KARTU ──
                    const cardSticker = document.createElement('div');
                    // Desain stiker bulat, warna pink brutalist, berputar -4 derajat, muncul hanya saat di-hover
                    cardSticker.className =
                        'pointer-events-none bg-[#FFD1E3] border-3 border-black shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] px-3 py-2 rounded-full text-xs md:text-sm font-black text-black opacity-0 scale-75 -rotate-6 group-hover/card:opacity-100 group-hover/card:scale-100 group-hover/card:rotate-3 transition-all duration-200 z-20 uppercase tracking-wider select-none text-center';
                    cardSticker.innerHTML = 'Buka aku!';
                    front.appendChild(cardSticker);

                    // Back (Muka Kartu)
                    const back = document.createElement('div');
                    back.className = 'card-back brutal-border';
                    if (data.type === 'image') {
                        back.innerHTML =
                            `<img src="${data.content}" alt="Isyarat ${data.matchId}" onerror="this.onerror=null; this.outerHTML='<span class=\\'letter-text\\'>${data.matchId.toUpperCase()}</span>';" />`;
                    } else {
                        back.innerHTML = `<span class="letter-text">${data.content}</span>`;
                    }

                    inner.appendChild(front);
                    inner.appendChild(back);
                    card.appendChild(inner);

                    card.addEventListener('click', () => {
                        handleCardClick(card);
                    });

                    board.appendChild(card);
                });

                // Cek scroll hint setelah render selesai (langsung tampil jika ada overflow)
                setTimeout(() => checkScrollHint(true), 150);
            }

            function handleCardClick(card) {
                if (lockBoard) return;
                if (card.classList.contains('flipped')) return;

                card.classList.add('flipped');

                if (flippedCards.length === 0) {
                    // Pilihan pertama
                    flippedCards.push(card);
                    card.classList.add('selected');

                    // Mulai timer hint (jika anak diam lama, misal 4 detik)
                    clearTimeout(hintTimer);
                    hintTimer = setTimeout(() => {
                        const matchId = card.dataset.matchId;
                        const allCards = document.querySelectorAll('.card');
                        allCards.forEach(c => {
                            if (c !== card && c.dataset.matchId === matchId && !c.classList.contains(
                                    'matched')) {
                                c.classList.add('hint');
                            }
                        });
                    }, 4000);

                } else {
                    // Pilihan kedua
                    clearTimeout(hintTimer);
                    // Hilangkan class hint dari semua kartu jika ada
                    document.querySelectorAll('.card.hint').forEach(c => c.classList.remove('hint'));

                    flippedCards.push(card);
                    flippedCards[0].classList.remove('selected');

                    // Kunci board saat mengecek
                    lockBoard = true;

                    // Biarkan animasi flip selesai sepenuhnya (600ms) sebelum mengecek match
                    setTimeout(() => {
                        checkForMatch();
                    }, 600);
                }
            }

            function checkForMatch() {
                let isMatch = flippedCards[0].dataset.matchId === flippedCards[1].dataset.matchId;

                if (isMatch) {
                    handleMatch();
                } else {
                    handleMismatch();
                }
            }

            function handleMatch() {
                flippedCards[0].classList.add('matched');
                flippedCards[1].classList.add('matched');

                spawnStar(flippedCards[0]);
                spawnStar(flippedCards[1]);

                const card1 = flippedCards[0];
                const card2 = flippedCards[1];

                flippedCards = [];
                lockBoard = false;

                // Sembunyikan kartu setelah animasi matched-disappear (800ms) selesai
                // agar sisa kartu di grid bergeser mengisi tempat kosong dengan animasi FLIP
                setTimeout(() => {
                    // Ambil semua kartu yang belum dicocokkan (yang masih aktif di layar)
                    const remainingCards = Array.from(document.querySelectorAll('.card')).filter(card => {
                        return card !== card1 && card !== card2 && card.style.display !== 'none';
                    });

                    // 1. FIRST: Catat posisi awal semua kartu lain sebelum card1 & card2 disembunyikan
                    const firstRects = new Map();
                    remainingCards.forEach(card => {
                        firstRects.set(card, card.getBoundingClientRect());
                    });

                    // Sembunyikan kartu yang cocok
                    card1.style.display = 'none';
                    card2.style.display = 'none';

                    // 2. LAST & INVERT: Catat posisi baru dan langsung tarik kembali secara instan
                    remainingCards.forEach(card => {
                        const firstRect = firstRects.get(card);
                        const lastRect = card.getBoundingClientRect();

                        const deltaX = firstRect.left - lastRect.left;
                        const deltaY = firstRect.top - lastRect.top;

                        if (deltaX !== 0 || deltaY !== 0) {
                            card.style.transition = 'none';
                            card.style.transform = `translate(${deltaX}px, ${deltaY}px)`;
                        }
                    });

                    // 3. PLAY: Luncurkan animasi bergeser secara halus ke posisi baru (menggunakan elastic/bouncy cubic-bezier)
                    setTimeout(() => {
                        remainingCards.forEach(card => {
                            card.style.transition = 'transform 0.6s cubic-bezier(0.34, 1.56, 0.64, 1)';
                            card.style.transform = 'translate(0, 0)';
                        });
                    }, 20);

                    // Hapus inline style transition & transform setelah animasi selesai (700ms)
                    setTimeout(() => {
                        remainingCards.forEach(card => {
                            card.style.transition = '';
                            card.style.transform = '';
                        });
                    }, 700);

                    checkScrollHint(true);
                }, 800);

                // Cek Menang
                if (document.querySelectorAll('.card.matched').length === cardsData.length) {
                    setTimeout(triggerVictory, 800);
                }
            }

            function handleMismatch() {
                flippedCards[0].classList.add('mismatched');
                flippedCards[1].classList.add('mismatched');

                // Beri waktu 2.5 detik agar anak bisa mengingat posisi kartu sebelum tertutup kembali
                setTimeout(() => {
                    flippedCards[0].classList.remove('flipped', 'mismatched');
                    flippedCards[1].classList.remove('flipped', 'mismatched');
                    flippedCards = [];
                    lockBoard = false;
                }, 2500);
            }

            function spawnStar(cardEl) {
                const rect = cardEl.getBoundingClientRect();
                const star = document.createElement('div');
                star.className = 'victory-star';
                // Posisikan di atas tengah kartu
                star.style.left = `${rect.left + rect.width / 2 - 16}px`;
                star.style.top = `${rect.top - 16}px`;
                document.body.appendChild(star);
                setTimeout(() => star.remove(), 1500);
            }

            function triggerVictory() {
                document.body.classList.add('victory-glow');

                // Banyak bintang beterbangan
                for (let i = 0; i < 15; i++) {
                    setTimeout(() => {
                        const star = document.createElement('div');
                        star.className = 'victory-star';
                        star.style.left = `${Math.random() * 90}%`;
                        star.style.top = `${Math.random() * 80 + 10}%`;
                        document.body.appendChild(star);
                        setTimeout(() => star.remove(), 1500);
                    }, i * 100);
                }

                setTimeout(() => {
                    const modal = document.getElementById('win-modal');
                    const content = document.getElementById('win-modal-content');
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');

                    setTimeout(() => {
                        content.classList.remove('scale-90', 'opacity-0');
                        content.classList.add('scale-100', 'opacity-100');
                    }, 50);
                }, 1000);
            }

            let tutorialAnimTimer = null;

            function runTutorialAnimation() {
                const card1 = document.getElementById('sim-card-1');
                const card2 = document.getElementById('sim-card-2');
                const card3 = document.getElementById('sim-card-3');
                const cursor = document.getElementById('sim-cursor');
                if (!card1 || !card2 || !card3 || !cursor) return;

                // Reset semua kartu ke posisi tertutup (Punggung Kartu Pink)
                const closedClass =
                    'brutal-border rounded-xl flex items-center justify-center font-black text-2xl transition-all duration-500 shadow-sm bg-[#FFB3B3] text-transparent select-none border-black';
                card1.className = closedClass;
                card2.className = closedClass;
                card3.className = closedClass;
                cursor.style.top = '70%';
                cursor.style.left = '70%';

                // === FASE 1: CONTOH SALAH (A & B) ===
                // 1. Cursor meluncur ke Kartu 1 (A)
                setTimeout(() => {
                    cursor.style.top = '35%';
                    cursor.style.left = '12%';
                }, 600);

                // 2. Klik Kartu 1 (Terbuka jadi Kuning)
                setTimeout(() => {
                    cursor.style.transform = 'scale(0.8)';
                    card1.className =
                        'brutal-border rounded-xl flex items-center justify-center font-black text-2xl transition-all duration-500 shadow-sm bg-[#FFF5B8] text-black select-none ring-4 ring-sky-400';
                }, 1300);

                // 3. Cursor meluncur ke Kartu 2 (B)
                setTimeout(() => {
                    cursor.style.transform = 'scale(1)';
                    cursor.style.top = '35%';
                    cursor.style.left = '45%';
                }, 1900);

                // 4. Klik Kartu 2 (Terbuka jadi Kuning)
                setTimeout(() => {
                    cursor.style.transform = 'scale(0.8)';
                    card2.className =
                        'brutal-border rounded-xl flex items-center justify-center font-black text-2xl transition-all duration-500 shadow-sm bg-[#FFF5B8] text-black select-none ring-4 ring-sky-400';
                }, 2600);

                // 5. SALAH! Kedua kartu menjadi Merah & Bergetar
                setTimeout(() => {
                    cursor.style.transform = 'scale(1)';
                    const wrongClass =
                        'brutal-border rounded-xl flex items-center justify-center font-black text-2xl transition-all duration-300 shadow-sm bg-red-400 text-white select-none border-red-700 animate-pulse';
                    card1.className = wrongClass;
                    card2.className = wrongClass;
                }, 3300);

                // 6. Tutup kembali Kartu 1 & Kartu 2
                setTimeout(() => {
                    card1.className = closedClass;
                    card2.className = closedClass;
                }, 4300);

                // === FASE 2: CONTOH BENAR (A & A) ===
                // 7. Cursor meluncur ke Kartu 1 (A) lagi
                setTimeout(() => {
                    cursor.style.top = '35%';
                    cursor.style.left = '12%';
                }, 4900);

                // 8. Klik Kartu 1 (Terbuka jadi Kuning)
                setTimeout(() => {
                    cursor.style.transform = 'scale(0.8)';
                    card1.className =
                        'brutal-border rounded-xl flex items-center justify-center font-black text-2xl transition-all duration-500 shadow-sm bg-[#FFF5B8] text-black select-none ring-4 ring-sky-400';
                }, 5600);

                // 9. Cursor meluncur ke Kartu 3 (A)
                setTimeout(() => {
                    cursor.style.transform = 'scale(1)';
                    cursor.style.top = '35%';
                    cursor.style.left = '78%';
                }, 6200);

                // 10. Klik Kartu 3 (Terbuka jadi Kuning)
                setTimeout(() => {
                    cursor.style.transform = 'scale(0.8)';
                    card3.className =
                        'brutal-border rounded-xl flex items-center justify-center font-black text-2xl transition-all duration-500 shadow-sm bg-[#FFF5B8] text-black select-none ring-4 ring-sky-400';
                }, 6900);

                // 11. BENAR! Kedua kartu menjadi Hijau Kemenangan
                setTimeout(() => {
                    cursor.style.transform = 'scale(1)';
                    const rightClass =
                        'brutal-border rounded-xl flex items-center justify-center font-black text-2xl transition-all duration-500 shadow-sm bg-[#D4F1BE] text-black select-none border-green-600 animate-bounce';
                    card1.className = rightClass;
                    card3.className = rightClass;
                }, 7600);
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
                tutorialAnimTimer = setInterval(runTutorialAnimation, 9000);
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
                checkScrollHint(true);
            }

            let scrollHintTimeout = null;
            const scrollHint = document.getElementById('scroll-hint');

            function checkScrollHint(immediate = false) {
                if (!scrollHint) return;

                // Cek apakah masih ada konten di bawah viewport saat ini
                const hasMoreBelow = document.documentElement.scrollHeight > window.innerHeight + window.scrollY + 50;

                if (hasMoreBelow) {
                    if (immediate) {
                        // Muncul langsung tanpa delay
                        clearTimeout(scrollHintTimeout);
                        scrollHint.classList.remove('opacity-0', 'scale-90');
                        scrollHint.classList.add('opacity-100', 'scale-100');
                    } else {
                        // Sembunyikan langsung saat sedang bergerak
                        scrollHint.classList.remove('opacity-100', 'scale-100');
                        scrollHint.classList.add('opacity-0', 'scale-90');

                        // Tampilkan kembali setelah 2.5 detik diam
                        clearTimeout(scrollHintTimeout);
                        scrollHintTimeout = setTimeout(() => {
                            const stillHasMore = document.documentElement.scrollHeight > window.innerHeight + window
                                .scrollY + 50;
                            if (stillHasMore) {
                                scrollHint.classList.remove('opacity-0', 'scale-90');
                                scrollHint.classList.add('opacity-100', 'scale-100');
                            }
                        }, 2500);
                    }
                } else {
                    // Sembunyikan jika sudah di paling bawah / tidak ada scrollbar
                    clearTimeout(scrollHintTimeout);
                    scrollHint.classList.remove('opacity-100', 'scale-100');
                    scrollHint.classList.add('opacity-0', 'scale-90');
                }
            }

            // Sembunyikan instan begitu mendeteksi scroll baru, jadwalkan ulang cek
            window.addEventListener('scroll', () => {
                if (scrollHint) {
                    scrollHint.classList.remove('opacity-100', 'scale-100');
                    scrollHint.classList.add('opacity-0', 'scale-90');
                }
                checkScrollHint(false);
            });
            window.addEventListener('resize', () => checkScrollHint(true));

            // Initialize on load
            document.addEventListener('DOMContentLoaded', () => {
                initGame();

                // Hilangkan intro overlay
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
    </div>
</body>

</html>
