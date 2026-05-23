<x-student-layout>
    <style>
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
            max-width: 380px;
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
            font-size: 2.5rem;
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

    <!-- Main Card Container filling 80-85% viewport, zero scrolling -->
    <div
        class="w-full max-w-6xl h-[calc(100vh-3rem)] bg-[#FFFEFA] brutal-border brutal-shadow rounded-[3rem] p-6 flex flex-col justify-between overflow-hidden relative">

        <!-- Header (Menu Bar with Hint, Reset & Mute, NO Home button) -->
        <header class="w-full flex items-center justify-between pb-3 border-b-4 border-black mb-2">
            <!-- Left side status info -->
            <div class="flex items-center gap-2">
                <div class="w-4 h-4 rounded-full bg-[#E0BBE4] brutal-border"></div>
                <span class="font-black text-black uppercase tracking-wider text-xs md:text-sm">Susun Gambar (Soal
                    2/3)</span>
            </div>
            <!-- Right side system controls -->
            <div class="flex items-center gap-3">
                <!-- Hint Button -->
                <button id="btn-hint"
                    class="w-12 h-12 bg-[#BEE9E8] brutal-border brutal-shadow-sm brutal-hover flex items-center justify-center rounded-2xl cursor-pointer text-black"
                    title="Bantuan (Angka)">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path opacity="0.2"
                            d="M12 2a7 7 0 0 0-7 7c0 2.38 1.19 4.47 3 5.74V17a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-2.26c1.81-1.27 3-3.36 3-5.74a7 7 0 0 0-7-7z" />
                        <path
                            d="M12 2a7 7 0 0 0-7 7c0 2.38 1.19 4.47 3 5.74V17a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-2.26c1.81-1.27 3-3.36 3-5.74a7 7 0 0 0-7-7zm2 14h-4v-1.5h4V16zm1.75-3.3c-.64.45-1.25.96-1.5 1.55H9.75c-.25-.59-.86-1.1-1.5-1.55A5 5 0 1 1 15.75 9c0 1.48-.68 2.8-1.75 3.7z"
                            fill="currentColor" />
                    </svg>
                </button>
                <!-- Shuffle / Reset Button -->
                <button id="btn-shuffle"
                    class="w-12 h-12 bg-white brutal-border brutal-shadow-sm brutal-hover flex items-center justify-center rounded-2xl cursor-pointer text-black"
                    title="Acak / Ulangi">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <circle cx="12" cy="12" r="10" opacity="0.2" />
                        <path
                            d="M17.65 6.35A7.958 7.958 0 0 0 12 4c-4.42 0-7.99 3.58-7.99 8s3.57 8 7.99 8c3.73 0 6.84-2.55 7.73-6h-2.08A5.99 5.99 0 0 1 12 18c-3.31 0-6-2.69-6-6s2.69-6 6-6c1.66 0 3.14.69 4.22 1.78L13 11h7V4l-2.35 2.35z"
                            fill="currentColor" />
                    </svg>
                </button>
                <!-- Sound/Mute Button -->
                <button onclick="toggleMute()" id="btn-sound"
                    class="w-12 h-12 bg-[#FFF5B8] brutal-border brutal-shadow-sm brutal-hover flex items-center justify-center rounded-2xl cursor-pointer text-black"
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
        </header>

        <!-- Main Bento Layout (Two equal size cards side-by-side + Mascot in between) -->
        <div class="w-full flex flex-col md:flex-row gap-6 flex-grow items-center justify-center my-2 max-h-[72%]">
            <!-- Left Side: Puzzle Board Card -->
            <div
                class="w-full md:w-[45%] flex flex-col items-center justify-center bg-[#BEE9E8] brutal-border brutal-shadow rounded-[2rem] p-4 h-full">
                <div id="board-container"
                    class="puzzle-board brutal-border brutal-shadow rounded-2xl p-1 w-full aspect-square max-w-[320px] md:max-w-[380px]">
                    <!-- Tiles generated by JS -->
                </div>
            </div>

            <!-- Center: Mascot Guide (Speech bubble + Samsul mascot) -->
            <div class="hidden lg:flex flex-col items-center justify-center w-24 gap-2">
                <div
                    class="bg-[#FFF5B8] brutal-border px-3 py-1.5 rounded-2xl brutal-shadow-sm text-center transform -rotate-2">
                    <span class="text-3xl animate-pulse">🧩</span>
                </div>
                <img src="{{ asset('images/keSekolah/samsul.png') }}" class="w-20 h-auto object-contain animate-bounce"
                    alt="Samsul Maskot">
            </div>

            <!-- Right Side: Target Image -->
            <div
                class="w-full md:w-[45%] flex flex-col items-center justify-center bg-[#FFFEFA] brutal-border brutal-shadow rounded-[2rem] p-4 h-full">
                <!-- Visual Icon Title (Instead of Target Gambar text) -->
                <div
                    class="flex items-center gap-3 mb-2 bg-[#FFD1E3] px-5 py-1 rounded-xl brutal-border transform -rotate-1 brutal-shadow-sm">
                    <span class="text-base">🌟</span>
                    <span class="text-base">🎯</span>
                    <span class="text-base">🌟</span>
                </div>

                <!-- Reference Image Container (Perfect square, matching the puzzle board layout size) -->
                <div
                    class="w-full aspect-square max-w-[320px] md:max-w-[380px] brutal-border brutal-shadow rounded-2xl overflow-hidden bg-slate-100">
                    <img src="{{ asset('images/materi/tahap1/pakaian_adat.png') }}" class="w-full h-full object-cover"
                        alt="Referensi Pakaian Adat">
                </div>
            </div>
        </div>

        <!-- Bottom Section: Moves counter & Controls -->
        <div class="flex justify-between items-center w-full px-6 py-2 border-t-4 border-black">
            <div class="flex items-center gap-2">
                <span class="font-black text-xs md:text-sm uppercase tracking-widest text-slate-700">Langkah
                    Ditukar:</span>
                <span id="moves-count"
                    class="text-base text-black font-black bg-[#E0BBE4] brutal-border px-4 py-0.5 rounded-xl inline-block brutal-shadow-sm transform rotate-1">0</span>
            </div>

            <a href="{{ route('materi.belajar', ['step' => 2, 'soal_ke' => 3]) }}" id="next-btn"
                class="hidden bg-[#D4F1BE] text-black w-12 h-12 flex items-center justify-center rounded-full brutal-border brutal-shadow-sm brutal-hover transform transition-all animate-bounce"
                title="Lanjut">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7">
                    <circle cx="12" cy="12" r="10" opacity="0.2" />
                    <path d="M10 17V7l7 5-7 5z" fill="currentColor" />
                </svg>
            </a>
        </div>
    </div>

    <!-- Modal Sukses Kustom (Smiling Face + Thumbs Up - No Close Button) -->
    <div id="success-modal"
        class="fixed inset-0 z-[9999] bg-slate-900/60 backdrop-blur-sm hidden flex-col items-center justify-center opacity-0 transition-all duration-300">
        <div class="bg-[#BEE9E8] p-8 md:p-12 rounded-[3rem] brutal-border brutal-shadow flex flex-col items-center max-w-lg mx-4 transform scale-90 transition-transform duration-500 relative"
            id="success-modal-content">

            <div class="flex items-center justify-center gap-6 mb-6">
                <!-- Smiling Face -->
                <div class="p-4 bg-[#FFF5B8] brutal-border brutal-shadow-sm rounded-2xl animate-bounce"
                    style="animation-delay: 0.1s">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="w-16 h-16 text-black">
                        <circle cx="12" cy="12" r="10" opacity="0.2" fill="currentColor" />
                        <circle cx="9" cy="9.5" r="1.5" fill="currentColor" />
                        <circle cx="15" cy="9.5" r="1.5" fill="currentColor" />
                        <path d="M12 18c2.28 0 4.22-1.24 5-3H7c.78 1.76 2.72 3 5 3z" fill="currentColor" />
                    </svg>
                </div>
                <!-- Thumbs Up -->
                <div class="p-4 bg-[#D4F1BE] brutal-border brutal-shadow-sm rounded-2xl animate-bounce"
                    style="animation-delay: 0.3s">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="w-16 h-16 text-black">
                        <path opacity="0.2"
                            d="M21 10a2 2 0 0 0-2-2h-5.07l.76-3.65c.18-.89-.17-1.81-.9-2.35L13 2H9v11h4l1.63 5.48c.32 1.07 1.3 1.8 2.42 1.8h.07a2 2 0 0 0 1.94-1.51L21 10z" />
                        <path
                            d="M4 11h3v10H4a1 1 0 0 1-1-1v-8a1 1 0 0 1 1-1zm15-3h-5.07l.76-3.65A2.39 2.39 0 0 0 13.8 2H9v11h4l1.63 5.48A2.5 2.5 0 0 0 17 20h.07a2 2 0 0 0 1.94-1.51L21 10a2 2 0 0 0-2-2zM9 11v8h8.07l-1.63-5.48L13.8 8H19l-2 10H9v-7z"
                            fill="currentColor" />
                    </svg>
                </div>
            </div>

            <h2
                class="text-4xl md:text-5xl font-black text-white text-outline uppercase tracking-tighter text-center mb-2 transform -rotate-2 drop-shadow-[0_4px_0_#000]">
                SELAMAT!
            </h2>
            <p class="text-xl md:text-2xl font-bold text-slate-800 text-center mb-10 bg-[#FFF5B8] px-4 py-2 rounded-xl brutal-border"
                id="modal-desc">
                Puzzlenya sudah rapi kembali!
            </p>

            <!-- Lanjut -->
            <a href="{{ route('materi.belajar', ['step' => 2, 'soal_ke' => 3]) }}"
                class="bg-[#D4F1BE] text-black w-24 h-24 flex items-center justify-center rounded-full brutal-border brutal-shadow-sm brutal-hover transform hover:-translate-y-2 transition-all"
                title="Lanjut">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-14 h-14">
                    <circle cx="12" cy="12" r="10" opacity="0.2" fill="currentColor" />
                    <path d="M10 17V7l7 5-7 5z" fill="currentColor" />
                </svg>
            </a>
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
            document.getElementById('success-modal').classList.add('hidden');
            document.getElementById('success-modal').classList.remove('flex');

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
            document.getElementById('next-btn').classList.remove('hidden');
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
</x-student-layout>
