<x-student-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Fredoka:wght@400;500;600;700&display=swap');
        body { background-color: #FFF9F0 !important; font-family: 'Fredoka', sans-serif; overflow-x: hidden; }
        .brutal-border { border: 4px solid #000000 !important; }
        .brutal-shadow { box-shadow: 6px 6px 0px 0px #000000 !important; }
        .brutal-shadow-sm { box-shadow: 3px 3px 0px 0px #000000 !important; }
        .brutal-hover { transition: all 0.2s ease-in-out !important; }
        .brutal-hover:hover { transform: translate(-3px, -3px) !important; box-shadow: 9px 9px 0px 0px #000000 !important; }
        .brutal-hover:active { transform: translate(2px, 2px) !important; box-shadow: 2px 2px 0px 0px #000000 !important; }
        @keyframes scan { 0% { top: 0; } 100% { top: 100%; } }
        .animate-scan { animation: scan 3s linear infinite; }
        @keyframes twitch { 0% { transform: scale(1) rotate(0deg); } 25% { transform: scale(1.15) rotate(3deg); } 50% { transform: scale(0.95) rotate(-3deg); } 75% { transform: scale(1.1) rotate(1.5deg); } 100% { transform: scale(1) rotate(0deg); } }
        .animate-twitch { animation: twitch 1.2s ease-in-out infinite; }
    </style>

    <div class="absolute top-4 left-4 md:top-6 md:left-6 z-[110] group/tooltip pointer-events-auto">
        <a href="{{ route('ai.index', ['mapel_slug' => $mapel->slug]) }}" aria-label="Kembali"
            class="bg-[#FFB3B3] text-black p-3.5 rounded-2xl font-bold brutal-border brutal-shadow-sm brutal-hover flex items-center justify-center w-14 h-14">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-7 h-7 text-black" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12" />
                <polyline points="12 19 5 12 12 5" />
            </svg>
        </a>
    </div>

    <div class="pt-16 md:pt-20 px-4 flex flex-col items-center max-w-7xl mx-auto w-full">
        <h1 class="mb-4 bg-[#BEE9E8] brutal-border brutal-shadow-sm px-8 py-3 rounded-2xl text-2xl md:text-3xl font-black uppercase tracking-widest text-center transform -rotate-1 min-w-[220px] shadow-sm">
            Latihan Bebas AI
        </h1>
        
        <div class="bg-[#FFFEFA] brutal-border brutal-shadow rounded-2xl p-4 text-center mt-2 max-w-lg w-full">
            <h2 class="text-xl md:text-2xl font-black text-black">Ayo eja kata: <span class="text-indigo-600 bg-indigo-100 px-2 rounded-lg">{{ $word }}</span></h2>
        </div>
    </div>

    <div class="mt-8 pb-8 px-4 md:px-8 flex flex-col md:flex-row items-center md:items-stretch justify-center gap-6 md:gap-8 max-w-6xl w-full mx-auto">

        <div class="w-full md:w-2/3 relative bg-black brutal-border brutal-shadow rounded-[2.5rem] h-[50vh] min-h-[320px] max-h-[480px] overflow-hidden">
            <video id="webcam" autoplay playsinline muted class="w-full h-full object-cover block"></video>
            
            <div id="scanner-line" class="absolute inset-0 border-4 border-[#BEE9E8]/70 rounded-[2.3rem] pointer-events-none">
                <div class="w-full h-1 bg-[#BEE9E8] absolute top-0 animate-scan"></div>
            </div>

            <div id="ai-detected-char" class="absolute top-6 right-6 bg-[#FFD1E3] brutal-border brutal-shadow-sm rounded-2xl p-4 flex items-center justify-center min-w-[80px] min-h-[80px] z-50 animate-twitch">
                <span id="detected-char-text" class="text-5xl font-black text-black uppercase">-</span>
            </div>

            <div id="ai-status" class="absolute bottom-4 left-1/2 -translate-x-1/2 bg-black/70 backdrop-blur-md text-white px-5 py-3 rounded-full text-sm font-bold flex items-center gap-3 whitespace-nowrap">
                <span id="status-ping" class="w-3 h-3 bg-yellow-400 rounded-full animate-ping"></span>
                <span id="status-text">Memuat AI...</span>
            </div>
        </div>

        <div class="w-full md:w-1/3 flex flex-col justify-center items-center text-center bg-[#FFF5B8] brutal-border brutal-shadow rounded-[2.5rem] p-8">
            <span class="inline-block px-4 py-1.5 bg-white brutal-border brutal-shadow-sm rounded-xl text-xs font-black uppercase tracking-wider mb-4">Progres Ejaan</span>
            <p class="font-black text-slate-800 uppercase tracking-widest text-sm mb-4">Target:</p>
            <h1 id="word-progress" class="text-4xl lg:text-5xl font-black text-black uppercase tracking-widest mb-4">-</h1>
            <p id="word-target-hint" class="text-sm text-slate-700 font-bold">Total: {{ strlen($word) }} Huruf</p>
        </div>

    </div>

    <div id="success-modal" class="fixed inset-0 z-[9999] bg-slate-900/60 backdrop-blur-sm hidden flex-col items-center justify-center opacity-0 transition-all duration-300">
        <div class="bg-white p-8 brutal-border brutal-shadow rounded-[3rem] text-center max-w-sm w-full mx-4 transform scale-90 transition-transform duration-500" id="success-modal-content">
            <div class="text-6xl mb-4 animate-bounce">🎉</div>
            <h2 class="text-3xl font-black uppercase text-black mb-2">Horeee!</h2>
            <p class="font-bold text-slate-600 mb-8">Kamu berhasil mengeja kata <b>{{ $word }}</b> dengan sempurna!</p>
            
            <div class="flex flex-col gap-4">
                <button onclick="window.location.reload()" class="w-full bg-[#FFF5B8] text-black px-6 py-4 rounded-2xl brutal-border brutal-shadow-sm brutal-hover font-black uppercase">
                    Ulangi Kata Ini 🔄
                </button>
                <a href="{{ route('ai.index', ['mapel_slug' => $mapel->slug]) }}" class="w-full bg-[#D4F1BE] text-black px-6 py-4 rounded-2xl brutal-border brutal-shadow-sm brutal-hover font-black uppercase">
                    Pilih Kata Lain 📚
                </a>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/@tensorflow/tfjs"></script>
    <script src="https://unpkg.com/@tensorflow/tfjs-tflite@0.0.1-alpha.10/dist/tf-tflite.min.js"></script>

    <script type="module">
        import { HandLandmarker, FilesetResolver } from "https://esm.sh/@mediapipe/tasks-vision@0.10.14";

        const MODEL_TFLITE_PATH = "{{ asset('models/honusign_model.tflite') }}";
        const MEDIAPIPE_TASK_PATH = "{{ asset('models/hand_landmarker.task') }}";
        const TARGET_WORD = "{{ $word }}";
        const ALPHABET_MAP = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y'];

        try { if (window.tflite) { window.tflite.setWasmPath("{{ asset('models') }}/"); } } catch (e) {}

        const video = document.getElementById('webcam');
        const statusText = document.getElementById('status-text');
        const statusPing = document.getElementById('status-ping');
        const progressDisplay = document.getElementById('word-progress');
        
        let handLandmarker;
        let tfliteModel;
        let isSelesai = false;
        let currentLetterIdx = 0;
        let akumulasi = "";

        function updateUI() {
            let html = "";
            for (let i = 0; i < TARGET_WORD.length; i++) {
                if (i < currentLetterIdx) html += `<span class="text-green-600 font-black">${TARGET_WORD[i]}</span>`;
                else if (i === currentLetterIdx) html += `<span class="text-purple-600 font-black underline animate-pulse active-slot">[${TARGET_WORD[i]}]</span>`;
                else html += `<span class="text-slate-300 font-bold">_</span>`;
            }
            progressDisplay.innerHTML = html;
        }

        async function init() {
            statusText.innerText = "Menginisialisasi AI...";
            updateUI();
            const filesetResolver = await FilesetResolver.forVisionTasks("https://cdn.jsdelivr.net/npm/@mediapipe/tasks-vision@0.10.14/wasm");
            handLandmarker = await HandLandmarker.createFromOptions(filesetResolver, {
                baseOptions: { modelAssetPath: MEDIAPIPE_TASK_PATH, delegate: "CPU" }, runningMode: "VIDEO", numHands: 1
            });
            tfliteModel = await window.tflite.loadTFLiteModel(MODEL_TFLITE_PATH);
            navigator.mediaDevices.getUserMedia({ video: { width: 640, height: 480, facingMode: "user" } }).then(stream => {
                video.srcObject = stream;
                video.onloadedmetadata = () => { statusText.textContent = "Sistem Siap!"; statusPing.style.background = 'green'; loop(); };
                video.play();
            });
        }

        async function loop() {
            if (isSelesai) return;
            if (video.readyState === video.HAVE_ENOUGH_DATA) {
                const det = handLandmarker.detectForVideo(video, performance.now());
                if (det.landmarks && det.landmarks.length > 0) {
                    const norm = normalize(det.landmarks[0]);
                    const tensor = tf.tensor2d([norm], [1, 63]);
                    const pred = await tfliteModel.predict(tensor);
                    const arr = await pred.data();
                    const max = Array.from(arr).indexOf(Math.max(...arr));
                    const letter = ALPHABET_MAP[max];
                    const conf = arr[max];
                    const expected = TARGET_WORD[currentLetterIdx];

                    document.getElementById('detected-char-text').innerText = letter;
                    statusText.textContent = `Mengeja: ${akumulasi}[${expected}]... (AI: ${letter})`;

                    if (letter === expected && conf > 0.82) {
                        tensor.dispose(); pred.dispose();
                        akumulasi += expected; currentLetterIdx++; updateUI();
                        if (currentLetterIdx >= TARGET_WORD.length) { triggerSelesai(); return; }
                        await new Promise(r => setTimeout(r, 700)); // Jeda 0.7s antar huruf
                        requestAnimationFrame(loop); return;
                    }
                    tensor.dispose(); pred.dispose();
                } else {
                    document.getElementById('detected-char-text').innerText = "-";
                    statusText.textContent = `Peragakan huruf "${TARGET_WORD[currentLetterIdx]}"`;
                }
            }
            requestAnimationFrame(loop);
        }

        function normalize(lm) {
            const wrist = lm[0];
            let c = lm.map(l => ({ x: l.x - wrist.x, y: l.y - wrist.y, z: l.z - wrist.z }));
            let m = Math.max(...c.map(l => Math.sqrt(l.x**2 + l.y**2 + l.z**2)));
            return c.flatMap(l => [m>0?l.x/m:l.x, m>0?l.y/m:l.y, m>0?l.z/m:l.z]);
        }

        function triggerSelesai() {
            isSelesai = true;
            statusText.textContent = "Bagus Sekali!";
            document.getElementById('scanner-line').classList.add('hidden');
            const m = document.getElementById('success-modal');
            const c = document.getElementById('success-modal-content');
            m.classList.remove('hidden'); m.classList.add('flex');
            setTimeout(() => { m.classList.remove('opacity-0'); c.classList.remove('scale-90'); c.classList.add('scale-100'); }, 10);
        }

        init();
    </script>
</x-student-layout>