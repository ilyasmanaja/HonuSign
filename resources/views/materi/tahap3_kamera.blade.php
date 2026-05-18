<x-student-layout>
    <style>
        @keyframes scan {
            0% { top: 0; }
            100% { top: 100%; }
        }
        .animate-scan { animation: scan 3s linear infinite; }
    </style>

    <div class="max-w-6xl w-full px-6 py-12 flex flex-col items-center">

        <!-- Progress Bar (Tahap 3) -->
        <div class="w-full mb-8 max-w-3xl">
            <div class="flex justify-between mb-4 items-end">
                <span class="font-black text-xl tracking-widest uppercase text-black">Tahap 3: Peragakan!</span>
                <span
                    class="text-xl font-black text-black bg-[#BEE9E8] brutal-border px-4 py-1 rounded-2xl transform rotate-2 shadow-[2px_2px_0_#000]">Soal
                    {{ $soal_ke }} dari 5</span>
            </div>
            <div class="w-full h-8 bg-white brutal-border brutal-shadow-sm rounded-2xl overflow-hidden p-1">
                <div class="h-full bg-[#BEE9E8] rounded-xl transition-all duration-1000 border-r-4 border-black"
                    style="width: {{ ($soal_ke / 5) * 100 }}%"></div>
            </div>
        </div>

        <!-- Header Judul -->
        <div class="text-center mb-8">
            <h2 class="text-3xl md:text-4xl font-black text-black uppercase tracking-tighter transform -rotate-1">
                Peragakan <span class="text-[#BEE9E8] text-outline drop-shadow-[0_4px_0_#000]">Isyarat</span> Cerita!
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 w-full items-start">

            <!-- Panel Kiri: Pertanyaan + Progress -->
            <div class="flex flex-col gap-6">

                <!-- Card Pertanyaan -->
                <div class="bg-[#FFF5B8] brutal-border brutal-shadow-sm rounded-[2.5rem] p-8">
                    <p class="font-black text-black uppercase tracking-widest text-sm mb-3">Pertanyaan Cerita:</p>
                    <div class="text-slate-700 font-bold text-lg leading-relaxed whitespace-pre-line">
                        {!! nl2br(e($quiz->pertanyaan)) !!}
                    </div>
                </div>

                <!-- Card Progress Ejaan -->
                <div class="bg-[#E0BBE4] brutal-border brutal-shadow-sm rounded-[2.5rem] p-6 flex flex-col items-center justify-center text-center">
                    <p class="font-black text-black uppercase tracking-widest text-sm mb-2">Kata yang Dieja:</p>
                    <h1 id="word-progress"
                        class="text-5xl font-black text-black uppercase tracking-widest mb-2">
                        -
                    </h1>
                    <p id="word-target-hint" class="text-sm text-slate-500 font-bold"></p>
                </div>

                <!-- Input Fallback -->
                <div class="bg-[#FFFEFA] brutal-border brutal-shadow-sm rounded-2xl p-6">
                    <p class="text-xs font-bold text-slate-400 uppercase mb-3">Ketik jawaban jika kamera tidak muncul:</p>
                    <input type="text" id="manual-input" placeholder="Ketik di sini..."
                        class="w-full p-4 rounded-xl brutal-border bg-white outline-none uppercase font-bold text-lg text-slate-800">
                </div>
            </div>

            <!-- Panel Kanan: Webcam -->
            <div class="relative">
                <div class="relative bg-black brutal-border brutal-shadow rounded-[2.5rem] aspect-square overflow-hidden">
                    <video id="webcam" autoplay playsinline muted
                        style="width: 100%; height: 100%; object-fit: cover; display: block;">
                    </video>

                    <div id="scanner-line"
                        class="absolute inset-0 border-4 border-[#BEE9E8]/70 rounded-[2rem] pointer-events-none">
                        <div class="w-full h-1 bg-[#BEE9E8] absolute top-0 animate-scan"></div>
                    </div>

                    <div id="ai-status"
                        class="absolute bottom-4 left-1/2 -translate-x-1/2 bg-black/70 backdrop-blur-md text-white px-5 py-3 rounded-full text-sm font-bold flex items-center gap-3 whitespace-nowrap">
                        <span id="status-ping" class="w-3 h-3 bg-yellow-400 rounded-full animate-ping"></span>
                        <span id="status-text">Mengunduh Sistem AI...</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="mt-10 flex flex-wrap gap-4 justify-center">
            <button onclick="simulateAI()"
                class="bg-[#FFFEFA] brutal-border brutal-shadow-sm brutal-hover px-8 py-4 rounded-2xl font-bold text-sm uppercase text-slate-600">
                Bypass Isyarat (Dev Mode)
            </button>
            <a href="{{ route('materi.belajar', ['step' => 3, 'soal_ke' => $soal_ke + 1]) }}" id="btn-next"
                class="hidden bg-[#D4F1BE] brutal-border brutal-shadow brutal-hover text-black px-10 py-4 rounded-2xl font-black uppercase text-base animate-bounce">
                Lanjut Soal Berikutnya! 🚀
            </a>
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

        import { HandLandmarker, FilesetResolver } from "https://esm.sh/@mediapipe/tasks-vision@0.10.14";

        const MODEL_TFLITE_PATH = '/models/honusign_model.tflite';
        const MEDIAPIPE_TASK_PATH = "https://storage.googleapis.com/mediapipe-models/hand_landmarker/hand_landmarker/float16/latest/hand_landmarker.task";

        // KUNCI UTAMA: Ambil target kata utuh dari database seeder (Contoh: "ADI" atau "SAMSUL")
        const TARGET_WORD = "{{ $quiz->jawaban_benar }}".toUpperCase().trim();
        const ALPHABET_MAP = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y'];

        const video = document.getElementById('webcam');
        const statusText = document.getElementById('status-text');
        const statusPing = document.getElementById('status-ping');
        const progressDisplay = document.getElementById('word-progress');
        const hintDisplay = document.getElementById('word-target-hint');
        const btnNext = document.getElementById('btn-next');

        let handLandmarker;
        let tfliteModel;
        let isMisiSelesai = false;
        let lastVideoTime = -1;
        let frameCounter = 0;

        // STATE LOGIKA MENGEJA KATA
        let currentLetterIdx = 0;
        let akumulasiJawaban = "";

        // Fungsi pembantu untuk merender tampilan ejaan di layar (Contoh hasil: A D _ )
        function updateProgressUI() {
            let htmlOutput = "";
            for (let i = 0; i < TARGET_WORD.length; i++) {
                if (i < currentLetterIdx) {
                    // Huruf yang sudah sukses diisi (Warna Hijau)
                    htmlOutput += `<span class="text-green-600 dark:text-green-400 font-black">${TARGET_WORD[i]}</span> `;
                } else if (i === currentLetterIdx) {
                    // Huruf aktif yang sedang ditargetkan oleh AI saat ini (Warna Ungu Kedip)
                    htmlOutput += `<span class="text-purple-600 dark:text-purple-400 font-black underline animate-pulse">[${TARGET_WORD[i]}]</span> `;
                } else {
                    // Huruf yang belum terbuka (Warna Abu-abu / Underscore)
                    htmlOutput += `<span class="text-slate-300 dark:text-slate-600 font-bold">_</span> `;
                }
            }
            progressDisplay.innerHTML = htmlOutput;
            hintDisplay.textContent = `Total: ${TARGET_WORD.length} Huruf`;
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
                            width: { ideal: 640 },
                            height: { ideal: 480 },
                            facingMode: "user"
                        }
                    })
                    .then(function (stream) {
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
                    if (frameCounter % 30 === 0) {
                        console.log(`[FRAME ${frameCounter}] Tangan terdeteksi: ${activeLandmarks?.length || 0}`);
                    }

                    if (activeLandmarks && activeLandmarks.length > 0) {
                        const landmarks = activeLandmarks[0];
                        const normalizedFeatures = normalizeLandmarks(landmarks);

                        const inputTensor = tf.tensor2d([normalizedFeatures], [1, 63]);
                        const prediction = await tfliteModel.predict(inputTensor);
                        const predictionArray = await prediction.data();

                        const maxIdx = Array.from(predictionArray).indexOf(Math.max(...predictionArray));
                        const detectedLetter = ALPHABET_MAP[maxIdx];
                        const confidence = predictionArray[maxIdx];

                        // Dapatkan huruf target ke-N yang dicari saat ini
                        const expectedLetter = TARGET_WORD[currentLetterIdx];

                        statusText.textContent = `Mengeja: ${akumulasiJawaban}[${expectedLetter}]... (AI Melihat: ${detectedLetter})`;
                        statusPing.style.background = 'purple';

                        // LOGIKA VALIDASI: COCOKKAN HASIL TEBAKAN DENGAN TARGET HURUF AKTIF
                        if (detectedLetter === expectedLetter && confidence > 0.82) {
                            akumulasiJawaban += expectedLetter;
                            currentLetterIdx++; // Naikkan indeks untuk mengejar huruf selanjutnya

                            updateProgressUI();
                            console.log(`✅ Huruf '${expectedLetter}' Benar!`);

                            // Bersihkan memori tensor saat ini
                            inputTensor.dispose();
                            prediction.dispose();

                            // CEK APAKAH SELURUH KATA UTUH SUDAH BERHASIL DIEJA
                            if (currentLetterIdx >= TARGET_WORD.length) {
                                triggerMisiBerhasil();
                                return;
                            }

                            // INTERCEPT DEBOUNCE TIMER: Berikan jeda 1.5 detik agar user bisa mengganti bentuk isyarat jarinya
                            setTimeout(() => {
                                requestAnimationFrame(predictLoop);
                            }, 1500);
                            return;
                        }

                        inputTensor.dispose();
                        prediction.dispose();
                    } else {
                        const expectedLetter = TARGET_WORD[currentLetterIdx];
                        statusText.textContent = `Peragakan huruf "${expectedLetter}" untuk melanjutkan kata!`;
                        statusPing.style.background = 'rgb(250, 204, 21)';
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
            document.getElementById('scanner-line').classList.add('hidden');
            btnNext.classList.remove('hidden');

            const audio = new Audio('https://www.soundjay.com/buttons/sounds/button-3.mp3');
            audio.play();
        }

        window.simulateAI = function () {
            currentLetterIdx = TARGET_WORD.length;
            akumulasiJawaban = TARGET_WORD;
            updateProgressUI();
            triggerMisiBerhasil();
        }

        initEngine();
    </script>

    <style>
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
    </style>
</x-student-layout>