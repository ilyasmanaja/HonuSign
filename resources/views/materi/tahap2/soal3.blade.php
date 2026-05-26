<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <title>HonuSign - Susun Kalimat</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;600;700;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Fredoka', sans-serif;
            background-color: #FFD1E3 !important; /* Soft Pink */
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

        @keyframes fly-in {
            0% {
                opacity: 0;
                transform: translateY(40px) scale(0.5);
            }

            60% {
                transform: translateY(-8px) scale(1.08);
            }

            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .animate-fly-in {
            animation: fly-in 0.4s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
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
    <div class="pt-16 md:pt-20 px-4 flex justify-center max-w-7xl mx-auto">
        <h1
            class="mb-4 bg-[#FFF5B8] brutal-border brutal-shadow-sm px-8 py-3 rounded-2xl text-2xl md:text-3xl font-black uppercase tracking-widest text-center transform -rotate-1 min-w-[220px] shadow-sm">
            Susun Kalimat (Soal 3/3)
        </h1>
    </div>

    <!-- Main Game Layout (Stacked vertically, centered and large) -->
    <div class="pb-8 px-4 md:px-8 flex flex-col gap-6 max-w-4xl w-full mx-auto">
        
        <!-- Word Options Card -->
        <div class="w-full bg-[#FFF5B8] brutal-border brutal-shadow rounded-[2rem] p-8 flex flex-col justify-center items-center">
            <h2 class="text-xl font-black uppercase tracking-widest mb-6 text-slate-800">Pilih Kata</h2>
            <div id="word-options" class="flex flex-wrap justify-center gap-5">
                @php
                    $words = ['Samsul', 'Menggunakan', 'Baju', 'Riau'];
                    shuffle($words);
                @endphp

                @foreach ($words as $word)
                    <button onclick="pickWord('{{ $word }}', this)"
                        class="bg-white px-10 py-5 rounded-2xl brutal-border brutal-shadow brutal-hover font-black text-black uppercase text-xl md:text-2xl transition-all cursor-pointer">
                        {{ $word }}
                    </button>
                @endforeach
            </div>
        </div>

        <!-- Sentence Slots Card -->
        <div class="w-full bg-[#FFFEFA] brutal-border brutal-shadow rounded-[2rem] p-8 flex flex-col justify-center">
            <h2 class="text-xl font-black uppercase tracking-widest mb-6 text-slate-800 text-center">Kalimat Susunanmu</h2>
            <div id="sentence-slots"
                class="flex flex-wrap justify-center items-center gap-4 min-h-[120px] w-full p-6 bg-[#FFF9F0] rounded-2xl border-4 border-dashed border-black shadow-inner overflow-y-auto">
                <!-- Words will appear here -->
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
                <button onclick="resetGame()" aria-label="Ulangi"
                    class="bg-[#FFF5B8] text-black w-[18%] aspect-square rounded-2xl brutal-border brutal-shadow-sm brutal-hover flex items-center justify-center cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        class="w-1/2 h-1/2 text-black fill-none stroke-current" stroke-width="3.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21.5 2v6h-6M21.34 15.57a10 10 0 1 1-.57-8.38l.57-1.19" />
                    </svg>
                </button>
                <!-- Next Button (Lanjut ke Tahap 3) -->
                <a href="{{ route('materi.belajar', ['step' => 3]) }}" aria-label="Lanjut"
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

    <!-- Failure Modal (using gagal.png) -->
    <div id="failure-modal"
        class="fixed inset-0 z-[9999] bg-slate-900/60 backdrop-blur-sm hidden flex-col items-center justify-center opacity-0 transition-all duration-300">
        <div class="relative w-full max-w-[480px] aspect-square transform scale-90 transition-transform duration-500 select-none"
            id="failure-modal-content">

            <!-- Main Image -->
            <img src="{{ asset('images/gagal.png') }}" alt="Gagal!"
                class="w-full h-full object-contain rounded-[3rem] brutal-border brutal-shadow">

            <!-- Replay Button Overlay -->
            <div class="absolute bottom-[9%] left-0 right-0 flex justify-center">
                <!-- Replay Button -->
                <button onclick="hideFailureModal()" aria-label="Ulangi"
                    class="bg-[#FFF5B8] text-black w-[18%] aspect-square rounded-2xl brutal-border brutal-shadow-sm brutal-hover flex items-center justify-center cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        class="w-1/2 h-1/2 text-black fill-none stroke-current" stroke-width="3.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21.5 2v6h-6M21.34 15.57a10 10 0 1 1-.57-8.38l.57-1.19" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <script>
        const correctSentence = "Samsul Menggunakan Baju Riau";
        let currentSentence = [];
        let isMuted = localStorage.getItem('sound_muted') === 'true';

        // Initialize sound states
        document.addEventListener('DOMContentLoaded', () => {
            updateSoundIcon();
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

        function showSuccessModal() {
            const modal = document.getElementById('success-modal');
            const content = document.getElementById('success-modal-content');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            void modal.offsetWidth;
            modal.classList.remove('opacity-0');
            content.classList.remove('scale-90');
            content.classList.add('scale-100');
        }

        function showFailureModal() {
            const modal = document.getElementById('failure-modal');
            const content = document.getElementById('failure-modal-content');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            void modal.offsetWidth;
            modal.classList.remove('opacity-0');
            content.classList.remove('scale-90');
            content.classList.add('scale-100');
        }

        function hideFailureModal() {
            const modal = document.getElementById('failure-modal');
            const content = document.getElementById('failure-modal-content');
            if (modal) {
                content.classList.remove('scale-100');
                content.classList.add('scale-90');
                modal.classList.add('opacity-0');
                setTimeout(() => {
                    modal.classList.remove('flex');
                    modal.classList.add('hidden');
                    resetGame();
                }, 300);
            }
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

        function pickWord(word, element) {
            const sentenceContainer = document.getElementById('sentence-slots');

            const wordBadge = document.createElement('span');
            wordBadge.className =
                "cursor-pointer bg-[#FFF5B8] text-black px-10 py-5 rounded-2xl brutal-border brutal-shadow-sm font-black uppercase text-xl md:text-2xl hover:scale-95 transition-transform flex items-center justify-center animate-fly-in";
            wordBadge.innerText = word;

            // Store reference to word
            wordBadge.dataset.word = word;
            wordBadge.onclick = () => {
                element.classList.remove('opacity-0', 'pointer-events-none');
                wordBadge.remove();
                updateSentenceFromSlots();
            };

            sentenceContainer.appendChild(wordBadge);
            element.classList.add('opacity-0', 'pointer-events-none');

            updateSentenceFromSlots();
        }

        function updateSentenceFromSlots() {
            const slots = document.querySelectorAll('#sentence-slots > span');
            currentSentence = Array.from(slots).map(slot => slot.dataset.word);

            const totalWords = correctSentence.split(' ').length;
            if (currentSentence.length === totalWords) {
                if (currentSentence.join(' ') === correctSentence) {
                    showSuccessModal();
                    saveProgress(2, 0);
                } else {
                    setTimeout(() => {
                        showFailureModal();
                    }, 500);
                }
            }
        }

        function resetGame() {
            currentSentence = [];
            const sentenceSlots = document.getElementById('sentence-slots');
            if (sentenceSlots) {
                sentenceSlots.innerHTML = "";
            }
            const wordOptions = document.querySelectorAll('#word-options button');
            wordOptions.forEach(opt => opt.classList.remove('opacity-0', 'pointer-events-none'));

            const successModal = document.getElementById('success-modal');
            const successContent = document.getElementById('success-modal-content');
            if (successModal && !successModal.classList.contains('hidden')) {
                successContent.classList.remove('scale-100');
                successContent.classList.add('scale-90');
                successModal.classList.add('opacity-0');
                setTimeout(() => {
                    successModal.classList.remove('flex');
                    successModal.classList.add('hidden');
                }, 300);
            }
        }
    </script>
</body>

</html>
