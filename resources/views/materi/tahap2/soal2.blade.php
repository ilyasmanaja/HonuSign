<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <title>HonuSign - Susun Gambar</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;600;700;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Fredoka', sans-serif;
            background-color: #FFF9F0 !important;
            overflow-x: hidden;
            overflow-y: auto;
            min-height: 100vh;
            width: 100vw;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
        }

        .brutal-border {
            border: 4px solid #000000 !important;
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
            max-width: 480px;
            margin: 0 auto;
        }

        @media (min-width: 1024px) {
            .puzzle-board {
                max-width: 520px;
            }
        }

        .tile {
            position: absolute;
            width: 33.333%;
            height: 33.333%;
            padding: 2px;
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
    </style>
</head>

<body class="selection:bg-transparent transition-transform">

    <!-- Back to Study Page -->
    <a href="{{ route('materi.index') }}" aria-label="Kembali"
        class="absolute top-4 left-4 md:top-6 md:left-6 z-[110] bg-[#FFB3B3] text-black p-3.5 rounded-2xl font-bold brutal-border brutal-shadow-sm brutal-hover flex items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-7 h-7 text-black">
            <circle cx="12" cy="12" r="10" fill="currentColor" class="opacity-20" />
            <path d="M12 8l-4 4 4 4M16 12H8" stroke="currentColor" stroke-width="3" stroke-linecap="round"
                stroke-linejoin="round" fill="none" />
        </svg>
    </a>

    <!-- Header / Title -->
    <div class="pt-16 md:pt-20 px-4 flex justify-center max-w-7xl mx-auto">
        <h1
            class="mb-4 bg-[#FFF5B8] brutal-border brutal-shadow-sm px-8 py-3 rounded-2xl text-2xl md:text-3xl font-black uppercase tracking-widest text-center transform -rotate-1 min-w-[220px] shadow-sm">
            Susun Gambar (Soal 2/3)
        </h1>
    </div>

    <!-- Main Game Section (Side by side grid, 50% left & 50% right) -->
    <div
        class="pb-8 pt-4 px-4 md:px-8 flex flex-col lg:flex-row items-center lg:items-stretch justify-center gap-6 md:gap-8 max-w-7xl w-full mx-auto">

        <!-- Left Column: The Puzzle Board (Enlarged to 50% width) -->
        <div class="w-full lg:w-1/2 flex flex-col items-center justify-center bg-[#BEE9E8] brutal-border brutal-shadow rounded-[2rem] p-6 lg:p-8">
            <div id="board-container"
                class="puzzle-board brutal-border brutal-shadow rounded-2xl p-1 w-full aspect-square">
                <!-- Tiles generated by JS -->
            </div>
        </div>

        <!-- Right Column: Clues, Progress, and Controls (50% width) -->
        <div class="w-full lg:w-1/2 flex flex-col gap-6 justify-between">
            <!-- Reference Target Image Card -->
            <div class="bg-[#FFFEFA] brutal-border brutal-shadow rounded-[2rem] p-6 flex flex-col items-center justify-center">
                <h2 class="text-sm font-black uppercase tracking-widest mb-3 text-slate-500">Target Gambar</h2>
                <div
                    class="w-48 h-48 md:w-56 md:h-56 brutal-border brutal-shadow-sm rounded-2xl overflow-hidden relative bg-slate-100">
                    <img id="reference-img" src="{{ asset('images/materi/tahap1/pakaian_adat.png') }}" alt="Referensi Pakaian Adat"
                        class="w-full h-full object-cover">
                </div>
            </div>

            <!-- Controls Panel -->
            <div class="bg-[#E0BBE4] brutal-border brutal-shadow rounded-[2rem] p-6 flex flex-col gap-5 justify-between">
                <!-- Moves counter -->
                <div class="flex justify-between items-center">
                    <span class="font-black text-slate-800 uppercase tracking-wider">Langkah Ditukar:</span>
                    <span id="moves-count"
                        class="text-3xl font-black bg-[#FFFEFA] brutal-border px-5 py-1 rounded-2xl transform rotate-2 shadow-sm">0</span>
                </div>

                <!-- Action Button Controls -->
                <div class="grid grid-cols-3 gap-3">
                    <!-- Hint -->
                    <button id="btn-hint"
                        class="bg-[#BEE9E8] brutal-border brutal-shadow-sm brutal-hover py-4 rounded-2xl flex items-center justify-center cursor-pointer text-black"
                        title="Bantuan (Angka)">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path opacity="0.2"
                                d="M12 2a7 7 0 0 0-7 7c0 2.38 1.19 4.47 3 5.74V17a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-2.26c1.81-1.27 3-3.36 3-5.74a7 7 0 0 0-7-7z" />
                            <path
                                d="M12 2a7 7 0 0 0-7 7c0 2.38 1.19 4.47 3 5.74V17a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-2.26c1.81-1.27 3-3.36 3-5.74a7 7 0 0 0-7-7zm2 14h-4v-1.5h4V16zm1.75-3.3c-.64.45-1.25.96-1.5 1.55H9.75c-.25-.59-.86-1.1-1.5-1.55A5 5 0 1 1 15.75 9c0 1.48-.68 2.8-1.75 3.7z"
                                fill="currentColor" />
                        </svg>
                    </button>

                    <!-- Shuffle / Reset -->
                    <button id="btn-shuffle"
                        class="bg-white brutal-border brutal-shadow-sm brutal-hover py-4 rounded-2xl flex items-center justify-center cursor-pointer text-black"
                        title="Acak / Ulangi">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <circle cx="12" cy="12" r="10" opacity="0.2" />
                            <path
                                d="M17.65 6.35A7.958 7.958 0 0 0 12 4c-4.42 0-7.99 3.58-7.99 8s3.57 8 7.99 8c3.73 0 6.84-2.55 7.73-6h-2.08A5.99 5.99 0 0 1 12 18c-3.31 0-6-2.69-6-6s2.69-6 6-6c1.66 0 3.14.69 4.22 1.78L13 11h7V4l-2.35 2.35z"
                                fill="currentColor" />
                        </svg>
                    </button>

                    <!-- Sound/Mute -->
                    <button onclick="toggleMute()" id="btn-sound"
                        class="bg-[#FFF5B8] brutal-border brutal-shadow-sm brutal-hover py-4 rounded-2xl flex items-center justify-center cursor-pointer text-black"
                        title="Suara">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="w-6 h-6 text-black" id="sound-icon">
                            <path opacity="0.2" d="M3 9v6h4l5 5V4L7 9H3z" />
                            <path
                                d="M3 9v6h4l5 5V4L7 9H3zm7-.17v6.34L7.83 13H5v-2h2.83L10 8.83zM16.5 12A4.5 4.5 0 0 0 14 8v8a4.5 4.5 0 0 0 2.5-4zm2.5 0a8.94 8.94 0 0 0-2.07-5.78l-1.42 1.42A6.94 6.94 0 0 1 17 12a6.94 6.94 0 0 1-1.49 4.36l1.42 1.42A8.94 8.94 0 0 0 19 12z"
                                fill="currentColor" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

    </div>

    <!-- Victory Modal (using selamat.png) -->
    <div id="success-modal"
        class="fixed inset-0 z-[9999] bg-slate-900/60 backdrop-blur-sm hidden flex-col items-center justify-center opacity-0 transition-all duration-300">
        <div class="relative w-full max-w-[480px] aspect-square transform scale-90 transition-transform duration-500 select-none"
            id="success-modal-content">

            <!-- Main Image -->
            <img src="{{ asset('images/selamat.png') }}" alt="Selamat!"
                class="w-full h-full object-contain rounded-[3rem] brutal-border brutal-shadow">

            <!-- Interactive Buttons Overlaid over pre-rendered spots -->
            <div class="absolute bottom-[9%] left-0 right-0 flex justify-center gap-[8%]">
                <!-- Replay Button -->
                <button onclick="initGame()" aria-label="Ulangi"
                    class="bg-[#FFF5B8] text-black w-[18%] aspect-square rounded-2xl brutal-border brutal-shadow-sm brutal-hover flex items-center justify-center cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        class="w-1/2 h-1/2 text-black fill-none stroke-current" stroke-width="3.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21.5 2v6h-6M21.34 15.57a10 10 0 1 1-.57-8.38l.57-1.19" />
                    </svg>
                </button>
                <!-- Next Button (Lanjut to Soal 3) -->
                <a href="{{ route('materi.belajar', ['step' => 2, 'soal_ke' => 3]) }}" aria-label="Lanjut"
                    class="bg-[#D4F1BE] text-black w-[18%] aspect-square rounded-2xl brutal-border brutal-shadow-sm brutal-hover flex items-center justify-center cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        class="w-1/2 h-1/2 text-black fill-none stroke-current" stroke-width="3.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <script>
        const currentImage = "{{ asset('images/materi/tahap1/pakaian_adat.png') }}";
        let tiles = [];
        const gridSize = 3;
        let isVictory = false;
        let moves = 0;
        let selectedTile = null;
        let isMuted = localStorage.getItem('sound_muted') === 'true';

        const board = document.getElementById('board-container');
        const movesEl = document.getElementById('moves-count');

        // Initialize mute button state
        document.addEventListener('DOMContentLoaded', () => {
            updateSoundIcon();
            initGame();
        });

        function toggleMute() {
            isMuted = !isMuted;
            localStorage.setItem('sound_muted', isMuted);
            updateSoundIcon();
        }

        function updateSoundIcon() {
            const icon = document.getElementById('sound-icon');
            if (isMuted) {
                icon.innerHTML =
                    `<path opacity="0.2" d="M3 9v6h4l5 5V4L7 9H3z"/><path d="M3 9v6h4l5 5V4L7 9H3zm7-.17v6.34L7.83 13H5v-2h2.83L10 8.83zM16.5 12A4.5 4.5 0 0 0 14 8v8a4.5 4.5 0 0 0 2.5-4zm2.5 0a8.94 8.94 0 0 0-2.07-5.78l-1.42 1.42A6.94 6.94 0 0 1 17 12a6.94 6.94 0 0 1-1.49 4.36l1.42 1.42A8.94 8.94 0 0 0 19 12z" fill="currentColor"/><line x1="1" y1="1" x2="23" y2="23" stroke="black" stroke-width="3" />`;
            } else {
                icon.innerHTML =
                    `<path opacity="0.2" d="M3 9v6h4l5 5V4L7 9H3z"/><path d="M3 9v6h4l5 5V4L7 9H3zm7-.17v6.34L7.83 13H5v-2h2.83L10 8.83zM16.5 12A4.5 4.5 0 0 0 14 8v8a4.5 4.5 0 0 0 2.5-4zm2.5 0a8.94 8.94 0 0 0-2.07-5.78l-1.42 1.42A6.94 6.94 0 0 1 17 12a6.94 6.94 0 0 1-1.49 4.36l1.42 1.42A8.94 8.94 0 0 0 19 12z" fill="currentColor"/>`;
            }
        }

        function initGame() {
            isVictory = false;
            moves = 0;
            movesEl.innerText = moves;
            selectedTile = null;
            board.innerHTML = '';
            board.classList.remove('victory-state', 'show-hint');
            
            const successModal = document.getElementById('success-modal');
            const successContent = document.getElementById('success-modal-content');
            if (successModal) {
                successModal.classList.add('hidden');
                successModal.classList.remove('flex');
            }

            tiles = [];
            for (let r = 0; r < gridSize; r++) {
                for (let c = 0; c < gridSize; c++) {
                    const tile = document.createElement('div');
                    tile.className = 'tile';

                    const inner = document.createElement('div');
                    inner.className = 'tile-inner brutal-border rounded-xl bg-white';
                    inner.style.backgroundImage = `url('${currentImage}')`;

                    const bgPosX = (c / (gridSize - 1)) * 100;
                    const bgPosY = (r / (gridSize - 1)) * 100;
                    inner.style.backgroundPosition = `${bgPosX}% ${bgPosY}%`;
                    inner.innerText = (r * gridSize + c + 1);

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
                    tile.addEventListener('click', () => handleTileClick(tileData));

                    tiles.push(tileData);
                    board.appendChild(tile);
                }
            }

            shuffleBoard(40);
        }

        function updateTilePos(tileData) {
            tileData.el.style.left = `${(tileData.currentC * 100) / gridSize}%`;
            tileData.el.style.top = `${(tileData.currentR * 100) / gridSize}%`;
        }

        function handleTileClick(tileData) {
            if (isVictory) return;

            if (selectedTile === null) {
                selectedTile = tileData;
                tileData.el.classList.add('selected-glow');
            } else if (selectedTile === tileData) {
                selectedTile.el.classList.remove('selected-glow');
                selectedTile = null;
            } else {
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

                selectedTile = null;
                checkVictory();
            }
        }

        function checkVictory() {
            const won = tiles.every(t => t.currentR === t.correctR && t.currentC === t.correctC);
            if (won) {
                isVictory = true;
                setTimeout(() => {
                    board.classList.add('victory-state');
                }, 300);

                setTimeout(() => {
                    showSuccessModal();
                }, 1200);
            }
        }

        function shuffleBoard(steps) {
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

            tiles.forEach(t => {
                t.el.style.transition = 'none';
                updateTilePos(t);
                setTimeout(() => t.el.style.transition = 'left 0.3s ease-in-out, top 0.3s ease-in-out', 50);
            });
        }

        function showSuccessModal() {
            const modal = document.getElementById('success-modal');
            const content = document.getElementById('success-modal-content');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            void modal.offsetWidth;
            modal.classList.remove('opacity-0');
            content.classList.remove('scale-90');
            content.classList.add('scale-100');

            saveProgress(2, 0);
        }

        function saveProgress(tahap, nilai) {
            fetch('{{ route('materi.save_progress') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        materi_id: {{ $materi->id }},
                        tahap: tahap,
                        score: nilai
                    })
                })
                .then(response => response.json())
                .then(data => console.log("Progress saved:", data.message))
                .catch(err => console.error("Error saving progress:", err));
        }

        document.getElementById('btn-shuffle').addEventListener('click', () => {
            if (isVictory) return;
            shuffleBoard(40);
            moves = 0;
            movesEl.innerText = moves;
        });

        document.getElementById('btn-hint').addEventListener('click', () => {
            board.classList.toggle('show-hint');
        });
    </script>
</body>

</html>
