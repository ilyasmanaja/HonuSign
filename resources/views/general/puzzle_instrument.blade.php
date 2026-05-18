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

        .text-outline {
            text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000, 2px 2px 0 #000;
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
            max-width: 450px;
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
                class="text-6xl md:text-8xl font-black text-black text-outline transform -rotate-2 animate-bounce text-center drop-shadow-[0_10px_0_rgba(0,0,0,0.15)]">
                Harmoni Riau
            </h1>
            <p
                class="mt-6 text-2xl font-bold text-slate-500 bg-[#FFF5B8] brutal-border brutal-shadow-sm px-6 py-2 rounded-2xl inline-block rotate-1">
                Mari Belajar Bersama!</p>
        </div>
    </div>

    <a href="{{ route('general.index') }}"
        class="absolute top-4 left-4 md:top-6 md:left-6 z-[110] bg-[#FFB3B3] text-black px-5 py-2.5 md:px-7 md:py-3 rounded-2xl font-bold text-sm md:text-base brutal-border brutal-shadow-sm brutal-hover flex items-center gap-2">
        Kembali
    </a>

    <!-- Main Container Layout: Bento Grid Style -->
    <div
        class="min-h-screen pt-24 pb-12 px-4 md:px-8 flex flex-col lg:flex-row items-center lg:items-start justify-center gap-8 max-w-7xl mx-auto">

        <!-- Area Kiri: Puzzle Board -->
        <div class="w-full lg:w-1/2 flex flex-col items-center justify-center">

            <h1 class="text-4xl md:text-5xl font-black text-black tracking-tighter mb-6 text-center">
                Harmoni <span class="text-[#BEE9E8] text-outline">Alat Musik</span>
            </h1>

            <!-- Board 3x3 -->
            <div id="board-container" class="puzzle-board brutal-border brutal-shadow rounded-2xl p-1">
                <!-- Tiles will be generated by JS -->
            </div>

            <p
                class="mt-6 text-slate-500 font-bold text-center bg-[#FFFEFA] px-4 py-2 rounded-2xl brutal-border brutal-shadow-sm">
                Klik 2 kotak untuk menukar posisinya!
            </p>
        </div>

        <!-- Area Kanan: Panel Kontrol & Referensi -->
        <div class="w-full lg:w-[400px] flex flex-col gap-6">

            <!-- Referensi Gambar -->
            <div class="bg-[#FFFEFA] brutal-border brutal-shadow-sm rounded-3xl p-6 flex flex-col items-center">
                <h2 class="text-xl font-bold uppercase tracking-widest mb-4">Target Gambar</h2>
                <div class="w-48 h-48 brutal-border brutal-shadow-sm rounded-xl overflow-hidden relative">
                    <img id="reference-img" src="" alt="Referensi Alat Musik" class="w-full h-full object-cover">
                </div>
            </div>

            <!-- Progress & Kontrol -->
            <div class="bg-[#E0BBE4] brutal-border brutal-shadow rounded-3xl p-6 flex flex-col gap-5">

                <div class="flex justify-between items-end">
                    <span class="font-black text-lg uppercase tracking-widest">Langkah:</span>
                    <span id="moves-count"
                        class="text-4xl font-black bg-[#FFFEFA] brutal-border px-4 py-1 rounded-2xl transform rotate-2 shadow-sm">0</span>
                </div>

                <div class="flex flex-col gap-2">
                    <span class="font-black text-lg uppercase tracking-widest">Waktu Teresisa:</span>
                    <div class="timer-bar-container">
                        <div id="timer-bar" class="timer-bar"></div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mt-2">
                    <button id="btn-shuffle"
                        class="bg-[#FFF5B8] brutal-border brutal-shadow-sm brutal-hover px-4 py-3 rounded-2xl font-bold text-sm flex items-center justify-center gap-2">
                        Acak
                    </button>
                    <button id="btn-hint"
                        class="bg-[#BEE9E8] brutal-border brutal-shadow-sm brutal-hover px-4 py-3 rounded-2xl font-bold text-sm flex items-center justify-center gap-2">
                        Bantuan
                    </button>
                </div>

            </div>
        </div>

    </div>

    <!-- Victory Modal -->
    <div id="win-modal"
        class="hidden fixed inset-0 z-[120] bg-black/60 backdrop-blur-sm flex-col items-center justify-center p-4">
        <div class="bg-[#FFFEFA] p-8 md:p-12 rounded-[3rem] brutal-border brutal-shadow flex flex-col items-center text-center transform scale-90 opacity-0 transition-all duration-500"
            id="win-modal-content">

            <div class="text-6xl mb-4 animate-bounce">🎉</div>
            <h2 class="text-5xl md:text-7xl font-black text-[#D4F1BE] text-outline mb-3 transform -rotate-2">HEBAT!</h2>
            <p class="text-base font-bold text-slate-600 mb-3">Ini adalah alat musik:</p>
            <h3 id="win-instrument-name"
                class="text-3xl md:text-4xl font-black text-black mb-6 bg-[#FFF5B8] brutal-border brutal-shadow-sm px-6 py-2 rounded-2xl transform rotate-1">
                Nama Alat</h3>

            <div class="flex flex-wrap justify-center gap-4">
                <button id="btn-lanjut" onclick="initGame()"
                    class="hidden bg-[#D4F1BE] brutal-border brutal-shadow-sm brutal-hover px-8 py-4 rounded-3xl font-bold text-lg">
                    Lanjut
                </button>
                <button id="btn-ulangi" onclick="initGame()"
                    class="hidden bg-[#FFF5B8] brutal-border brutal-shadow-sm brutal-hover px-8 py-4 rounded-3xl font-bold text-lg">
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
        // Data Gambar Alat Musik
        const instruments = [
            { id: 1, name: 'Gambus', src: 'Gambus.png' },
            { id: 2, name: 'Gedombak', src: 'Gedombak.png' },
            { id: 3, name: 'Kompang', src: 'Kompang.png' },
            { id: 4, name: 'Marwas', src: 'marwas.png' }
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

            // Pilih instrumen yang belum dimainkan
            let unplayed = instruments.filter(inst => !playedInstrumentIds.includes(inst.id));
            if (unplayed.length === 0) {
                // Jika sudah semua dimainkan, reset agar bisa dimainkan ulang dari awal
                playedInstrumentIds = [];
                unplayed = instruments;
            }

            const inst = unplayed[Math.floor(Math.random() * unplayed.length)];
            playedInstrumentIds.push(inst.id); // Tandai sudah dimainkan di ronde ini

            currentImage = `{{ asset('images/general/musik') }}/${inst.src}`;
            refImg.src = currentImage;

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

            // Start Timer
            resetTimer();
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

        // Initialize on load with Intro Overlay
        document.addEventListener('DOMContentLoaded', () => {
            initGame();

            setTimeout(() => {
                const overlay = document.getElementById('intro-overlay');
                if (overlay) {
                    overlay.style.opacity = '0';
                    setTimeout(() => overlay.remove(), 1000);
                }
            }, 2500);
        });

    </script>
</body>

</html>