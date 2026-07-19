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

        .show-hint .tile-inner {
            color: rgba(255, 255, 255, 0.9);
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.8);
        }

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

    @php
        // Ambil data quiz tipe puzzle milik materi aktif
        $quiz = \App\Models\Quiz::where('materi_id', $materi->id)
            ->where('tipe', 'puzzle')
            ->first();

        // Ambil nama gambar dari kolom jawaban_benar, dengan fallback default
        $namaGambar = $quiz ? $quiz->jawaban_benar : 'pakaian_adat.png';
        $instruksiSoal = $quiz ? $quiz->pertanyaan : 'Susun potongan gambar ini menjadi utuh!';
        
        // Buat path asset lengkap untuk dilempar ke JavaScript dan Image View
        $imageAssetPath = asset('images/materi/tahap1/' . $namaGambar);
    @endphp

    <!-- Back Button with Tooltip (Fixed Route dengan mapel_slug) -->
    <div class="absolute top-4 left-4 md:top-6 md:left-6 z-[110] group/tooltip pointer-events-auto">
        <a href="{{ route('materi.index', ['mapel_slug' => $mapel->slug]) }}" aria-label="Kembali"
            class="bg-[#FFB3B3] text-black p-3.5 rounded-2xl font-bold brutal-border brutal-shadow-sm brutal-hover flex items-center justify-center w-14 h-14">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-7 h-7 text-black" fill="none"
                stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12" />
                <polyline points="12 19 5 12 12 5" />
            </svg>
        </a>
        <div class="pointer-events-none absolute left-0 top-full mt-3 bg-[#FFD1E3] brutal-border brutal-shadow-sm px-3 py-1.5 rounded-lg text-sm font-bold opacity-0 scale-95 group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-150 whitespace-nowrap z-50 text-black">
            Kembali ke Peta
        </div>
    </div>

    <!-- Header / Title -->
    <div class="pt-16 md:pt-20 px-4 flex justify-center max-w-7xl mx-auto">
        <h1 class="mb-4 bg-[#FFF5B8] brutal-border brutal-shadow-sm px-8 py-3 rounded-2xl text-2xl md:text-3xl font-black uppercase tracking-widest text-center transform -rotate-1 min-w-[220px] shadow-sm">
            Susun Gambar (Soal {{ $soal_ke }}/3)
        </h1>
    </div>

    <!-- Main Game Section -->
    <div class="pb-8 pt-4 px-4 md:px-8 flex flex-col lg:flex-row items-center lg:items-stretch justify-center gap-6 md:gap-8 max-w-7xl w-full mx-auto">

        <!-- Left Column: The Puzzle Board -->
        <div class="w-full lg:w-1/2 flex flex-col items-center justify-center bg-[#BEE9E8] brutal-border brutal-shadow rounded-[2rem] p-6 lg:p-8">
            <!-- Instruksi Soal Dinamis -->
            <h2 class="text-lg font-black text-black uppercase tracking-wide mb-4 text-center bg-white px-4 py-1.5 brutal-border rounded-xl shadow-inner">
                {{ $instruksiSoal }}
            </h2>
            <div id="board-container" class="puzzle-board brutal-border brutal-shadow rounded-2xl p-1 w-full aspect-square">
                <!-- Tiles generated by JS -->
            </div>
        </div>

        <!-- Right Column: Clues, Progress, and Controls -->
        <div class="w-full lg:w-1/2 flex flex-col gap-6 justify-between">
            <!-- Reference Target Image Card (Dinamis) -->
            <div class="bg-[#FFFEFA] brutal-border brutal-shadow rounded-[2rem] p-6 flex flex-col items-center justify-center">
                <h2 class="text-sm font-black uppercase tracking-widest mb-3 text-slate-500">Target Gambar</h2>
                <div class="w-48 h-48 md:w-56 md:h-56 brutal-border brutal-shadow-sm rounded-2xl overflow-hidden relative bg-slate-100">
                    <img id="reference-img" src="{{ $imageAssetPath }}" alt="Referensi Sasaran Puzzle" class="w-full h-full object-cover">
                </div>
            </div>

            <!-- Controls Panel -->
            <div class="bg-[#E0BBE4] brutal-border brutal-shadow rounded-[2rem] p-6 flex flex-col gap-5 justify-between">
                <!-- Moves counter -->
                <div class="flex justify-between items-center">
                    <span class="font-black text-slate-800 uppercase tracking-wider">Langkah Ditukar:</span>
                    <span id="moves-count" class="text-3xl font-black bg-[#FFFEFA] brutal-border px-5 py-1 rounded-2xl transform rotate-2 shadow-sm">0</span>
                </div>

                <!-- Action Button Controls -->
                <div class="grid grid-cols-2 gap-4 mt-1">
                    <div class="relative group/tooltip">
                        <button id="btn-shuffle" aria-label="Acak" class="w-full bg-[#FFF5B8] brutal-border brutal-shadow-sm brutal-hover py-3.5 rounded-2xl flex items-center justify-center cursor-pointer text-black">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 h-6 text-black" fill="#BEE9E8" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="16 3 21 3 21 8"></polyline>
                                <line x1="4" y1="20" x2="21" y2="3"></line>
                                <polyline points="21 16 21 21 16 21"></polyline>
                                <line x1="15" y1="15" x2="21" y2="21"></line>
                                <line x1="4" y1="4" x2="9" y2="9"></line>
                            </svg>
                        </button>
                        <div class="pointer-events-none absolute bottom-full left-1/2 -translate-x-1/2 mb-3 bg-[#FFD1E3] brutal-border brutal-shadow-sm px-3 py-1.5 rounded-lg text-sm font-bold opacity-0 scale-95 group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-150 whitespace-nowrap z-50 text-black">
                            Acak Gambar
                        </div>
                    </div>

                    <div class="relative group/tooltip">
                        <button id="btn-hint" aria-label="Bantuan" class="w-full bg-[#BEE9E8] brutal-border brutal-shadow-sm brutal-hover py-3.5 rounded-2xl flex items-center justify-center cursor-pointer text-black">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 h-6 text-black" fill="#facc15" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M15 14c.2-1 .7-1.7 1.5-2.5 1-.9 1.5-2.2 1.5-3.5A5 5 0 0 0 8 8c0 1 .3 2.2 1.5 3.5.7.7 1.3 1.5 1.5 2.5"></path>
                                <line x1="9" y1="18" x2="15" y2="18"></line>
                                <line x1="10" y1="22" x2="14" y2="22"></line>
                            </svg>
                        </button>
                        <div class="pointer-events-none absolute bottom-full left-1/2 -translate-x-1/2 mb-3 bg-[#FFD1E3] brutal-border brutal-shadow-sm px-3 py-1.5 rounded-lg text-sm font-bold opacity-0 scale-95 group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-150 whitespace-nowrap z-50 text-black">
                            Bantuan Angka
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Victory Modal (Fixed route dengan slug mapel ke Soal 3) -->
    <div id="success-modal" class="fixed inset-0 z-[9999] bg-slate-900/60 backdrop-blur-sm hidden flex-col items-center justify-center opacity-0 transition-all duration-300">
        <div class="relative w-full max-w-[480px] aspect-square transform scale-90 transition-transform duration-500 select-none" id="success-modal-content">
            <img src="{{ asset('images/selamat.png') }}" alt="Selamat!" class="w-full h-full object-contain rounded-[3rem] brutal-border brutal-shadow">

            <div class="absolute bottom-[9%] left-0 right-0 flex justify-center gap-[8%]">
                <div class="relative group/tooltip w-[18%] aspect-square">
                    <button onclick="initGame()" aria-label="Ulangi" class="w-full h-full bg-[#FFF5B8] text-black rounded-2xl brutal-border brutal-shadow-sm brutal-hover flex items-center justify-center cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-1/2 h-1/2 text-black fill-none stroke-current" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21.5 2v6h-6M21.34 15.57a10 10 0 1 1-.57-8.38l.57-1.19" />
                        </svg>
                    </button>
                </div>
                <div class="relative group/tooltip w-[18%] aspect-square">
                    <!-- Navigasi ke Soal 3 dengan parameter mapel_slug -->
                    <a href="{{ route('materi.belajar', ['mapel_slug' => $mapel->slug, 'step' => 2, 'soal_ke' => 3]) }}" aria-label="Lanjut"
                        class="w-full h-full bg-[#D4F1BE] text-black rounded-2xl brutal-border brutal-shadow-sm brutal-hover flex items-center justify-center cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-1/2 h-1/2 text-black fill-none stroke-current" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Menggunakan path asset dinamis dari PHP
        const currentImage = "{{ $imageAssetPath }}";
        let tiles = [];
        const gridSize = 3;
        let isVictory = false;
        let moves = 0;
        let selectedTile = null;

        const board = document.getElementById('board-container');
        const movesEl = document.getElementById('moves-count');

        document.addEventListener('DOMContentLoaded', () => {
            initGame();
        });

        function initGame() {
            isVictory = false;
            moves = 0;
            movesEl.innerText = moves;
            selectedTile = null;
            board.innerHTML = '';
            board.classList.remove('victory-state', 'show-hint');

            const successModal = document.getElementById('success-modal');
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

            saveProgress(2, 100);
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