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
                    class="inline-block px-4 py-1.5 bg-[#FFD1E3] brutal-border brutal-shadow-sm rounded-xl text-xs font-black uppercase tracking-wider mb-3">Literasi</span>
                <h2 class="text-2xl md:text-3xl font-black text-black leading-snug">
                    Gambar manakah yang menunjukkan sikap menghargai keberagaman agama?
                </h2>
                <p class="text-sm text-slate-500 mt-2 font-bold uppercase tracking-widest">💡 Pilih salah satu gambar!
                </p>
            </div>

            <!-- Choice Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 max-w-3xl mx-auto">
                <!-- Option A: Gotong Royong -->
                <button onclick="selectChoice('A')" id="card-A"
                    class="group relative overflow-hidden aspect-[4/3] brutal-border brutal-shadow rounded-[2rem] hover:-translate-y-1 transition-all duration-300 bg-white cursor-pointer select-none">
                    @php
                        $imageName = 'gotong_royong.png';
                        $imagePath = 'images/evaluasi/' . $imageName;
                        $fileExists = file_exists(public_path($imagePath));
                    @endphp
                    @if ($fileExists)
                        <img src="{{ asset($imagePath) }}" alt="Gotong Royong"
                            class="w-full h-full object-cover group-hover:scale-105 transition-all duration-300">
                    @else
                        <div
                            class="w-full h-full flex flex-col items-center justify-center p-4 bg-[#BEE9E8] text-center text-black">
                            <span class="text-4xl mb-2">💪</span>
                            <span class="font-black text-xs uppercase tracking-wider text-slate-700">Aset Gambar
                                Butuh:</span>
                            <span
                                class="font-bold text-sm bg-white px-2.5 py-1 brutal-border shadow-sm mt-2 font-mono text-slate-800 break-all select-all">{{ $imageName }}</span>
                        </div>
                    @endif
                    <div
                        class="absolute top-4 left-4 w-10 h-10 rounded-2xl flex items-center justify-center font-black text-black border-2 border-black text-sm bg-[#BEE9E8] id-badge">
                        A
                    </div>
                    <!-- Selected Checkmark Icon -->
                    <div id="check-A"
                        class="hidden absolute top-4 right-4 w-10 h-10 rounded-2xl items-center justify-center font-black text-black border-2 border-black bg-[#D4F1BE]">
                        ✓
                    </div>
                </button>

                <!-- Option B: Menghargai Agama (Correct Answer) -->
                <button onclick="selectChoice('B')" id="card-B"
                    class="group relative overflow-hidden aspect-[4/3] brutal-border brutal-shadow rounded-[2rem] hover:-translate-y-1 transition-all duration-300 bg-white cursor-pointer select-none">
                    @php
                        $imageName = 'menghargai_agama.png';
                        $imagePath = 'images/evaluasi/' . $imageName;
                        $fileExists = file_exists(public_path($imagePath));
                    @endphp
                    @if ($fileExists)
                        <img src="{{ asset($imagePath) }}" alt="Menghargai Agama"
                            class="w-full h-full object-cover group-hover:scale-105 transition-all duration-300">
                    @else
                        <div
                            class="w-full h-full flex flex-col items-center justify-center p-4 bg-[#FFD1E3] text-center text-black">
                            <span class="text-4xl mb-2">🤝</span>
                            <span class="font-black text-xs uppercase tracking-wider text-slate-700">Aset Gambar
                                Butuh:</span>
                            <span
                                class="font-bold text-sm bg-white px-2.5 py-1 brutal-border shadow-sm mt-2 font-mono text-slate-800 break-all select-all">{{ $imageName }}</span>
                        </div>
                    @endif
                    <div
                        class="absolute top-4 left-4 w-10 h-10 rounded-2xl flex items-center justify-center font-black text-black border-2 border-black text-sm bg-[#FFD1E3] id-badge">
                        B
                    </div>
                    <!-- Selected Checkmark Icon -->
                    <div id="check-B"
                        class="hidden absolute top-4 right-4 w-10 h-10 rounded-2xl items-center justify-center font-black text-black border-2 border-black bg-[#D4F1BE]">
                        ✓
                    </div>
                </button>

                <!-- Option C: Berbicara saat Sholat -->
                <button onclick="selectChoice('C')" id="card-C"
                    class="group relative overflow-hidden aspect-[4/3] brutal-border brutal-shadow rounded-[2rem] hover:-translate-y-1 transition-all duration-300 bg-white cursor-pointer select-none">
                    @php
                        $imageName = 'berbicara_saat_solat.png';
                        $imagePath = 'images/evaluasi/' . $imageName;
                        $fileExists = file_exists(public_path($imagePath));
                    @endphp
                    @if ($fileExists)
                        <img src="{{ asset($imagePath) }}" alt="Berbicara Saat Sholat"
                            class="w-full h-full object-cover group-hover:scale-105 transition-all duration-300">
                    @else
                        <div
                            class="w-full h-full flex flex-col items-center justify-center p-4 bg-[#FFF5B8] text-center text-black">
                            <span class="text-4xl mb-2">💬</span>
                            <span class="font-black text-xs uppercase tracking-wider text-slate-700">Aset Gambar
                                Butuh:</span>
                            <span
                                class="font-bold text-sm bg-white px-2.5 py-1 brutal-border shadow-sm mt-2 font-mono text-slate-800 break-all select-all">{{ $imageName }}</span>
                        </div>
                    @endif
                    <div
                        class="absolute top-4 left-4 w-10 h-10 rounded-2xl flex items-center justify-center font-black text-black border-2 border-black text-sm bg-[#FFF5B8] id-badge">
                        C
                    </div>
                    <!-- Selected Checkmark Icon -->
                    <div id="check-C"
                        class="hidden absolute top-4 right-4 w-10 h-10 rounded-2xl items-center justify-center font-black text-black border-2 border-black bg-[#D4F1BE]">
                        ✓
                    </div>
                </button>

                <!-- Option D: Mengganggu Ibadah -->
                <button onclick="selectChoice('D')" id="card-D"
                    class="group relative overflow-hidden aspect-[4/3] brutal-border brutal-shadow rounded-[2rem] hover:-translate-y-1 transition-all duration-300 bg-white cursor-pointer select-none">
                    @php
                        $imageName = 'ganggu_ibadah.png';
                        $imagePath = 'images/evaluasi/' . $imageName;
                        $fileExists = file_exists(public_path($imagePath));
                    @endphp
                    @if ($fileExists)
                        <img src="{{ asset($imagePath) }}" alt="Mengganggu Ibadah"
                            class="w-full h-full object-cover group-hover:scale-105 transition-all duration-300">
                    @else
                        <div
                            class="w-full h-full flex flex-col items-center justify-center p-4 bg-[#E0BBE4] text-center text-black">
                            <span class="text-4xl mb-2">🚫</span>
                            <span class="font-black text-xs uppercase tracking-wider text-slate-700">Aset Gambar
                                Butuh:</span>
                            <span
                                class="font-bold text-sm bg-white px-2.5 py-1 brutal-border shadow-sm mt-2 font-mono text-slate-800 break-all select-all">{{ $imageName }}</span>
                        </div>
                    @endif
                    <div
                        class="absolute top-4 left-4 w-10 h-10 rounded-2xl flex items-center justify-center font-black text-black border-2 border-black text-sm bg-[#E0BBE4] id-badge">
                        D
                    </div>
                    <!-- Selected Checkmark Icon -->
                    <div id="check-D"
                        class="hidden absolute top-4 right-4 w-10 h-10 rounded-2xl items-center justify-center font-black text-black border-2 border-black bg-[#D4F1BE]">
                        ✓
                    </div>
                </button>
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
            <h3 class="text-2xl font-black text-black mb-3 uppercase">Pilih Jawaban!</h3>
            <p class="text-slate-600 font-bold mb-6">Silakan pilih salah satu jawaban terlebih dahulu sebelum
                melanjutkan.</p>
            <button onclick="closeAlert()"
                class="w-full bg-[#FFF5B8] brutal-border brutal-shadow-sm brutal-hover py-3 rounded-xl font-black uppercase text-sm">
                Mengerti 👍
            </button>
        </div>
    </div>

    <script>
        let selectedChoice = null;
        const options = ['A', 'B', 'C', 'D'];

        window.onload = function() {
            // Restore from sessionStorage if exists
            const stored = sessionStorage.getItem('evaluasi_answers');
            if (stored) {
                const answers = JSON.parse(stored);
                if (answers.soal2) {
                    selectedChoice = answers.soal2;
                    updateVisuals();
                }
            }
        };

        function selectChoice(choice) {
            selectedChoice = choice;
            updateVisuals();
            saveState();
        }

        function updateVisuals() {
            options.forEach(opt => {
                const card = document.getElementById('card-' + opt);
                const check = document.getElementById('check-' + opt);

                if (opt === selectedChoice) {
                    // Apply selection background and show checkmark overlay
                    card.style.backgroundColor = '#FFF5B8';
                    card.style.borderColor = '#FFF5B8';
                    check.classList.remove('hidden');
                    check.classList.add('flex');
                } else {
                    card.style.backgroundColor = 'white';
                    card.style.borderColor = '#000000';
                    check.classList.remove('flex');
                    check.classList.add('hidden');
                }
            });
        }

        function saveState() {
            const stored = sessionStorage.getItem('evaluasi_answers') || '{}';
            const answers = JSON.parse(stored);
            answers.soal2 = selectedChoice;
            sessionStorage.setItem('evaluasi_answers', JSON.stringify(answers));
        }

        function goNext() {
            if (!selectedChoice) {
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
