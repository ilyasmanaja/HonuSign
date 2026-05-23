<x-student-layout>
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
                    <!-- Silhouette of Hand/Body -->
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

    <script>
        function showTutorial() {
            const overlay = document.getElementById('tutorial-overlay');
            const content = document.getElementById('tutorial-modal-content');
            if (overlay && content) {
                overlay.classList.remove('opacity-0', 'pointer-events-none');
                overlay.classList.add('opacity-100', 'pointer-events-auto');
                content.classList.remove('scale-90');
                content.classList.add('scale-100');
            }
        }

        function closeTutorial() {
            const overlay = document.getElementById('tutorial-overlay');
            const content = document.getElementById('tutorial-modal-content');
            if (overlay && content) {
                overlay.classList.add('opacity-0', 'pointer-events-none');
                overlay.classList.remove('opacity-100', 'pointer-events-auto');
                content.classList.add('scale-90');
                content.classList.remove('scale-100');
            }
        }

        window.addEventListener('DOMContentLoaded', () => {
            showTutorial();
        });
    </script>

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
                <div
                    class="bg-[#E0BBE4] brutal-border brutal-shadow-sm rounded-[2.5rem] p-6 flex flex-col items-center justify-center text-center">
                    <p class="font-black text-black uppercase tracking-widest text-sm mb-2">Kata yang Dieja:</p>
                    <h1 id="word-progress" class="text-5xl font-black text-black uppercase tracking-widest mb-2">
                        -
                    </h1>
                    <p id="word-target-hint" class="text-sm text-slate-500 font-bold"></p>
                </div>

                <!-- Input Fallback -->
                <div class="bg-[#FFFEFA] brutal-border brutal-shadow-sm rounded-2xl p-6">
                    <p class="text-xs font-bold text-slate-400 uppercase mb-3">Ketik jawaban jika kamera tidak muncul:
                    </p>
                    <input type="text" id="manual-input" placeholder="Ketik di sini..."
                        class="w-full p-4 rounded-xl brutal-border bg-white outline-none uppercase font-bold text-lg text-slate-800">
                </div>
            </div>

            <!-- Panel Kanan: Webcam -->
            <div class="relative">
                <div
                    class="relative bg-black brutal-border brutal-shadow rounded-[2.5rem] aspect-square overflow-hidden">
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

        <!-- Tombol Aksi (Visual-Only) -->
        <div class="mt-10 flex items-center justify-center gap-6">
            <!-- Tombol Keluar (Visual House Icon) -->
            <a href="{{ route('materi.index') }}"
                class="bg-[#FFB3B3] w-20 h-20 flex items-center justify-center brutal-border brutal-shadow-sm brutal-hover text-black rounded-full transform hover:-translate-y-2 transition-transform"
                title="Keluar & Simpan">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10">
                    <path opacity="0.2" d="M12 3L2 12h3v8h14v-8h3L12 3z" />
                    <path d="M12 3L2 12h3v8h14v-8h3L12 3zm0 2.83L18.17 12H17v6H7v-6H5.83L12 5.83z"
                        fill="currentColor" />
                </svg>
            </a>

            <!-- Tombol Bypass (Visual Skip Icon) -->
            <button onclick="simulateAI()"
                class="bg-[#FFF5B8] w-20 h-20 flex items-center justify-center brutal-border brutal-shadow-sm brutal-hover text-black rounded-full transform hover:-translate-y-2 transition-transform cursor-pointer"
                title="Lewati (Dev Mode)">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10">
                    <circle cx="12" cy="12" r="10" opacity="0.2" fill="currentColor" />
                    <path d="M6 18l8.5-6L6 6v12zm9-12v12h2V6h-2z" fill="currentColor" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Modal Sukses Kustom -->
    <div id="success-modal"
        class="fixed inset-0 z-[9999] bg-slate-900/60 backdrop-blur-sm hidden flex-col items-center justify-center opacity-0 transition-all duration-300">
        <div class="bg-[#BEE9E8] p-8 md:p-12 rounded-[3rem] brutal-border brutal-shadow flex flex-col items-center max-w-lg mx-4 transform scale-90 transition-transform duration-500 relative"
            id="success-modal-content">
            <button onclick="closeSuccessModal()"
                class="absolute top-4 right-4 bg-white brutal-border brutal-shadow-sm w-12 h-12 rounded-full flex items-center justify-center hover:bg-[#FFB3B3] hover:text-black transition-all transform hover:rotate-90 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path
                        d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"
                        fill="currentColor" />
                </svg>
            </button>

            <!-- Standardized Indonesian congrats + Smiling Face and Thumbs Up Duotone Icons -->
            <div class="flex items-center justify-center gap-6 mb-6">
                <!-- Smiling Face Icon -->
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
                <!-- Thumbs Up Icon -->
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

            <h2 class="text-4xl md:text-5xl font-black text-white text-outline uppercase tracking-tighter text-center mb-2 transform -rotate-2 drop-shadow-[0_4px_0_#000]"
                id="modal-title">
                SELAMAT!
            </h2>
            <p class="text-xl md:text-2xl font-bold text-slate-800 text-center mb-10 bg-[#FFF5B8] px-4 py-2 rounded-xl brutal-border"
                id="modal-desc">
                Peragaan isyarat kamu benar sekali!
            </p>

            <!-- Visual-only next button in success modal -->
            <a href="{{ route('materi.belajar', ['step' => 3, 'soal_ke' => $soal_ke + 1]) }}"
                class="bg-[#D4F1BE] text-black w-24 h-24 flex items-center justify-center rounded-full brutal-border brutal-shadow-sm brutal-hover transform hover:-translate-y-2 transition-all"
                title="Lanjut">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-14 h-14">
                    <circle cx="12" cy="12" r="10" opacity="0.2" fill="currentColor" />
                    <path d="M10 17V7l7 5-7 5z" fill="currentColor" />
                </svg>
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

        import {
            HandLandmarker,
            FilesetResolver
        } from "https://esm.sh/@mediapipe/tasks-vision@0.10.14";

        const MODEL_TFLITE_PATH = '/models/honusign_model.tflite';
        const MEDIAPIPE_TASK_PATH =
            "https://storage.googleapis.com/mediapipe-models/hand_landmarker/hand_landmarker/float16/latest/hand_landmarker.task";

        // KUNCI UTAMA: Ambil target kata utuh dari database seeder (Contoh: "ADI" atau "SAMSUL")
        const TARGET_WORD = "{{ $quiz->jawaban_benar }}".toUpperCase().trim();
        const ALPHABET_MAP = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T',
            'U', 'V', 'W', 'X', 'Y'
        ];

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
                    htmlOutput +=
                        `<span class="text-purple-600 dark:text-purple-400 font-black underline animate-pulse">[${TARGET_WORD[i]}]</span> `;
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

                        statusText.textContent =
                            `Mengeja: ${akumulasiJawaban}[${expectedLetter}]... (AI Melihat: ${detectedLetter})`;
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
            if (document.getElementById('scanner-line')) {
                document.getElementById('scanner-line').classList.add('hidden');
            }

            // Save user progress
            saveProgress(3, 0);

            // Show success modal
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

        // Save progress to database
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

        // Global Success Modal Triggers
        window.showSuccessModal = function() {
            const modal = document.getElementById('success-modal');
            const content = document.getElementById('success-modal-content');
            if (modal && content) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                void modal.offsetWidth; // force reflow
                modal.classList.remove('opacity-0');
                content.classList.remove('scale-90');
                content.classList.add('scale-100');
            }
        }

        window.closeSuccessModal = function() {
            const modal = document.getElementById('success-modal');
            const content = document.getElementById('success-modal-content');
            if (modal && content) {
                modal.classList.add('opacity-0');
                content.classList.remove('scale-100');
                content.classList.add('scale-90');
                setTimeout(() => {
                    modal.classList.remove('flex');
                    modal.classList.add('hidden');
                }, 300);
            }
        }

        // Manual Input Fallback Listener
        const manualInput = document.getElementById('manual-input');
        if (manualInput) {
            manualInput.addEventListener('input', (e) => {
                const val = e.target.value.toUpperCase().trim();
                if (val === TARGET_WORD) {
                    currentLetterIdx = TARGET_WORD.length;
                    akumulasiJawaban = TARGET_WORD;
                    updateProgressUI();
                    triggerMisiBerhasil();
                }
            });
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
