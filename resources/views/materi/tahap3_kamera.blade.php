<x-student-layout>
    <div class="max-w-6xl w-full px-6 py-12 flex flex-col items-center">
        <h2 class="text-2xl font-black text-blue-600 uppercase mb-6 text-center">
            Misi dari 5: Peragakan Isyarat Cerita!
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 w-full items-start">

            <div class="flex flex-col gap-6">
                <div class="bg-white dark:bg-slate-900 border-4 border-slate-200 p-8 rounded-[3rem] shadow-lg">
                    <p class="text-slate-500 font-bold uppercase text-xs mb-2">Pertanyaan Cerita:</p>
                    <div
                        class="text-slate-700 dark:text-slate-200 font-medium text-base leading-relaxed whitespace-pre-line">
                        {!! nl2br(e($quiz->pertanyaan)) !!}
                    </div>
                </div>

                <div
                    class="bg-purple-50 dark:bg-purple-950/30 border-4 border-purple-200 p-6 rounded-[2.5rem] shadow-md flex flex-col items-center justify-center text-center">
                    <p class="text-purple-500 font-bold uppercase text-xs mb-2">Progress Ejaan Kamu:</p>
                    <h1 id="word-progress"
                        class="text-5xl font-black text-purple-700 dark:text-purple-400 uppercase tracking-widest mb-2">
                        -
                    </h1>
                    <p id="word-target-hint" class="text-xs text-slate-400 font-semibold"></p>
                </div>

                {{-- Input Teks Fallback (Jika kamera bermasalah / Dev Mode) --}}
                <div
                    class="bg-slate-100 dark:bg-slate-800/50 p-6 rounded-3xl border-2 border-dashed border-slate-300 dark:border-slate-700">
                    <p class="text-xs font-bold text-slate-400 uppercase mb-3">Ketikan jawaban jika kamera tidak muncul:
                    </p>
                    <input type="text" id="manual-input" placeholder="Ketik di sini..."
                        class="w-full p-4 rounded-xl border-2 border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 outline-none uppercase font-bold text-lg text-slate-800 dark:text-white">
                </div>
            </div>

            <div class="relative group">
                <div
                    class="absolute -inset-4 bg-gradient-to-tr from-purple-500 to-blue-500 rounded-[4rem] blur-xl opacity-25 group-hover:opacity-40 transition duration-1000">
                </div>

                <div
                    class="relative bg-black rounded-[3rem] border-8 border-slate-800 aspect-square overflow-hidden shadow-2xl">
                    <video id="webcam" autoplay playsinline muted
                        style="width: 100%; height: 100%; object-fit: cover; display: block;">
                    </video>

                    <div id="scanner-line"
                        class="absolute inset-0 border-4 border-purple-500/50 rounded-[2.5rem] pointer-events-none">
                        <div class="w-full h-1 bg-purple-500 absolute top-0 animate-scan"></div>
                    </div>

                    <div id="ai-status"
                        class="absolute bottom-6 left-1/2 -translate-x-1/2 bg-black/60 backdrop-blur-md text-white px-6 py-3 rounded-full text-sm font-bold flex items-center gap-3 whitespace-nowrap">
                        <span id="status-ping" class="w-3 h-3 bg-yellow-400 rounded-full animate-ping"></span>
                        <span id="status-text">Mengunduh Sistem AI...</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-12 flex gap-4">
            <button onclick="simulateAI()"
                class="bg-slate-500 text-white p-5 px-8 rounded-2xl font-black uppercase cursor-pointer opacity-50 hover:opacity-100 transition text-sm">
                Bypass Isyarat (Dev Mode)
            </button>
            <a href="{{ route('materi.belajar', ['step' => 3, 'soal_ke' => $soal_ke + 1]) }}" id="btn-next"
                class="hidden bg-teal-500 text-white p-5 px-10 rounded-2xl font-black uppercase shadow-lg text-sm animate-bounce">
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