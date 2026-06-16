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
    </style>

    <div class="max-w-4xl w-full px-4 py-8 flex flex-col items-center font-fredoka text-black">

        <!-- Back to Dashboard / Header -->
        <div class="w-full flex justify-between items-center mb-6">
            <div class="relative group/tooltip inline-block">
                <a href="{{ route('dashboard') }}"
                    class="bg-[#FFB3B3] text-black px-4 py-2.5 rounded-2xl font-black brutal-border brutal-shadow-sm brutal-hover flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        class="w-5 h-5 text-black fill-none stroke-current" stroke-width="3.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                </a>
                <div class="pointer-events-none absolute top-full left-1/2 -translate-x-1/2 mt-3 bg-[#FFD1E3] brutal-border brutal-shadow-sm px-3 py-1.5 rounded-lg text-sm font-bold opacity-0 scale-95 group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-150 whitespace-nowrap z-50 text-black">
                    Kembali
                </div>
            </div>
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
                    Siti melihat temannya kesulitan membawa buku. Apa yang harus Siti lakukan?
                </h2>
                <p class="text-sm text-slate-500 mt-2 font-bold uppercase tracking-widest">💡 Pilih salah satu tombol di
                    bawah!</p>
            </div>

            <!-- Image display card -->
            <div
                class="w-full max-w-xl mx-auto mb-10 bg-white brutal-border brutal-shadow rounded-3xl overflow-hidden aspect-[16/9] relative">
                @php
                    $imageName = 'siti_bantu_buku.png';
                    $imagePath = 'images/evaluasi/' . $imageName;
                    $fileExists = file_exists(public_path($imagePath));
                @endphp
                @if ($fileExists)
                    <img src="{{ asset($imagePath) }}" alt="Siti melihat teman membawa buku"
                        class="w-full h-full object-cover">
                @else
                    <div
                        class="w-full h-full flex flex-col items-center justify-center p-6 bg-[#FFD8A8] text-center text-black">
                        <span class="text-5xl mb-2">📚👧🏻</span>
                        <span class="font-black text-xs uppercase tracking-wider text-slate-700">Aset Gambar
                            Butuh:</span>
                        <span
                            class="font-bold text-sm bg-white px-2.5 py-1 brutal-border shadow-sm mt-2 font-mono text-slate-800 break-all select-all">{{ $imageName }}</span>
                    </div>
                @endif
            </div>

            <!-- Action buttons -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 max-w-xl mx-auto">
                <!-- Option A: Membantu -->
                <button onclick="selectOption('A')" id="btn-option-A"
                    class="p-6 bg-white hover:bg-slate-50 brutal-border brutal-shadow brutal-hover rounded-[2rem] flex flex-col items-center justify-center gap-3 cursor-pointer select-none">
                    <span class="text-5xl">😊📚</span>
                    <span class="font-black text-lg text-slate-800 uppercase tracking-wider">Membantu</span>
                </button>

                <!-- Option B: Diam -->
                <button onclick="selectOption('B')" id="btn-option-B"
                    class="p-6 bg-white hover:bg-slate-50 brutal-border brutal-shadow brutal-hover rounded-[2rem] flex flex-col items-center justify-center gap-3 cursor-pointer select-none">
                    <span class="text-5xl">🚶🏻‍♀️🚫</span>
                    <span class="font-black text-lg text-slate-800 uppercase tracking-wider">Diam</span>
                </button>
            </div>
        </div>

        <!-- Navigation Buttons -->
        <div class="flex gap-4 items-center">
            <div class="relative group/tooltip inline-block">
                <a href="{{ route('evaluasi.soal', ['soal' => $soal - 1]) }}"
                    class="bg-white hover:bg-slate-50 brutal-border brutal-shadow-sm brutal-hover text-black px-6 py-4 rounded-2xl font-black uppercase text-base flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        class="w-5 h-5 text-black fill-none stroke-current" stroke-width="3.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                    Kembali
                </a>
                <div class="pointer-events-none absolute bottom-full left-1/2 -translate-x-1/2 mb-3 bg-[#FFD1E3] brutal-border brutal-shadow-sm px-3 py-1.5 rounded-lg text-sm font-bold opacity-0 scale-95 group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-150 whitespace-nowrap z-50 text-black">
                    Sebelumnya
                </div>
            </div>

            <div class="relative group/tooltip inline-block">
                <button id="btn-submit" onclick="submitEvaluasi()"
                    class="bg-[#FFF5B8] brutal-border brutal-shadow brutal-hover text-black px-10 py-5 rounded-[2.5rem] font-black uppercase text-lg flex items-center gap-2">
                    Kirim Jawaban
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        class="w-6 h-6 text-black fill-none stroke-current" stroke-width="3.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <line x1="22" y1="2" x2="11" y2="13"></line>
                        <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                    </svg>
                </button>
                <div class="pointer-events-none absolute bottom-full left-1/2 -translate-x-1/2 mb-3 bg-[#FFD1E3] brutal-border brutal-shadow-sm px-3 py-1.5 rounded-lg text-sm font-bold opacity-0 scale-95 group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-150 whitespace-nowrap z-50 text-black">
                    Kirim Evaluasi
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Modal for Selection -->
    <div id="alert-modal"
        class="fixed inset-0 z-[9999] bg-slate-900/60 backdrop-blur-sm hidden flex-col items-center justify-center opacity-0 transition-all duration-300">
        <div class="bg-white brutal-border brutal-shadow rounded-[2.5rem] p-8 max-w-sm w-full mx-4 text-center transform scale-90 transition-transform duration-300"
            id="alert-content">
            <span class="text-6xl mb-4 block">⚠️</span>
            <h3 class="text-2xl font-black text-black mb-3 uppercase">Pilih Tindakan Siti!</h3>
            <p class="text-slate-600 font-bold mb-6">Silakan tentukan tindakan yang harus Siti lakukan sebelum mengirim
                jawaban.</p>
            <button onclick="closeAlert()"
                class="w-full bg-[#FFF5B8] brutal-border brutal-shadow-sm brutal-hover py-3 rounded-xl font-black uppercase text-sm">
                Mengerti 👍
            </button>
        </div>
    </div>

    <!-- Success / Final Score Modal -->
    <div id="success-modal"
        class="fixed inset-0 z-[9999] bg-slate-900/60 backdrop-blur-sm hidden flex-col items-center justify-center opacity-0 transition-all duration-300">
        <div class="relative w-full max-w-[450px] aspect-square transform scale-90 transition-transform duration-500 select-none"
            id="success-modal-content">
            <!-- Victory Image as the Card Background -->
            <img src="{{ asset('images/selamat.png') }}" alt="Selamat!"
                class="absolute inset-0 w-full h-full object-cover rounded-[3rem] brutal-border brutal-shadow">

            <!-- Content Overlay (Score Box & Submit Button) -->
            <div class="absolute inset-0 flex flex-col items-center justify-end pb-12 pt-32 px-8 gap-4 z-20">
                <!-- Score Box Card -->
                <div id="score-card"
                    class="brutal-border brutal-shadow rounded-[2rem] p-4 w-full max-w-[220px] text-center bg-[#D4F1BE] transition-colors duration-300">
                    <span class="font-black text-slate-800 uppercase tracking-widest block mb-0.5 text-[10px]">Skor Akhir Kamu</span>
                    <span id="final-score-val" class="text-6xl font-black text-black">100</span>
                    <span class="text-lg font-black text-black">/100</span>
                </div>

                <!-- Submit progress and return to dashboard -->
                <div class="relative group/tooltip inline-block w-full max-w-[220px]">
                    <button onclick="finishAndSave()" id="btn-save-progress"
                        class="w-full bg-[#D4F1BE] hover:bg-green-100 brutal-border brutal-shadow-sm brutal-hover text-black py-3.5 rounded-[2rem] font-black uppercase tracking-wider text-sm flex items-center justify-center gap-2 cursor-pointer">
                        Selesai & Kirim
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            class="w-4 h-4 text-black fill-none stroke-current" stroke-width="3.5"
                            stroke-linecap="round" stroke-linejoin="round">
                            <line x1="22" y1="2" x2="11" y2="13"></line>
                            <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                        </svg>
                    </button>
                    <div class="pointer-events-none absolute bottom-full left-1/2 -translate-x-1/2 mb-3 bg-[#FFD1E3] brutal-border brutal-shadow-sm px-3 py-1.5 rounded-lg text-sm font-bold opacity-0 scale-95 group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-150 whitespace-nowrap z-50 text-black">
                        Simpan Progres
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let selectedOption = null;
        let finalComputedScore = 0;

        window.onload = function() {
            // Restore from sessionStorage if exists
            const stored = sessionStorage.getItem('evaluasi_answers');
            if (stored) {
                const answers = JSON.parse(stored);
                if (answers.soal10) {
                    selectedOption = answers.soal10;
                    updateVisuals();
                }
            }
        };

        function selectOption(choice) {
            selectedOption = choice;
            updateVisuals();
            saveState();
        }

        function updateVisuals() {
            const btnA = document.getElementById('btn-option-A');
            const btnB = document.getElementById('btn-option-B');

            if (selectedOption === 'A') {
                btnA.style.backgroundColor = '#FFF5B8'; // Selection color
                btnA.style.borderColor = '#FFF5B8';

                btnB.style.backgroundColor = 'white';
                btnB.style.borderColor = '#000000';
            } else if (selectedOption === 'B') {
                btnB.style.backgroundColor = '#FFF5B8'; // Selection color
                btnB.style.borderColor = '#FFF5B8';

                btnA.style.backgroundColor = 'white';
                btnA.style.borderColor = '#000000';
            } else {
                btnA.style.backgroundColor = 'white';
                btnA.style.borderColor = '#000000';
                btnB.style.backgroundColor = 'white';
                btnB.style.borderColor = '#000000';
            }
        }

        function saveState() {
            const stored = sessionStorage.getItem('evaluasi_answers') || '{}';
            const answers = JSON.parse(stored);
            answers.soal10 = selectedOption;
            sessionStorage.setItem('evaluasi_answers', JSON.stringify(answers));
        }

        function submitEvaluasi() {
            if (!selectedOption) {
                showAlert();
                return;
            }

            // Calculate final score
            const stored = sessionStorage.getItem('evaluasi_answers');
            let score = 0;

            if (stored) {
                const answers = JSON.parse(stored);

                // Soal 1
                if (answers.soal1 === 'A') {
                    score += 10;
                }
                // Soal 2
                if (answers.soal2 === 'B') {
                    score += 10;
                }
                // Soal 3
                if (answers.soal3 === 'C-D-B-A') {
                    score += 10;
                }
                // Soal 4
                if (answers.soal4 === '0-1-2-3-4-5-6-7-8') {
                    score += 10;
                }
                // Soal 5
                if (answers.soal5 && answers.soal5['A'] === '2' && answers.soal5['B'] === '3' && answers.soal5['C'] ===
                    '1') {
                    score += 10;
                }
                // Soal 6
                if (answers.soal6 === 'Abdul-Ikut-Kerja Bakti-Di Sekolah') {
                    score += 10;
                }
                // Soal 7
                if (answers.soal7 === 'A') {
                    score += 10;
                }
                // Soal 8
                if (answers.soal8 &&
                    answers.soal8['gambus'] === 'gambus' &&
                    answers.soal8['pacu_jalur'] === 'pacu_jalur' &&
                    answers.soal8['selaso_jatuh'] === 'selaso_jatuh') {
                    score += 10;
                }
                // Soal 9
                if (answers.soal9 === 'up') {
                    score += 10;
                }
                // Soal 10
                if (answers.soal10 === 'A') {
                    score += 10;
                }
            }

            finalComputedScore = score;
            showScoreModal(score);
        }

        function showScoreModal(score) {
            const cardEl = document.getElementById('score-card');
            const scoreValEl = document.getElementById('final-score-val');

            scoreValEl.innerText = score;

            // Tailor the success card style based on performance
            if (score >= 80) {
                cardEl.style.backgroundColor = '#D4F1BE'; // Success Mint Green
            } else if (score >= 60) {
                cardEl.style.backgroundColor = '#FFF5B8'; // Bright Yellow
            } else {
                cardEl.style.backgroundColor = '#FFD1E3'; // Soft Pink
            }

            const modal = document.getElementById('success-modal');
            const content = document.getElementById('success-modal-content');

            modal.classList.remove('hidden');
            modal.classList.add('flex');
            void modal.offsetWidth;
            modal.classList.remove('opacity-0');
            content.classList.remove('scale-90');
            content.classList.add('scale-100');
        }

        function finishAndSave() {
            const saveBtn = document.getElementById('btn-save-progress');
            saveBtn.disabled = true;
            saveBtn.style.opacity = '0.7';

            const answers = JSON.parse(sessionStorage.getItem('evaluasi_answers') || '{}');
            const answersDetail = {
                "1": answers.soal1 === 'A',
                "2": answers.soal2 === 'B',
                "3": answers.soal3 === 'C-D-B-A',
                "4": answers.soal4 === '0-1-2-3-4-5-6-7-8',
                "5": answers.soal5 && answers.soal5['A'] === '2' && answers.soal5['B'] === '3' && answers.soal5['C'] ===
                    '1',
                "6": answers.soal6 === 'Abdul-Ikut-Kerja Bakti-Di Sekolah',
                "7": answers.soal7 === 'A',
                "8": answers.soal8 && answers.soal8['gambus'] === 'gambus' && answers.soal8['pacu_jalur'] ===
                    'pacu_jalur' && answers.soal8['selaso_jatuh'] === 'selaso_jatuh',
                "9": answers.soal9 === 'up',
                "10": answers.soal10 === 'A'
            };

            // Post to backend API
            fetch('{{ route('materi.save_progress') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        materi_id: 1,
                        tahap: 7,
                        score: finalComputedScore,
                        answers: answersDetail
                    })
                })
                .then(res => res.json())
                .then(data => {
                    console.log("Progress saved:", data.message);
                    sessionStorage.removeItem('evaluasi_answers'); // clear answer cache
                    window.location.href = "{{ route('dashboard') }}";
                })
                .catch(err => {
                    console.error("Gagal mengirim nilai:", err);
                    sessionStorage.removeItem('evaluasi_answers');
                    window.location.href = "{{ route('dashboard') }}";
                });
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
