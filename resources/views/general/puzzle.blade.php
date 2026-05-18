<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <title>HonuSign - Riau Discovery Puzzle</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;600;700;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Fredoka', sans-serif;
            background-color: #BEE9E8 !important;
            /* Biru Muda Pastel */
        }

        /* Semi-Brutalism Utility Classes */
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

        .puzzle-piece {
            touch-action: none;
            -webkit-user-drag: none;
            transition: transform 0.2s ease;
            cursor: grab;
            position: absolute;
        }

        .puzzle-piece:active {
            cursor: grabbing;
            transform: scale(1.05);
        }

        .puzzle-piece.dragging {
            transition: none !important;
            z-index: 999;
            filter: drop-shadow(0 15px 20px rgba(0, 0, 0, 0.6));
        }

        .puzzle-piece.locked {
            z-index: 5;
            filter: drop-shadow(0 0 12px rgba(255, 255, 255, 1));
            animation: pulse-glow 1.5s ease-out forwards;
        }

        @keyframes pulse-glow {
            0% {
                filter: drop-shadow(0 0 30px rgba(255, 255, 255, 1));
                transform: translate(-50%, -50%) scale(1.05);
            }

            100% {
                filter: drop-shadow(0 0 0px rgba(255, 255, 255, 0));
                transform: translate(-50%, -50%) scale(1);
            }
        }

        #guide-svg {
            position: fixed;
            inset: 0;
            width: 100vw;
            height: 100vh;
            pointer-events: none;
            z-index: 998;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .modal-animate {
            animation: fadeIn 0.5s ease forwards;
        }

        .tray-slot {
            position: relative;
            width: 80px;
            height: 80px;
            display: inline-block;
            background-color: rgba(255, 255, 255, 0.6);
            border: 3px solid #000;
            box-shadow: inset 3px 3px 0px 0px rgba(0, 0, 0, 0.2);
            border-radius: 1rem;
            flex-shrink: 0;
        }

        @media (min-width: 768px) {
            .tray-slot {
                width: 110px;
                height: 110px;
            }
        }

        @keyframes screen-shake {
            0% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-15px) rotate(-1deg);
            }

            50% {
                transform: translateX(15px) rotate(1deg);
            }

            75% {
                transform: translateX(-10px) rotate(-0.5deg);
            }

            100% {
                transform: translateX(0);
            }
        }

        .screen-shake {
            animation: screen-shake 0.4s ease;
        }

        .wrong-drop {
            outline: 3px solid #FF6B6B;
            filter: drop-shadow(6px 6px 0 rgba(0, 0, 0, 1));
            transition: all 0.3s;
        }

        .wrong-bubble {
            position: absolute;
            left: 50%;
            bottom: 130%;
            transform: translateX(-50%);
            background: #FF6B6B;
            color: #FFFEFA;
            border: 3px solid #000;
            padding: 0.7rem 1.2rem;
            border-radius: 9999px;
            font-weight: 700;
            font-size: 1.1rem;
            white-space: nowrap;
            box-shadow: 4px 4px 0 rgba(0, 0, 0, 1);
            pointer-events: none;
            opacity: 0;
            animation: bubble-pop 0.9s ease forwards;
            z-index: 9999;
        }

        .stars-burst {
            position: absolute;
            width: 0;
            height: 0;
            pointer-events: none;
            overflow: visible;
            z-index: 50;
        }

        .stars-burst .star {
            position: absolute;
            width: 12px;
            height: 12px;
            background: radial-gradient(circle, #fff 20%, #facc15 50%, rgba(250, 204, 21, 0) 70%);
            border-radius: 50%;
            filter: drop-shadow(0 0 12px rgba(250, 204, 21, 0.8));
            transform: translate(0, 0) scale(0.7);
            animation: star-fly 0.9s ease-out forwards;
            opacity: 0;
        }

        @keyframes bubble-pop {
            0% {
                opacity: 0;
                transform: translateX(-50%) translateY(10px) scale(0.95);
            }

            50% {
                opacity: 1;
                transform: translateX(-50%) translateY(0) scale(1);
            }

            100% {
                opacity: 0;
                transform: translateX(-50%) translateY(-10px) scale(0.95);
            }
        }

        @keyframes star-fly {
            0% {
                opacity: 1;
                transform: translate(0, 0) scale(0.4);
            }

            80% {
                opacity: 1;
            }

            100% {
                opacity: 0;
                transform: translate(var(--dx), var(--dy)) scale(0.1);
            }
        }

        .spin-slow {
            animation: spin 15s linear infinite;
        }

        /* Custom Scrollbar untuk Rak */
        #pieces-tray::-webkit-scrollbar {
            height: 14px;
        }

        #pieces-tray::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        #pieces-tray::-webkit-scrollbar-thumb {
            background: #FFD1E3;
            border-radius: 10px;
            border: 3px solid #000;
        }
    </style>
