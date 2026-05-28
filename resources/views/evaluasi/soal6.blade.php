<x-student-layout>
    <!-- Import Font Fredoka -->
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;600;700;900&display=swap" rel="stylesheet">
    <style>
        .font-fredoka {
            font-family: 'Fredoka', sans-serif;
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

        /* Custom Magnet Card Style */
        .magnet-card {
            background-color: #FFF5B8;
            /* Pastel Yellow */
            border: 4px solid #000;
            box-shadow: 4px 4px 0px 0px #000;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
            user-select: none;
        }

        .magnet-card:hover {
            transform: translateY(-2px);
            box-shadow: 6px 6px 0px 0px #000;
        }

        .magnet-card:active {
            transform: translate(2px, 2px);
            box-shadow: 2px 2px 0px 0px #000;
        }
    </style>

    <div class="max-w-4xl w-full px-4 py-8 flex flex-col items-center font-fredoka text-black">

        <!-- Back to Dashboard / Header -->
        <div class="w-full flex justify-between items-center mb-6">
            <a href="{{ route('dashboard') }}"
                class="bg-[#FFB3B3] text-black px-4 py-2.5 rounded-2xl font-black brutal-border brutal-shadow-sm brutal-hover flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
            </a>
        </div>

        <!-- Progress Bar -->
        <div class="w-full mb-8 max-w-3xl">
            <div class="flex justify-between mb-3 items-end">
                <span class="font-black text-lg tracking-widest uppercase">Soal {{ $soal }} dari 10</span>
                <span class="text-sm font-bold text-slate-600">Progres: {{ ($soal - 1) * 10 }}%</span>
            </div>
            <div class="w-full h-7 bg-white brutal-border brutal-shadow-sm rounded-2xl overflow-hidden p-1">
                <div class="h-full bg-[#E0BBE4] rounded-xl transition-all duration-500 border-r-4 border-black"
                    style="width: {{ ($soal / 10) * 100 }}%"></div>
            </div>
        </div>

        <!-- Question Container -->
        <div
            class="w-full bg-[#FFFEFA] brutal-border brutal-shadow rounded-[2.5rem] p-6 md:p-10 mb-8 transition-all duration-300">
            <div class="text-center mb-8">
                <span
                    class="inline-block px-4 py-1.5 bg-[#FFF5B8] brutal-border brutal-shadow-sm rounded-xl text-xs font-black uppercase tracking-wider mb-3">Literasi</span>
                <h2 class="text-2xl md:text-3xl font-black text-black leading-snug">
                    Susunlah kata-kata berikut menjadi kalimat yang benar!
                </h2>
                <p class="text-sm text-slate-500 mt-2 font-bold uppercase tracking-widest">💡 Klik kata di bawah untuk
                    menyusun kalimat!</p>
            </div>

            <!-- Scrambled Words Pool -->
            <div class="mb-10 p-6 bg-[#BEE9E8] brutal-border brutal-shadow rounded-[2rem] text-center">
                <span class="text-xs font-black uppercase tracking-widest text-slate-800 block mb-4">Pilihan Kata</span>
                <div id="words-pool" class="flex flex-wrap justify-center gap-4">
                    <!-- Words generated dynamically -->
                </div>
            </div>

            <!-- Sentence Slots Area -->
            <div class="p-8 bg-[#FFF9F0] brutal-border border-4 border-dashed border-slate-400 rounded-[2rem]">
                <span class="text-xs font-black uppercase tracking-widest text-slate-600 block text-center mb-4">Kalimat
                    Kamu</span>
                <div id="sentence-container" class="flex flex-wrap justify-center items-center gap-4 min-h-[80px]">
                    <!-- Placed words will appear here -->
                </div>
            </div>
        </div>

        <!-- Navigation Buttons -->
        <div class="flex gap-4 items-center">
            <a href="{{ route('evaluasi.soal', ['soal' => $soal - 1]) }}"
                class="bg-white hover:bg-slate-50 brutal-border brutal-shadow-sm brutal-hover text-black px-6 py-4 rounded-2xl font-black uppercase text-base flex items-center gap-2">
                Kembali
            </a>

            <button id="btn-next" onclick="goNext()"
                class="bg-[#D4F1BE] brutal-border brutal-shadow-sm brutal-hover text-black px-8 py-4 rounded-2xl font-black uppercase text-base flex items-center gap-2">
                Lanjut
            </button>
        </div>
    </div>

    <!-- Alert Modal for Selection -->
    <div id="alert-modal"
        class="fixed inset-0 z-[9999] bg-slate-900/60 backdrop-blur-sm hidden flex-col items-center justify-center opacity-0 transition-all duration-300">
        <div class="bg-white brutal-border brutal-shadow rounded-[2.5rem] p-8 max-w-sm w-full mx-4 text-center transform scale-90 transition-transform duration-300"
            id="alert-content">
            <span class="text-6xl mb-4 block">⚠️</span>
            <h3 class="text-2xl font-black text-black mb-3 uppercase">Susun Kalimat!</h3>
            <p class="text-slate-600 font-bold mb-6">Silakan susun seluruh kata di atas ke dalam kalimat terlebih
                dahulu.</p>
            <button onclick="closeAlert()"
                class="w-full bg-[#FFF5B8] brutal-border brutal-shadow-sm brutal-hover py-3 rounded-xl font-black uppercase text-sm">
                Mengerti 👍
            </button>
        </div>
    </div>

    <script>
        const originalWords = ["Abdul", "Ikut", "Kerja Bakti", "Di Sekolah"];
        let scrambledWords = ["Kerja Bakti", "Ikut", "Abdul", "Di Sekolah"];
        let selectedWords = [];

        window.onload = function() {
            // Restore from sessionStorage if exists
            const stored = sessionStorage.getItem('evaluasi_answers');
            if (stored) {
                const answers = JSON.parse(stored);
                if (answers.soal6) {
                    selectedWords = answers.soal6.split('-').filter(Boolean);
                }
            }

            renderWords();
        };

        function renderWords() {
            // Render the words pool (scrambled words that are NOT yet selected)
            const pool = document.getElementById('words-pool');
            pool.innerHTML = scrambledWords.map(word => {
                const isSelected = selectedWords.includes(word);
                if (isSelected) return ''; // Hide if selected
                return `
                    <button onclick="selectWord('${word}')" class="magnet-card px-6 py-3 rounded-xl text-base md:text-lg font-black text-black">
                        ${word}
                    </button>
                `;
            }).join('');

            // Render the sentence slots
            const sentence = document.getElementById('sentence-container');
            if (selectedWords.length === 0) {
                sentence.innerHTML =
                    '<span class="text-slate-400 font-bold text-sm uppercase tracking-wider select-none">Klik kata di atas untuk menyusun...</span>';
            } else {
                sentence.innerHTML = selectedWords.map((word, index) => `
                    <button onclick="deselectWord(${index})" class="magnet-card px-6 py-3 rounded-xl text-base md:text-lg font-black text-black transform rotate-${(index % 2 === 0) ? '1' : '-1'}">
                        ${word}
                    </button>
                `).join('');
            }
        }

        function selectWord(word) {
            selectedWords.push(word);
            saveState();
            renderWords();
        }

        function deselectWord(index) {
            selectedWords.splice(index, 1);
            saveState();
            renderWords();
        }

        function saveState() {
            const stored = sessionStorage.getItem('evaluasi_answers') || '{}';
            const answers = JSON.parse(stored);
            answers.soal6 = selectedWords.join('-');
            sessionStorage.setItem('evaluasi_answers', JSON.stringify(answers));
        }

        function goNext() {
            if (selectedWords.length < originalWords.length) {
                showAlert();
                return;
            }
            window.location.href = "{{ route('evaluasi.soal', ['soal' => $soal + 1]) }}";
        }

        function showAlert() {
            const modal = document.getElementById('alert-modal');
            const content = document.getElementById('alert-content');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            void modal.offsetWidth;
            modal.classList.remove('opacity-0');
            content.classList.remove('scale-90');
            content.classList.add('scale-100');
        }

        function closeAlert() {
            const modal = document.getElementById('alert-modal');
            const content = document.getElementById('alert-content');
            content.classList.remove('scale-100');
            content.classList.add('scale-90');
            modal.classList.add('opacity-0');
            setTimeout(() => {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
            }, 300);
        }
    </script>
</x-student-layout>
