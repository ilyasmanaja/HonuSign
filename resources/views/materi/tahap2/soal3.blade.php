<x-student-layout>
    <style>
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

    <!-- Main Card Container filling 80-85% viewport, zero scrolling -->
    <div
        class="w-full max-w-6xl h-[calc(100vh-3rem)] bg-[#FFFEFA] brutal-border brutal-shadow rounded-[3rem] p-6 flex flex-col justify-between overflow-hidden relative">

        <!-- Header (Menu Bar with Home button on left, Reset & Mute on right) -->
        <header class="w-full flex items-center justify-between pb-3 border-b-4 border-black mb-2">
            <!-- Left side: Home button to return to Peta Belajar -->
            <a href="{{ route('materi.index') }}"
                class="w-12 h-12 bg-[#FFB3B3] brutal-border brutal-shadow-sm brutal-hover flex items-center justify-center rounded-2xl cursor-pointer text-black"
                title="Keluar & Simpan">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path opacity="0.2" d="M12 3L2 12h3v8h14v-8h3L12 3z" />
                    <path d="M12 3L2 12h3v8h14v-8h3L12 3zm0 2.83L18.17 12H17v6H7v-6H5.83L12 5.83z"
                        fill="currentColor" />
                </svg>
            </a>

            <!-- Center status info -->
            <div class="flex items-center gap-2">
                <div class="w-4 h-4 rounded-full bg-[#FFF5B8] brutal-border"></div>
                <span class="font-black text-black uppercase tracking-wider text-xs md:text-sm">Susun Kalimat (Soal
                    3/3)</span>
            </div>

            <!-- Right side system controls -->
            <div class="flex items-center gap-3">
                <!-- Reset Button -->
                <button onclick="resetGame()"
                    class="w-12 h-12 bg-white brutal-border brutal-shadow-sm brutal-hover flex items-center justify-center rounded-2xl cursor-pointer text-black"
                    title="Ulangi">
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

        <!-- Top Section: Visual Clue (Samsul image & mascot pointing to letters) -->
        <div class="w-full flex flex-col md:flex-row gap-6 items-stretch flex-grow max-h-[35%] min-h-[140px] mb-2">
            <!-- Left Side: Samsul Image Card -->
            <div
                class="w-full md:w-1/2 bg-[#D4F1BE] brutal-border brutal-shadow rounded-[2rem] p-3 flex items-center justify-center relative overflow-hidden">
                <div
                    class="bg-white p-2 brutal-border brutal-shadow-sm rounded-[1.5rem] transform -rotate-1 hover:rotate-0 transition-transform duration-300">
                    <img src="{{ asset('images/materi/tahap1/samsul_teluk_belangga.png') }}" alt="Samsul Baju Riau"
                        class="h-20 md:h-24 w-auto rounded-xl brutal-border object-contain">
                </div>
            </div>

            <!-- Right Side: Mascot Visual Clue -->
            <div
                class="w-full md:w-1/2 bg-[#E0BBE4] brutal-border brutal-shadow p-4 rounded-[2rem] flex items-center justify-center">
                <div class="flex items-center gap-6 justify-center">
                    <img src="{{ asset('images/keSekolah/samsul.png') }}"
                        class="h-20 md:h-24 w-auto object-contain animate-bounce" alt="Samsul Maskot">
                    <div class="bg-white p-2.5 rounded-2xl brutal-border brutal-shadow-sm flex items-center gap-2">
                        <span class="text-2xl">📝</span>
                        <span class="text-xl font-black text-black">➔</span>
                        <span
                            class="text-2xl font-black bg-[#D4F1BE] px-2.5 py-0.5 rounded-lg brutal-border text-black">ABC</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Middle Section: Word Options (Primary Focus - Oversized) -->
        <div
            class="w-full bg-[#FFF5B8] brutal-border brutal-shadow rounded-[2rem] p-6 flex flex-col justify-center items-center flex-grow max-h-[40%] mb-2">
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

        <!-- Bottom Section: Sentence Slots -->
        <div class="w-full max-h-[18%]">
            <div id="sentence-slots"
                class="flex flex-wrap justify-center items-center gap-4 min-h-[75px] w-full p-3 bg-[#FFFEFA] rounded-[1.5rem] brutal-border shadow-inner overflow-y-auto">
                <!-- Words will appear here -->
            </div>
        </div>

        <!-- Next Play Button (Hidden until correct, displayed at bottom center) -->
        <div class="absolute bottom-4 right-6">
            <a href="{{ route('materi.belajar', ['step' => 3]) }}" id="next-btn"
                class="hidden bg-[#D4F1BE] text-black w-14 h-14 flex items-center justify-center rounded-full brutal-border brutal-shadow-sm brutal-hover transform transition-all animate-bounce"
                title="Lanjut">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8">
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
                Kalimatnya sudah benar!
            </p>

            <!-- Lanjut ke Tahap 3 -->
            <a href="{{ route('materi.belajar', ['step' => 3]) }}"
                class="bg-[#D4F1BE] text-black w-24 h-24 flex items-center justify-center rounded-full brutal-border brutal-shadow-sm brutal-hover transform hover:-translate-y-2 transition-all"
                title="Lanjut ke Tahap 3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-14 h-14">
                    <circle cx="12" cy="12" r="10" opacity="0.2" fill="currentColor" />
                    <path d="M10 17V7l7 5-7 5z" fill="currentColor" />
                </svg>
            </a>
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

        function showSuccessModal(title, desc) {
            document.getElementById('modal-desc').innerText = desc;
            const modal = document.getElementById('success-modal');
            const content = document.getElementById('success-modal-content');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            void modal.offsetWidth;
            modal.classList.remove('opacity-0');
            content.classList.remove('scale-90');
            content.classList.add('scale-100');
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
                    showSuccessModal("LUAR BIASA!", "Kalimatnya sudah benar!");
                    saveProgress(2, 0);
                    document.getElementById('next-btn').classList.remove('hidden');
                } else {
                    setTimeout(() => {
                        alert('Yah, susunan kalimatnya masih keliru. Yuk coba lagi!');
                        resetGame();
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

            const nextBtn = document.getElementById('next-btn');
            if (nextBtn && !nextBtn.classList.contains('hidden')) {
                nextBtn.classList.add('hidden');
            }
        }
    </script>
</x-student-layout>