</head>

<body
    class="m-0 p-0 overflow-hidden font-sans h-screen w-screen flex flex-col selection:bg-transparent transition-transform">

    <!-- Intro Overlay -->
    <div id="intro-overlay"
        class="fixed inset-0 z-[9999] bg-[#FFFEFA] flex flex-col items-center justify-center transition-opacity duration-1000 ease-in-out">
        <div class="text-center px-6">
            <div
                class="inline-block px-6 py-2 bg-[#BEE9E8] brutal-border brutal-shadow-sm rounded-2xl text-sm font-bold mb-6 -rotate-2">
                Drag & Drop Puzzle
            </div>
            <h1
                class="text-6xl md:text-8xl font-black text-black text-outline transform -rotate-2 animate-bounce text-center drop-shadow-[0_10px_0_rgba(0,0,0,0.15)]">
                Riau Discovery
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

    <!-- Garis Penunjuk (Hint) -->
    <svg id="guide-svg">
        <line id="guide-line" x1="0" y1="0" x2="0" y2="0" stroke="black" stroke-width="6" stroke-dasharray="15,15"
            opacity="0" />
        <circle id="guide-target" cx="0" cy="0" r="20" fill="#FFF5B8" stroke="black" stroke-width="4" opacity="0"
            class="drop-shadow-lg" />
        <circle id="guide-target-inner" cx="0" cy="0" r="8" fill="black" opacity="0" />
    </svg>

    <!-- Area Peta Utama (Perbaikan Responsive) -->
    <div id="game-board" class="relative w-full h-[75vh] flex items-center justify-center z-10 px-4">
        <div id="map-container" class="relative pointer-events-none drop-shadow-[0_20px_30px_rgba(0,0,0,0.3)] mx-auto"
            style="width: min(95vw, calc(75vh * 16 / 9)); height: min(75vh, calc(95vw * 9 / 16));">
            <img src="{{ asset('images/general/map/peta_kosong_riau.png') }}" id="base-img"
                class="absolute inset-0 w-full h-full transition-opacity duration-1000" alt="Peta Kosong">
            <img src="{{ asset('images/general/map/peta_penuh_riau.png') }}" id="full-img"
                class="absolute inset-0 w-full h-full opacity-0 transition-opacity duration-1000" alt="Peta Penuh">
        </div>
    </div>

    <!-- Instruksi Awal Bermain -->
    <div id="start-instruction"
        class="absolute bottom-[28vh] left-1/2 transform -translate-x-1/2 z-[100] bg-[#FFF5B8] text-black font-bold px-6 py-3 rounded-full brutal-border brutal-shadow-sm text-base md:text-xl animate-bounce flex items-center gap-2 pointer-events-none whitespace-nowrap">
        Tarik kepingan dari rak ini!
    </div>

    <!-- Kotak Penyimpanan Kayu Mengambang (Floating Box) -> Diubah jadi rak pastel -->
    <div id="pieces-tray"
        class="absolute bottom-4 left-4 right-4 h-[22vh] bg-[#FFFEFA] brutal-border flex items-center justify-start flex-nowrap overflow-x-auto overflow-y-hidden z-20 brutal-shadow rounded-2xl md:rounded-[2rem] py-4 gap-4 md:gap-6 scroll-smooth px-2">
        <!-- Slot akan digenerate -->
    </div>

    <div id="win-modal"
        class="hidden fixed inset-0 bg-[#BEE9E8]/90 z-[120] flex-col items-center justify-center text-center p-6 backdrop-blur-md">

        <div
            class="modal-animate flex flex-col items-center relative z-10 bg-[#FFFEFA] brutal-border brutal-shadow p-10 rounded-[3rem] transform -rotate-1">

            <div class="text-6xl mb-4 animate-bounce">🎉</div>
            <h1
                class="text-6xl md:text-8xl font-black text-black text-outline mb-3 tracking-tighter transform rotate-1">
                HORE!
            </h1>
            <p id="result-message"
                class="text-xl md:text-2xl font-bold text-slate-600 mb-4 bg-[#FFF5B8] brutal-border brutal-shadow-sm px-6 py-3 rounded-2xl">
                Kamu Pintar Sekali!
            </p>

            <div class="mt-2 flex flex-col md:flex-row gap-4 w-full md:w-auto justify-center">
                <button onclick="window.location.reload()"
                    class="w-full md:w-auto bg-[#FFF5B8] text-black px-10 py-4 rounded-3xl text-xl font-bold brutal-border brutal-shadow-sm brutal-hover">
                    Ulangi
                </button>
                <button onclick="window.location.href='{{ route('general.index') }}'"
                    class="w-full md:w-auto bg-[#FFB3B3] text-black px-10 py-4 rounded-3xl text-xl font-bold brutal-border brutal-shadow-sm brutal-hover">
                    Keluar
                </button>
            </div>
        </div>
    </div>

    <script>
        // =========================================================
        // DATA KABUPATEN & KOORDINAT TARGET
        // =========================================================
        // CARA DEBUG MANUAL:
        // 1. Buka Inspect Element -> tab Console di browser.
        // 2. Tarik kepingan dari bawah ke posisi yang benar secara visual di peta kosong, lalu lepas.
        // 3. Kepingan akan kembali ke bawah, TAPI di Console akan muncul pesan berwarna kuning:
        //    "[KALIBRASI] Siak -> targetX: 45.2, targetY: 60.1"
        // 4. Salin angka targetX dan targetY tersebut, lalu ubah di baris kode di bawah ini!
        const piecesData = [
            { id: 'rokan_hilir', name: 'Rokan Hilir', src: 'potongan_rokan_hilir.png', targetX: 34.4, targetY: 19.9, labelX: 32.4, labelY: 35.9 },
            // Kepingan dumai ditarik ke atas (dikurangi targetY-nya)
            { id: 'dumai', name: 'Dumai', src: 'potongan_dumai.png', targetX: 43.9, targetY: 20.8, labelX: 44.0, labelY: 52.1 },
            { id: 'bengkalis', name: 'Bengkalis', src: 'potongan_bengkalis.png', targetX: 48.2, targetY: 28.5, labelX: 48.2, labelY: 55.5 },
            { id: 'rokan_hulu', name: 'Rokan Hulu', src: 'potongan_rokan_hulu.png', targetX: 31.0, targetY: 46.0, labelX: 31.0, labelY: 46.0 },
            { id: 'kepulauan_meranti', name: 'Kepulauan Meranti', src: 'potongan_kepulauan_meranti.png', targetX: 62.1, targetY: 39.3, labelX: 62.1, labelY: 39.3 },
            { id: 'siak', name: 'Siak', src: 'potongan_siak.png', targetX: 52.2, targetY: 46.4, labelX: 52.2, labelY: 46.4 },
            { id: 'kampar', name: 'Kampar', src: 'potongan_kampar.png', targetX: 39.3, targetY: 57.9, labelX: 40.3, labelY: 57.9 },
            { id: 'pekanbaru', name: 'Pekanbaru', src: 'potongan_pekanbaru.png', targetX: 44.7, targetY: 52.3, labelX: 48.7, labelY: 52.3 },
            { id: 'pelalawan', name: 'Pelalawan', src: 'potongan_pelalawan.png', targetX: 58.2, targetY: 62.6, labelX: 50.2, labelY: 55.0 },
            { id: 'kuantan_singingi', name: 'Kuantan Singingi', src: 'potongan_kuantan_singingi.png', targetX: 44.6, targetY: 78.6, labelX: 40, labelY: 60 },
            { id: 'indragiri_hulu', name: 'Indragiri Hulu', src: 'potongan_indragili_hulu.png', targetX: 56.6, targetY: 78.6, labelX: 54.0, labelY: 72.0 },
            { id: 'indragiri_hilir', name: 'Indragiri Hilir', src: 'potongan_indragili_hilir.png', targetX: 70.0, targetY: 73.7, labelX: 65, labelY: 65.0 }
        ];

        let lockedCount = 0;
        const totalPieces = piecesData.length;
        const piecesTray = document.getElementById('pieces-tray');
        const mapContainer = document.getElementById('map-container');
        const mapImg = document.getElementById('base-img');

        const guideLine = document.getElementById('guide-line');
        const guideTarget = document.getElementById('guide-target');
        const guideTargetInner = document.getElementById('guide-target-inner');

        let activePiece = null;
        let initialX, initialY, startLeft, startTop;
        let startTime = null;
        let timerInterval = null;

        function formatTime(seconds) {
            const min = String(Math.floor(seconds / 60)).padStart(2, '0');
            const sec = String(seconds % 60).padStart(2, '0');
            return `${min}:${sec}`;
        }

        function updateTime() {
            if (!startTime) return;
            const elapsed = Math.floor((Date.now() - startTime) / 1000);
            document.getElementById('timer-display').innerText = formatTime(elapsed);
        }

        function startTimer() {
            if (startTime) return;
            startTime = Date.now();
            updateTime();
            timerInterval = setInterval(updateTime, 1000);
        }

        function stopTimer() {
            if (!startTime) return 0;
            clearInterval(timerInterval);
            timerInterval = null;
            const elapsed = Math.floor((Date.now() - startTime) / 1000);
            startTime = null;
            return elapsed;
        }

        function getStarRating(seconds) {
            if (seconds <= 60) return 3;
            if (seconds <= 110) return 2;
            return 1;
        }

        function shuffle(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
        }
        shuffle(piecesData);

        // Spacer kiri agar scroll tidak menabrak batas kotak
        const startSpacer = document.createElement('div');
        startSpacer.className = 'flex-shrink-0 w-2 md:w-4';
        piecesTray.appendChild(startSpacer);

        piecesData.forEach(data => {
            const slot = document.createElement('div');
            slot.className = 'tray-slot flex items-center justify-center';
            slot.id = 'slot-' + data.id;

            const img = new Image();
            img.src = `{{ asset('images/general/map') }}/${data.src}`;
            img.className = 'puzzle-piece drop-shadow-md w-full h-auto';
            img.id = data.id;
            img.dataset.name = data.name;
            img.dataset.labelX = data.labelX;
            img.dataset.labelY = data.labelY;
            img.dataset.targetX = data.targetX;
            img.dataset.targetY = data.targetY;
            img.dataset.slotId = slot.id;
            img.draggable = false;

            img.addEventListener('mousedown', handleStart, { passive: false });
            img.addEventListener('touchstart', handleStart, { passive: false });

            slot.appendChild(img);
            piecesTray.appendChild(slot);
        });

        // Spacer kanan agar scroll mentok dengan indah
        const endSpacer = document.createElement('div');
        endSpacer.className = 'flex-shrink-0 w-2 md:w-4';
        piecesTray.appendChild(endSpacer);

        document.addEventListener('mousemove', handleMove, { passive: false });
        document.addEventListener('touchmove', handleMove, { passive: false });

        document.addEventListener('mouseup', handleEnd);
        document.addEventListener('touchend', handleEnd);

        function handleStart(e) {
            if (e.type === 'mousedown' && e.button !== 0) return;
            e.preventDefault();

            activePiece = e.target;
            if (activePiece.classList.contains('piece-label')) {
                activePiece = document.getElementById(activePiece.dataset.for);
            }
            if (!activePiece || !activePiece.classList.contains('puzzle-piece')) {
                activePiece = null;
                return;
            }

            const clientX = e.clientX || (e.touches && e.touches[0].clientX);
            const clientY = e.clientY || (e.touches && e.touches[0].clientY);

            const pieceRect = activePiece.getBoundingClientRect();

            const offsetX = clientX - pieceRect.left;
            const offsetY = clientY - pieceRect.top;

            const clickPctX = offsetX / pieceRect.width;
            const clickPctY = offsetY / pieceRect.height;

            if (activePiece.classList.contains('locked')) {
                activePiece.classList.remove('locked');
                lockedCount--;
                const oldLabel = document.getElementById('label-' + activePiece.id);
                if (oldLabel) oldLabel.remove();
                document.body.appendChild(activePiece);
            }
            else if (activePiece.parentElement.classList.contains('tray-slot')) {
                document.body.appendChild(activePiece);
                startTimer();

                // Sembunyikan instruksi saat kepingan pertama diambil
                const instr = document.getElementById('start-instruction');
                if (instr) instr.style.display = 'none';

                if (mapImg.naturalWidth && mapImg.getBoundingClientRect().width > 0) {
                    const displayedMapWidth = mapImg.getBoundingClientRect().width;
                    const mapScale = displayedMapWidth / mapImg.naturalWidth;

                    const newWidth = activePiece.naturalWidth * mapScale;
                    activePiece.style.width = newWidth + 'px';

                    const ratio = activePiece.naturalHeight / activePiece.naturalWidth;
                    const newHeight = newWidth * ratio;

                    activePiece.style.left = (clientX - (clickPctX * newWidth)) + 'px';
                    activePiece.style.top = (clientY - (clickPctY * newHeight)) + 'px';
                } else {
                    activePiece.style.left = (clientX - (pieceRect.width / 2)) + 'px';
                    activePiece.style.top = (clientY - (pieceRect.height / 2)) + 'px';
                }
            }

            activePiece.classList.add('dragging');

            initialX = clientX;
            initialY = clientY;
            startLeft = parseFloat(activePiece.style.left) || 0;
            startTop = parseFloat(activePiece.style.top) || 0;

            const newRect = activePiece.getBoundingClientRect();
            updateGuideLine(newRect.left + newRect.width / 2, newRect.top + newRect.height / 2);
        }

        function handleMove(e) {
            if (!activePiece) return;
            e.preventDefault();

            const clientX = e.clientX || (e.touches && e.touches[0].clientX);
            const clientY = e.clientY || (e.touches && e.touches[0].clientY);

            const dx = clientX - initialX;
            const dy = clientY - initialY;
            activePiece.style.left = (startLeft + dx) + 'px';
            activePiece.style.top = (startTop + dy) + 'px';

            const pieceRect = activePiece.getBoundingClientRect();
            updateGuideLine(pieceRect.left + pieceRect.width / 2, pieceRect.top + pieceRect.height / 2);
        }

        function updateGuideLine(centerX, centerY) {
            if (!activePiece) return;
            const mapRect = mapContainer.getBoundingClientRect();

            const targetX = parseFloat(activePiece.dataset.targetX);
            const targetY = parseFloat(activePiece.dataset.targetY);

            const targetPxX = mapRect.left + (mapRect.width * (targetX / 100));
            const targetPxY = mapRect.top + (mapRect.height * (targetY / 100));

            // FITUR DEBUGGING: Garis penolong dinonaktifkan karena koordinat sudah pas
            /*
            guideLine.setAttribute('x1', centerX);
            guideLine.setAttribute('y1', centerY);
            guideLine.setAttribute('x2', targetPxX);
            guideLine.setAttribute('y2', targetPxY);
            guideLine.setAttribute('opacity', '0.8');

            guideTarget.setAttribute('cx', targetPxX);
            guideTarget.setAttribute('cy', targetPxY);
            guideTargetInner.setAttribute('cx', targetPxX);
            guideTargetInner.setAttribute('cy', targetPxY);
            guideTarget.setAttribute('opacity', '1');
            guideTargetInner.setAttribute('opacity', '1');

            // UPDATE DEBUGGER DI LAYAR
            const pctDropX = ((centerX - mapRect.left) / mapRect.width) * 100;
            const pctDropY = ((centerY - mapRect.top) / mapRect.height) * 100;

            document.getElementById('debug-x').innerText = pctDropX.toFixed(1);
            document.getElementById('debug-y').innerText = pctDropY.toFixed(1);
            */
        }

        function handleEnd(e) {
            if (!activePiece) return;

            // guideLine.setAttribute('opacity', '0');
            // guideTarget.setAttribute('opacity', '0');
            // guideTargetInner.setAttribute('opacity', '0');

            const mapRect = mapContainer.getBoundingClientRect();
            const pieceRect = activePiece.getBoundingClientRect();

            const centerX = pieceRect.left + (pieceRect.width / 2);
            const centerY = pieceRect.top + (pieceRect.height / 2);

            const targetX = parseFloat(activePiece.dataset.targetX);
            const targetY = parseFloat(activePiece.dataset.targetY);

            const targetPxX = mapRect.left + (mapRect.width * (targetX / 100));
            const targetPxY = mapRect.top + (mapRect.height * (targetY / 100));

            const distance = Math.hypot(targetPxX - centerX, targetPxY - centerY);

            const threshold = mapRect.width * 0.10; // Jarak toleransi nempel

            // FITUR DEBUGGING MANUAL: Disembunyikan karena sudah selesai kalibrasi
            /*
            const pctDropX = ((centerX - mapRect.left) / mapRect.width) * 100;
            const pctDropY = ((centerY - mapRect.top) / mapRect.height) * 100;
            console.log(`%c[KALIBRASI] %c${activePiece.dataset.name}`, 'color: yellow; font-size: 16px; font-weight: bold;', 'color: cyan; font-size: 16px; font-weight: bold;');
            console.log(`%c-> Ganti kode menjadi: targetX: ${pctDropX.toFixed(1)}, targetY: ${pctDropY.toFixed(1)}`, 'color: white; font-size: 14px;');
            */

            if (distance < threshold) {
                lockPiece(activePiece, targetX, targetY);
            } else {
                returnPieceToSlot(activePiece);
                showWrongBubble();
            }

            activePiece = null;
        }

        function returnPieceToSlot(piece) {
            piece.classList.remove('dragging');
            piece.classList.add('wrong-drop');
            piece.style.left = '0';
            piece.style.top = '0';
            piece.style.width = '100%';
            piece.style.transform = '';
            const slot = document.getElementById(piece.dataset.slotId);
            slot.appendChild(piece);
            setTimeout(() => piece.classList.remove('wrong-drop'), 700);

            // Layar bergetar (screen shake)
            document.body.classList.add('screen-shake');
            setTimeout(() => document.body.classList.remove('screen-shake'), 400);
        }

        function showWrongBubble() {
            const bubble = document.createElement('div');
            bubble.className = 'wrong-bubble';
            bubble.innerText = 'Oops, coba lagi ya 😊';
            mapContainer.appendChild(bubble);
            setTimeout(() => bubble.remove(), 1000);
        }

        function lockPiece(piece, targetX, targetY) {
            piece.classList.remove('dragging');
            piece.classList.add('locked');

            const mapContainer = document.getElementById('map-container');
            mapContainer.appendChild(piece);

            // Sembunyikan slot penyimpanannya karena sudah diletakkan
            const slot = document.getElementById(piece.dataset.slotId);
            if (slot) {
                slot.style.display = 'none';
            }

            // Perbaikan Responsive Absolut: 
            // Karena ukuran gambar adalah 800x800 dan peta adalah 1920x1080
            const piecePctW = (800 / 1920) * 100; // Lebar gambar 41.66%
            const piecePctH = (800 / 1080) * 100; // Tinggi gambar 74.07%

            piece.style.width = `${piecePctW}%`;

            // Atur posisi secara persen agar otomatis ikut bergeser jika layar di-resize
            piece.style.left = `${targetX}%`;
            piece.style.top = `${targetY}%`;
            piece.style.transform = 'translate(-50%, -50%)';

            const label = document.createElement('div');
            // Label diganti menjadi warna putih bersih dengan garis biru agar lebih netral & elegan
            label.className = 'piece-label absolute font-black text-sky-700 bg-white px-3 py-1.5 rounded-full shadow-[0_4px_0_#0284c7] border-2 md:border-4 border-sky-400 text-[11px] md:text-sm lg:text-base cursor-pointer z-[60] text-center uppercase tracking-widest';
            label.innerText = piece.dataset.name;
            label.id = 'label-' + piece.id;
            label.dataset.for = piece.id;

            const labelX = parseFloat(piece.dataset.labelX);
            const labelY = parseFloat(piece.dataset.labelY);

            // Posisi label juga dalam persentase relatif terhadap container map
            const labelPctLeft = targetX - (piecePctW / 2) + (piecePctW * (labelX / 100));
            const labelPctTop = targetY - (piecePctH / 2) + (piecePctH * (labelY / 100));

            label.style.left = `${labelPctLeft}%`;
            label.style.top = `${labelPctTop}%`;
            label.style.transform = 'translate(-50%, -50%)';

            setTimeout(() => { mapContainer.appendChild(label); }, 300);
            showStarsEffect(targetX, targetY);

            lockedCount++;
            if (lockedCount === totalPieces) {
                setTimeout(winGame, 1500);
            }
        }

        function showStarsEffect(targetX, targetY) {
            const effect = document.createElement('div');
            effect.className = 'stars-burst';
            effect.style.left = `${targetX}%`;
            effect.style.top = `${targetY}%`;

            const starCount = 14;
            for (let i = 0; i < starCount; i++) {
                const star = document.createElement('span');
                star.className = 'star';
                const dx = Math.random() * 160 - 80;
                const dy = -(Math.random() * 160 + 20);
                const size = 8 + Math.random() * 8;
                star.style.width = `${size}px`;
                star.style.height = `${size}px`;
                star.style.setProperty('--dx', `${dx}px`);
                star.style.setProperty('--dy', `${dy}px`);
                star.style.left = '0';
                star.style.top = '0';
                effect.appendChild(star);
            }

            mapContainer.appendChild(effect);
            setTimeout(() => effect.remove(), 1100);
        }

        function winGame() {
            const totalSeconds = stopTimer();
            const stars = getStarRating(totalSeconds);
            document.getElementById('timer-result').innerText = formatTime(totalSeconds);
            document.getElementById('star-result').innerText = '★'.repeat(stars) + '☆'.repeat(3 - stars);
            document.getElementById('result-message').innerText = stars === 3
                ? 'Wah hebat! Kamu cepat sekali menyelesaikannya!'
                : stars === 2
                    ? 'Bagus! Terus latihan biar makin cepat.'
                    : 'Keren! Ayo coba sekali lagi untuk dapat 3 bintang.';

            const baseImg = document.getElementById('base-img');
            const fullImg = document.getElementById('full-img');
            baseImg.style.opacity = 0;
            fullImg.style.opacity = 1;

            document.querySelectorAll('.locked, .piece-label').forEach(p => {
                p.style.transition = 'opacity 1s ease';
                p.style.opacity = 0;
            });

            setTimeout(() => {
                const modal = document.getElementById('win-modal');
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }, 1200);
        }

        // Jalankan Intro Overlay saat halaman dimuat
        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                const overlay = document.getElementById('intro-overlay');
                if (overlay) {
                    overlay.style.opacity = '0';
                    setTimeout(() => {
                        overlay.remove();
                    }, 1000); // Tunggu sampai transisi memudar selesai
                }
            }, 2500); // Tampil selama 2.5 detik
        });
    </script>
</body>

</html>