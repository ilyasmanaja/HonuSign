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
        * {
            font-family: 'Fredoka', sans-serif;
        }

        body {
            background-color: #FFFEFA !important;
            overflow-x: hidden;
        }

        .brutal-border {
            border: 4px solid #000 !important;
        }

        .brutal-shadow {
            box-shadow: 6px 6px 0 #000 !important;
        }

        .brutal-shadow-sm {
            box-shadow: 3px 3px 0 #000 !important;
        }

        .brutal-hover {
            transition: all 0.2s ease-in-out !important;
        }

        .brutal-hover:hover {
            transform: translate(-3px, -3px) !important;
            box-shadow: 9px 9px 0 #000 !important;
        }

        .brutal-hover:active {
            transform: translate(2px, 2px) !important;
            box-shadow: 2px 2px 0 #000 !important;
        }

        .text-outline {
            text-shadow: -2px -2px 0 #000, 2px -2px 0 #000,
                -2px 2px 0 #000, 2px 2px 0 #000,
                3px 3px 0 #000;
        }

        /* Card Mechanics */
        .card {
            perspective: 1000px;
            cursor: pointer;
            aspect-ratio: 3 / 4;
            width: 100%;
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
            border-radius: 1.5rem;
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

        .card.matched .card-back {
            animation: match-glow 0.8s ease-out forwards;
            border-color: #D4F1BE;
            background-color: #F0FDF4;
            /* Hijau super tipis */
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

        /* Tampilan Teks untuk Mode Sedang */
        .letter-text {
            font-size: 6rem;
            font-weight: 900;
            color: #000;
            text-shadow: 4px 4px 0px #FFF5B8;
        }

        @media (max-width: 640px) {
            .letter-text {
                font-size: 4rem;
            }
        }
    </style>
</head>

<body>

    <!-- Intro Overlay -->
    <div id="intro-overlay"
        class="fixed inset-0 z-[9999] bg-[#FFFEFA] flex flex-col items-center justify-center transition-opacity duration-1000 ease-in-out">
        <div class="text-center px-6">
            <div
                class="inline-block px-6 py-2 bg-[#FFD1E3] brutal-border brutal-shadow-sm rounded-2xl text-sm font-bold mb-6 -rotate-2">
                Memory Game
            </div>
            <h1
                class="text-6xl md:text-8xl font-black text-black text-outline transform -rotate-2 animate-bounce text-center drop-shadow-[0_10px_0_rgba(0,0,0,0.15)]">
                Memori Visual
            </h1>
            <p
                class="mt-6 text-2xl font-bold text-slate-500 bg-[#FFF5B8] brutal-border brutal-shadow-sm px-6 py-2 rounded-2xl inline-block rotate-1">
                Cocokkan Isyarat Tangan!</p>
        </div>
    </div>

    <!-- Header Navigation -->
    <div class="fixed top-0 left-0 right-0 p-4 md:p-6 flex justify-between items-start z-[110] pointer-events-none">
        <a href="{{ route('general.index') }}"
            class="bg-[#FFB3B3] text-black px-4 py-2 md:px-6 md:py-3 rounded-2xl font-black text-sm md:text-lg brutal-border brutal-shadow-sm brutal-hover flex items-center gap-2 pointer-events-auto">
            Kembali
        </a>

        <!-- Difficulty Toggles -->
        <div class="flex flex-col md:flex-row gap-3 pointer-events-auto">
            <button onclick="setMode('easy')" id="btn-easy"
                class="brutal-border brutal-shadow-sm px-5 py-2 rounded-2xl font-bold text-sm md:text-base transition-all bg-[#FFF5B8] brutal-hover">
                Mudah
            </button>
            <button onclick="setMode('medium')" id="btn-medium"
                class="brutal-border brutal-shadow-sm px-5 py-2 rounded-2xl font-bold text-sm md:text-base transition-all bg-[#BEE9E8] brutal-hover">
                Sedang
            </button>
        </div>
    </div>

    <!-- Main Board -->
    <div class="min-h-screen pt-32 pb-12 px-4 md:px-8 flex flex-col items-center justify-center max-w-5xl mx-auto">

        <!-- Mode Banner & Instruction Box -->
        <div class="mb-8 w-full max-w-2xl flex flex-col items-center gap-5">
            <h2 id="mode-title"
                class="text-3xl md:text-4xl font-black text-black bg-[#D4F1BE] brutal-border brutal-shadow-sm px-8 py-3 rounded-3xl transform -rotate-1 text-center">
                Cari Pasangan yang Sama!
            </h2>

            <p id="mode-desc"
                class="text-base md:text-lg font-bold text-slate-700 bg-[#FFF5B8] brutal-border px-6 py-3 rounded-2xl shadow-sm transform rotate-1 text-center max-w-xl">
                Ingat gambarnya dan <b>cari isyarat tangan</b> yang persis sama!
            </p>
        </div>

        <!-- Kartu 3 Baris x 4 Kolom = 12 Kartu -->
        <div id="board-container" class="w-full grid grid-cols-3 sm:grid-cols-4 gap-3 md:gap-5">
            <!-- JS generates cards here -->
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
                Cara Mencocokkan Kartu!
            </h2>

            <!-- Animasi Simulasi Balik Kartu -->
            <div
                class="relative w-64 h-36 bg-[#E2E8F0] brutal-border rounded-2xl p-4 grid grid-cols-3 gap-3 mb-8 mx-auto overflow-hidden shadow-inner">
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
            <div class="flex flex-col gap-4 text-left w-full bg-[#F8FAFC] brutal-border p-6 rounded-2xl mb-8 shadow-sm">
                <div class="flex items-start gap-3">
                    <span
                        class="bg-[#FFB3B3] w-8 h-8 rounded-xl brutal-border flex items-center justify-center font-black text-sm shrink-0 mt-0.5">❌</span>
                    <p class="font-bold text-slate-700 text-sm md:text-base">Jika gambar <b>berbeda (salah)</b>, kartu
                        akan berwarna merah dan menutup kembali.</p>
                </div>
                <div class="flex items-start gap-3">
                    <span
                        class="bg-[#D4F1BE] w-8 h-8 rounded-xl brutal-border flex items-center justify-center font-black text-sm shrink-0 mt-0.5">✔️</span>
                    <p class="font-bold text-slate-700 text-sm md:text-base">Jika gambar <b>sama (benar)</b>, kartu akan
                        berwarna hijau dan menghilang!</p>
                </div>
            </div>

            <button onclick="closeTutorial()"
                class="w-full md:w-auto bg-[#D4F1BE] text-black font-black text-lg md:text-xl px-10 py-4 rounded-3xl brutal-border brutal-shadow-sm brutal-hover">
                OKE, AKU MENGERTI!
            </button>
        </div>
    </div>

    <!-- Victory Modal -->
    <div id="win-modal"
        class="hidden fixed inset-0 z-[120] bg-black/60 backdrop-blur-sm flex-col items-center justify-center p-4">
        <div class="bg-[#FFFEFA] p-8 md:p-12 rounded-[3rem] brutal-border brutal-shadow flex flex-col items-center text-center transform scale-90 opacity-0 transition-all duration-500 relative"
            id="win-modal-content">

            <div class="mb-4 animate-bounce">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-20 h-20 shrink-0">
                    <path
                        d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"
                        fill="#FFD1E3" />
                    <path
                        d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"
                        fill="none" stroke="#000000" stroke-width="2.5" stroke-linejoin="round" />
                    <circle cx="9.5" cy="11.5" r="1.5" fill="#000000" />
                    <circle cx="14.5" cy="11.5" r="1.5" fill="#000000" />
                    <path d="M10 14.5s1 1 2 1 2-1 2-1" stroke="#000000" stroke-width="2" stroke-linecap="round"
                        fill="none" />
                </svg>
            </div>
            <h2 class="text-5xl md:text-7xl font-black text-[#D4F1BE] text-outline mb-3 transform -rotate-2">
                HEBAT!
            </h2>
            <p
                class="text-xl font-bold text-slate-600 mb-8 bg-[#FFF5B8] brutal-border brutal-shadow-sm px-6 py-3 rounded-2xl">
                Ingatan kamu luar biasa!
            </p>

            <div class="flex gap-4">
                <button onclick="initGame()"
                    class="bg-[#D4F1BE] brutal-border brutal-shadow-sm brutal-hover px-8 py-4 rounded-3xl font-bold text-lg">
                    Main Lagi
                </button>
                <button onclick="window.location.href='{{ route('general.index') }}'"
                    class="bg-[#FFB3B3] brutal-border brutal-shadow-sm brutal-hover px-8 py-4 rounded-3xl font-bold text-lg">
                    Keluar
                </button>
            </div>
        </div>
    </div>

    <script>
        const allLetters = 'abcdefghijklmnopqrstuvwxyz'.split('');
        let currentMode = 'easy'; // 'easy' or 'medium'
        let cardsData = [];
        let flippedCards = [];
        let lockBoard = false;
        let hintTimer = null;

        const board = document.getElementById('board-container');
        const btnEasy = document.getElementById('btn-easy');
        const btnMedium = document.getElementById('btn-medium');
        const modeTitle = document.getElementById('mode-title');
        const modeDesc = document.getElementById('mode-desc');

        function setMode(mode) {
            currentMode = mode;
            if (mode === 'easy') {
                btnEasy.classList.replace('bg-[#E2E8F0]', 'bg-[#FFF5B8]');
                btnMedium.classList.replace('bg-[#FFF5B8]', 'bg-[#E2E8F0]');
                modeTitle.innerText = "Cari Pasangan Gambar!";
                modeDesc.innerHTML = "Ingat gambarnya dan <b>cari isyarat tangan</b> yang persis sama!";
            } else {
                btnMedium.classList.replace('bg-[#E2E8F0]', 'bg-[#FFF5B8]');
                btnEasy.classList.replace('bg-[#FFF5B8]', 'bg-[#E2E8F0]');
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
            board.innerHTML = '';
            document.body.classList.remove('victory-glow');

            const winModal = document.getElementById('win-modal');
            winModal.classList.add('hidden');
            winModal.classList.remove('flex');

            // Generate Data: 6 Pasang (12 Kartu)
            cardsData = [];
            const selectedLetters = getRandomLetters(6);

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
                card.className = 'card';
                card.dataset.matchId = data.matchId;

                const inner = document.createElement('div');
                inner.className = 'card-inner';

                // Front (Punggung Kartu)
                const front = document.createElement('div');
                front.className = 'card-front';

                // Back (Muka Kartu)
                const back = document.createElement('div');
                back.className = 'card-back brutal-border';
                if (data.type === 'image') {
                    back.innerHTML = `<img src="${data.content}" alt="Isyarat ${data.matchId}" />`;
                } else {
                    back.innerHTML = `<span class="letter-text">${data.content}</span>`;
                }

                inner.appendChild(front);
                inner.appendChild(back);
                card.appendChild(inner);

                card.addEventListener('click', () => handleCardClick(card));
                board.appendChild(card);
            });
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
                        if (c !== card && c.dataset.matchId === matchId && !c.classList.contains('matched')) {
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

            flippedCards = [];
            lockBoard = false;

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
            const closedClass = 'brutal-border rounded-xl flex items-center justify-center font-black text-2xl transition-all duration-500 shadow-sm bg-[#FFB3B3] text-transparent select-none border-black';
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
                card1.className = 'brutal-border rounded-xl flex items-center justify-center font-black text-2xl transition-all duration-500 shadow-sm bg-[#FFF5B8] text-black select-none ring-4 ring-sky-400';
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
                card2.className = 'brutal-border rounded-xl flex items-center justify-center font-black text-2xl transition-all duration-500 shadow-sm bg-[#FFF5B8] text-black select-none ring-4 ring-sky-400';
            }, 2600);

            // 5. SALAH! Kedua kartu menjadi Merah & Bergetar
            setTimeout(() => {
                cursor.style.transform = 'scale(1)';
                const wrongClass = 'brutal-border rounded-xl flex items-center justify-center font-black text-2xl transition-all duration-300 shadow-sm bg-red-400 text-white select-none border-red-700 animate-pulse';
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
                card1.className = 'brutal-border rounded-xl flex items-center justify-center font-black text-2xl transition-all duration-500 shadow-sm bg-[#FFF5B8] text-black select-none ring-4 ring-sky-400';
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
                card3.className = 'brutal-border rounded-xl flex items-center justify-center font-black text-2xl transition-all duration-500 shadow-sm bg-[#FFF5B8] text-black select-none ring-4 ring-sky-400';
            }, 6900);

            // 11. BENAR! Kedua kartu menjadi Hijau Kemenangan
            setTimeout(() => {
                cursor.style.transform = 'scale(1)';
                const rightClass = 'brutal-border rounded-xl flex items-center justify-center font-black text-2xl transition-all duration-500 shadow-sm bg-[#D4F1BE] text-black select-none border-green-600 animate-bounce';
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
        }

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
</body>

</html>