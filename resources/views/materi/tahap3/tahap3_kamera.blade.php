<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <title>HonuSign - Ejaan Kamera SIBI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;600;700;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Fredoka', sans-serif;
            background-color: #FFF9F0 !important; /* Soft Cream */
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

        @keyframes scan {
            0% {
                top: 0;
            }

            100% {
                top: 100%;
            }
        }

        .animate-scan {
            animation: scan 3s linear infinite;
        }

        /* Letter twitching animation for detected character */
        @keyframes twitch {
            0% {
                transform: scale(1) rotate(0deg);
            }
            25% {
                transform: scale(1.15) rotate(3deg);
            }
            50% {
                transform: scale(0.95) rotate(-3deg);
            }
            75% {
                transform: scale(1.1) rotate(1.5deg);
            }
            100% {
                transform: scale(1) rotate(0deg);
            }
        }

        .animate-twitch {
            animation: twitch 1.2s ease-in-out infinite;
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


    <!-- Title Header -->
    <div class="pt-16 md:pt-20 px-4 flex flex-col items-center max-w-7xl mx-auto">
        <div class="flex items-center gap-4 mb-2">
            <span class="text-xl font-black text-black bg-[#BEE9E8] brutal-border px-4 py-1 rounded-2xl transform rotate-2 shadow-sm">Soal {{ $soal_ke }} dari 5</span>
        </div>
        <h1
            class="mb-4 bg-[#FFF5B8] brutal-border brutal-shadow-sm px-8 py-3 rounded-2xl text-2xl md:text-3xl font-black uppercase tracking-widest text-center transform -rotate-1 min-w-[220px] shadow-sm">
            Ejaan Kamera SIBI
        </h1>
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
                Ejaan Kamera SIBI
            </h2>

            <!-- Animasi Webcam Alignment & Signing -->
            <div class="relative w-64 h-64 bg-slate-900 brutal-border rounded-3xl p-4 flex flex-col items-center justify-center mb-8 mx-auto overflow-hidden shadow-inner">
                <!-- Outer camera frame -->
                <div class="absolute inset-4 border-2 border-dashed border-slate-500 rounded-2xl flex flex-col items-center justify-center">
                    <span class="text-6xl animate-pulse opacity-40">👤</span>
                    <span class="text-5xl animate-bounce mt-2">🖐️</span>
                </div>
                <!-- Scanning line -->
                <div class="absolute w-full h-1 bg-[#BEE9E8] top-0 animate-scan left-0"></div>
                <!-- Status badge in overlay animation -->
                <div class="absolute bottom-6 bg-green-500 text-black px-3 py-1 rounded-full text-[10px] font-black brutal-border shadow-sm flex items-center gap-1 animate-pulse">
                    <span>Posisi Benar</span>
                    <span>✓</span>
                </div>
            </div>

            <!-- Steps text -->
            <div class="flex flex-col gap-4 text-left w-full bg-[#F8FAFC] brutal-border p-6 rounded-2xl mb-8 shadow-sm">
                <div class="flex items-start gap-3">
                    <span class="bg-[#FFF5B8] w-8 h-8 rounded-xl brutal-border flex items-center justify-center font-black text-black text-sm shrink-0 mt-0.5">1</span>
                    <p class="font-bold text-slate-700 text-sm md:text-base"><b>Posisikan Diri</b>: Pastikan wajah dan tangan kamu terlihat jelas di dalam kotak kamera.</p>
                </div>
                <div class="flex items-start gap-3">
                    <span class="bg-[#D4F1BE] w-8 h-8 rounded-xl brutal-border flex items-center justify-center font-black text-black text-sm shrink-0 mt-0.5">2</span>
                    <p class="font-bold text-slate-700 text-sm md:text-base"><b>Eja Kata</b>: Peragakan isyarat tangan satu per satu untuk mengeja kata jawaban.</p>
                </div>
            </div>

            <!-- Confirm Button (Visual Icon Ok / Checklist) -->
            <button onclick="closeTutorial()"
                class="w-20 h-20 bg-[#D4F1BE] text-black rounded-full brutal-border brutal-shadow-sm brutal-hover flex items-center justify-center cursor-pointer animate-pulse"
                title="Mengerti">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10">
                    <circle cx="12" cy="12" r="10" opacity="0.2" />
                    <path d="M10 15.172l-3.5-3.5-1.414 1.414 4.914 4.914 9.9-9.9-1.414-1.414z" fill="currentColor" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Question Card (Full Width - Top) -->
    <div class="w-full max-w-6xl mx-auto px-4 md:px-8 mb-6">
        <div class="bg-[#FFFEFA] brutal-border brutal-shadow rounded-[2rem] p-6 text-center md:text-left">
            <span class="inline-block px-4 py-1.5 bg-[#FFF5B8] brutal-border brutal-shadow-sm rounded-xl text-xs font-black uppercase tracking-wider mb-3">Pertanyaan Cerita</span>
            <h2 class="text-2xl md:text-3xl font-black text-black leading-snug">
                {!! nl2br(e($quiz->pertanyaan)) !!}
            </h2>
        </div>
    </div>

    <!-- Main Game Section (Webcam + Progress side-by-side) -->
    <div class="pb-8 px-4 md:px-8 flex flex-col md:flex-row items-center md:items-stretch justify-center gap-6 md:gap-8 max-w-6xl w-full mx-auto">
        
        <!-- Left: Webcam Container (occupies 50vh viewport height) -->
        <div class="w-full md:w-2/3 relative bg-black brutal-border brutal-shadow rounded-[2.5rem] h-[50vh] min-h-[320px] max-h-[480px] overflow-hidden">
            <!-- Video feed -->
            <video id="webcam" autoplay playsinline muted
                class="w-full h-full object-cover block">
            </video>

            <!-- Scanning overlay line -->
            <div id="scanner-line"
                class="absolute inset-0 border-4 border-[#BEE9E8]/70 rounded-[2.3rem] pointer-events-none">
                <div class="w-full h-1 bg-[#BEE9E8] absolute top-0 animate-scan"></div>
            </div>

            <!-- AI Detected Letter Card (Positioned top-right, twitches/pulses continuously) -->
            <div id="ai-detected-char" class="absolute top-6 right-6 bg-[#FFD1E3] brutal-border brutal-shadow-sm rounded-2xl p-4 flex items-center justify-center min-w-[80px] min-h-[80px] z-50 animate-twitch">
                <span id="detected-char-text" class="text-5xl font-black text-black uppercase">-</span>
            </div>

            <!-- Status panel overlay -->
            <div id="ai-status"
                class="absolute bottom-4 left-1/2 -translate-x-1/2 bg-black/70 backdrop-blur-md text-white px-5 py-3 rounded-full text-sm font-bold flex items-center gap-3 whitespace-nowrap">
                <span id="status-ping" class="w-3 h-3 bg-yellow-400 rounded-full animate-ping"></span>
                <span id="status-text">Mengunduh Sistem AI...</span>
            </div>
        </div>

        <!-- Right: Spelling Progress Card (placed next to camera) -->
        <div class="w-full md:w-1/3 flex flex-col justify-center items-center text-center bg-[#E0BBE4] brutal-border brutal-shadow rounded-[2.5rem] p-8">
            <span class="inline-block px-4 py-1.5 bg-white brutal-border brutal-shadow-sm rounded-xl text-xs font-black uppercase tracking-wider mb-4">Progres Ejaan</span>
            <p class="font-black text-slate-800 uppercase tracking-widest text-sm mb-4">Kata yang Dieja:</p>
            <h1 id="word-progress" class="text-5xl font-black text-black uppercase tracking-widest mb-4">
                -
            </h1>
            <p id="word-target-hint" class="text-sm text-slate-700 font-bold">Total: {{ strlen($quiz->jawaban_benar) }} Huruf</p>
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
                <button onclick="window.location.reload()" aria-label="Ulangi"
                    class="bg-[#FFF5B8] text-black w-[18%] aspect-square rounded-2xl brutal-border brutal-shadow-sm brutal-hover flex items-center justify-center cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        class="w-1/2 h-1/2 text-black fill-none stroke-current" stroke-width="3.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21.5 2v6h-6M21.34 15.57a10 10 0 1 1-.57-8.38l.57-1.19" />
                    </svg>
                </button>
                <!-- Next Button -->
                <a href="{{ route('materi.belajar', ['step' => 3, 'soal_ke' => $soal_ke + 1]) }}" aria-label="Lanjut"
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

    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs-tflite@0.0.1-alpha.10/dist/tf-tflite.min.js"></script>

    <script type="module">
        function tunjukkanErrorKeUser(pesan, detailErr) {
            console.error(`❌ ${pesan}`, detailErr);
            const statusText = document.getElementById('status-text');
            const statusPing = document.getElementById('status-ping');
            statusText.textContent = `ERROR: ${pesan}`;
            statusPing.style.background = 'red';
        }

        try {
            tflite.setWasmPath('/models/');
        } catch (e) {
            tunjukkanErrorKeUser("Gagal setWasmPath TFLite", e);
        }

        import {
            HandLandmarker,
            FilesetResolver
        } from "https://esm.sh/@mediapipe/tasks-vision@0.10.14";

        const MODEL_TFLITE_PATH = '/models/honusign_model.tflite';
        const MEDIAPIPE_TASK_PATH =
            "https://storage.googleapis.com/mediapipe-models/hand_landmarker/hand_landmarker/float16/latest/hand_landmarker.task";

        const TARGET_WORD = "{{ $quiz->jawaban_benar }}".toUpperCase().trim();
        const ALPHABET_MAP = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T',
            'U', 'V', 'W', 'X', 'Y'
        ];

        const video = document.getElementById('webcam');
        const statusText = document.getElementById('status-text');
        const statusPing = document.getElementById('status-ping');
        const progressDisplay = document.getElementById('word-progress');
        const hintDisplay = document.getElementById('word-target-hint');

        let handLandmarker;
        let tfliteModel;
        let isMisiSelesai = false;
        let frameCounter = 0;

        let currentLetterIdx = 0;
        let akumulasiJawaban = "";

        function updateProgressUI() {
            let htmlOutput = "";
            for (let i = 0; i < TARGET_WORD.length; i++) {
                if (i < currentLetterIdx) {
                    htmlOutput += `<span class="text-green-600 dark:text-green-400 font-black">${TARGET_WORD[i]}</span> `;
                } else if (i === currentLetterIdx) {
                    htmlOutput +=
                        `<span class="text-purple-600 dark:text-purple-400 font-black underline animate-pulse active-slot">[${TARGET_WORD[i]}]</span> `;
                } else {
                    htmlOutput += `<span class="text-slate-300 dark:text-slate-600 font-bold">_</span> `;
                }
            }
            progressDisplay.innerHTML = htmlOutput;
            hintDisplay.textContent = `Total: ${TARGET_WORD.length} Huruf`;
        }

        // Flying letter animation
        function animateFlyingLetter(letter) {
            const startEl = document.getElementById('ai-detected-char');
            const endEl = document.querySelector('#word-progress .active-slot') || document.getElementById('word-progress');

            if (!startEl || !endEl) return;

            const startRect = startEl.getBoundingClientRect();
            const endRect = endEl.getBoundingClientRect();

            // Create flyer node
            const flyer = document.createElement('div');
            flyer.innerText = letter;
            flyer.className = "fixed z-[9999] bg-[#FFD1E3] brutal-border brutal-shadow-sm rounded-xl font-black text-3xl text-black flex items-center justify-center w-14 h-14 pointer-events-none transition-all duration-700 ease-in-out";
            
            // Set starting position
            flyer.style.left = `${startRect.left}px`;
            flyer.style.top = `${startRect.top}px`;
            document.body.appendChild(flyer);

            // Reflow to apply initial styles
            void flyer.offsetWidth;

            // Set destination position & effect
            flyer.style.left = `${endRect.left}px`;
            flyer.style.top = `${endRect.top}px`;
            flyer.style.transform = "scale(0.6)";

            // Cleanup when transition is done
            flyer.addEventListener('transitionend', () => {
                flyer.remove();
            });
        }

        async function initEngine() {
            try {
                statusText.innerText = "Menginisialisasi Model AI...";
                updateProgressUI();

                const filesetResolver = await FilesetResolver.forVisionTasks(
                    "https://cdn.jsdelivr.net/npm/@mediapipe/tasks-vision@0.10.14/wasm"
                );

                handLandmarker = await HandLandmarker.createFromOptions(filesetResolver, {
                    baseOptions: {
                        modelAssetPath: MEDIAPIPE_TASK_PATH,
                        delegate: "CPU"
                    },
                    runningMode: "VIDEO",
                    numHands: 1,
                    minHandDetectionConfidence: 0.4,
                    minHandPresenceConfidence: 0.4,
                    minTrackingConfidence: 0.4
                });

                tfliteModel = await tflite.loadTFLiteModel(MODEL_TFLITE_PATH);

                statusText.innerText = "Menunggu Gerakan Tangan...";
                startWebcam();
            } catch (err) {
                tunjukkanErrorKeUser("Gagal inisialisasi Engine AI", err);
            }
        }

        function startWebcam() {
            if (navigator.mediaDevices.getUserMedia) {
                navigator.mediaDevices
                    .getUserMedia({
                        video: {
                            width: {
                                ideal: 640
                            },
                            height: {
                                ideal: 480
                            },
                            facingMode: "user"
                        }
                    })
                    .then(function(stream) {
                        video.srcObject = stream;

                        video.onloadedmetadata = () => {
                            console.log(`✅ Video stream siap: ${video.videoWidth}x${video.videoHeight}`);
                            statusText.textContent = "Sistem Siap!";
                            statusPing.style.background = 'green';
                            predictLoop();
                        };

                        video.play().catch(err => {
                            tunjukkanErrorKeUser("Gagal play video", err);
                        });
                    })
                    .catch(err => {
                        tunjukkanErrorKeUser("Gagal akses webcam", err);
                    });
            }
        }

        async function predictLoop() {
            if (isMisiSelesai) return;

            try {
                if (video.readyState === video.HAVE_ENOUGH_DATA) {
                    const timestampMs = performance.now();
                    const detections = handLandmarker.detectForVideo(video, timestampMs);

                    const activeLandmarks = detections.landmarks || detections.handLandmarks;

                    frameCounter++;

                    if (activeLandmarks && activeLandmarks.length > 0) {
                        const landmarks = activeLandmarks[0];
                        const normalizedFeatures = normalizeLandmarks(landmarks);

                        const inputTensor = tf.tensor2d([normalizedFeatures], [1, 63]);
                        const prediction = await tfliteModel.predict(inputTensor);
                        const predictionArray = await prediction.data();

                        const maxIdx = Array.from(predictionArray).indexOf(Math.max(...predictionArray));
                        const detectedLetter = ALPHABET_MAP[maxIdx];
                        const confidence = predictionArray[maxIdx];

                        // Update text in detected letter bubble
                        document.getElementById('detected-char-text').innerText = detectedLetter;

                        const expectedLetter = TARGET_WORD[currentLetterIdx];

                        statusText.textContent =
                            `Mengeja: ${akumulasiJawaban}[${expectedLetter}]... (AI Melihat: ${detectedLetter})`;
                        statusPing.style.background = 'purple';

                        // Match logic
                        if (detectedLetter === expectedLetter && confidence > 0.82) {
                            // Run the flying letter animation
                            animateFlyingLetter(expectedLetter);

                            // Clean up
                            inputTensor.dispose();
                            prediction.dispose();

                            // Slight delay for visual fly path appreciation before progress advances
                            setTimeout(() => {
                                akumulasiJawaban += expectedLetter;
                                currentLetterIdx++;
                                updateProgressUI();

                                if (currentLetterIdx >= TARGET_WORD.length) {
                                    triggerMisiBerhasil();
                                    return;
                                }

                                requestAnimationFrame(predictLoop);
                            }, 700);
                            return;
                        }

                        inputTensor.dispose();
                        prediction.dispose();
                    } else {
                        const expectedLetter = TARGET_WORD[currentLetterIdx];
                        statusText.textContent = `Peragakan huruf "${expectedLetter}" untuk melanjutkan kata!`;
                        statusPing.style.background = 'rgb(250, 204, 21)';
                        document.getElementById('detected-char-text').innerText = "-";
                    }
                }
            } catch (loopError) {
                console.error("❌ Crash saat loop:", loopError);
                tunjukkanErrorKeUser("Crash saat mendeteksi gerakan", loopError);
                return;
            }

            requestAnimationFrame(predictLoop);
        }

        function normalizeLandmarks(landmarks) {
            const wrist = landmarks[0];
            let centered = landmarks.map(lm => ({
                x: lm.x - wrist.x,
                y: lm.y - wrist.y,
                z: lm.z - wrist.z
            }));

            let maxDist = 0;
            centered.forEach(lm => {
                let dist = Math.sqrt(lm.x ** 2 + lm.y ** 2 + lm.z ** 2);
                if (dist > maxDist) maxDist = dist;
            });

            let flattened = [];
            centered.forEach(lm => {
                flattened.push(maxDist > 0 ? lm.x / maxDist : lm.x);
                flattened.push(maxDist > 0 ? lm.y / maxDist : lm.y);
                flattened.push(maxDist > 0 ? lm.z / maxDist : lm.z);
            });

            return flattened;
        }

        function triggerMisiBerhasil() {
            isMisiSelesai = true;
            statusText.textContent = `🎉 SUKSES! Kata "${TARGET_WORD}" Berhasil Terbaca.`;
            statusPing.style.background = 'green';
            if (document.getElementById('scanner-line')) {
                document.getElementById('scanner-line').classList.add('hidden');
            }

            saveProgress(3, 0);
            window.showSuccessModal();

            const audio = new Audio('https://www.soundjay.com/buttons/sounds/button-3.mp3');
            audio.play();
        }

        window.simulateAI = function() {
            currentLetterIdx = TARGET_WORD.length;
            akumulasiJawaban = TARGET_WORD;
            updateProgressUI();
            triggerMisiBerhasil();
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
                .then(async response => {
                    if (!response.ok) {
                        const err = await response.json();
                        console.error("Laravel Error Detail:", err);
                        throw new Error("Gagal menyimpan");
                    }
                    return response.json();
                })
                .then(data => {
                    console.log("System:", data.message);
                })
                .catch(error => {
                    console.error('Error fetch:', error);
                });
        }

        window.showSuccessModal = function() {
            const modal = document.getElementById('success-modal');
            const content = document.getElementById('success-modal-content');
            if (modal && content) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                void modal.offsetWidth;
                modal.classList.remove('opacity-0');
                content.classList.remove('scale-90');
                content.classList.add('scale-100');
            }
        }

        initEngine();
    </script>
</body>

</html>
