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

        <div
            class="w-full bg-[#FFFEFA] brutal-border brutal-shadow rounded-[2.5rem] p-6 md:p-10 mb-8 transition-all duration-300">
            <div class="text-center mb-8">
                <span
                    class="inline-block px-4 py-1.5 bg-[#FFF5B8] brutal-border brutal-shadow-sm rounded-xl text-xs font-black uppercase tracking-wider mb-3">Spasial</span>
                <h2 class="text-2xl md:text-3xl font-black text-black leading-snug">
                    Menjaga kebersihan sekolah bersama-sama adalah perbuatan yang...?
                </h2>
                <p class="text-sm text-slate-500 mt-2 font-bold uppercase tracking-widest">💡 Pilih salah satu tombol
                    jempol di bawah!</p>
            </div>

            <!-- Image display card -->
            <div
                class="w-full max-w-xl mx-auto mb-10 bg-white brutal-border brutal-shadow rounded-3xl overflow-hidden aspect-[16/9] relative">
                @php
                    $imageName = 'kerja_bakti.png';
                    $imagePath = 'images/evaluasi/' . $imageName;
                    $fileExists = file_exists(public_path($imagePath));
                @endphp
                @if ($fileExists)
                    <img src="{{ asset($imagePath) }}" alt="Anak Kerja Bakti" class="w-full h-full object-cover">
                @else
                    <div
                        class="w-full h-full flex flex-col items-center justify-center p-6 bg-[#D4F1BE] text-center text-black">
                        <span class="text-5xl mb-2">🧹🏫</span>
                        <span class="font-black text-xs uppercase tracking-wider text-slate-700">Aset Gambar
                            Butuh:</span>
                        <span
                            class="font-bold text-sm bg-white px-2.5 py-1 brutal-border shadow-sm mt-2 font-mono text-slate-800 break-all select-all">{{ $imageName }}</span>
                    </div>
                @endif
            </div>

            <!-- Gesture Buttons -->
            <div class="flex flex-col sm:flex-row gap-8 max-w-md mx-auto">
                <!-- Thumbs Up -->
                <button onclick="selectGesture('up')" id="btn-up"
                    class="flex-1 p-6 bg-white hover:bg-slate-50 brutal-border brutal-shadow brutal-hover rounded-[2rem] flex flex-col items-center justify-center gap-3 cursor-pointer select-none">
                    <span class="text-6xl animate-bounce" style="animation-duration: 2s;">👍</span>
                    <span class="font-black text-xl text-green-700 uppercase tracking-widest">Bagus</span>
                </button>

                <!-- Thumbs Down -->
                <button onclick="selectGesture('down')" id="btn-down"
                    class="flex-1 p-6 bg-white hover:bg-slate-50 brutal-border brutal-shadow brutal-hover rounded-[2rem] flex flex-col items-center justify-center gap-3 cursor-pointer select-none">
                    <span class="text-6xl">👎</span>
                    <span class="font-black text-xl text-red-600 uppercase tracking-widest">Buruk</span>
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
                <button id="btn-next" onclick="goNext()"
                    class="bg-[#D4F1BE] brutal-border brutal-shadow-sm brutal-hover text-black px-8 py-4 rounded-2xl font-black uppercase text-base flex items-center gap-2">
                    Lanjut
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        class="w-5 h-5 text-black fill-none stroke-current" stroke-width="3.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </button>
                <div class="pointer-events-none absolute bottom-full left-1/2 -translate-x-1/2 mb-3 bg-[#FFD1E3] brutal-border brutal-shadow-sm px-3 py-1.5 rounded-lg text-sm font-bold opacity-0 scale-95 group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-150 whitespace-nowrap z-50 text-black">
                    Selanjutnya
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
            <h3 class="text-2xl font-black text-black mb-3 uppercase">Pilih Penilaian!</h3>
            <p class="text-slate-600 font-bold mb-6">Silakan pilih penilaian perbuatan terlebih dahulu sebelum
                melanjutkan.</p>
            <button onclick="closeAlert()"
                class="w-full bg-[#FFF5B8] brutal-border brutal-shadow-sm brutal-hover py-3 rounded-xl font-black uppercase text-sm">
                Mengerti 👍
            </button>
        </div>
    </div>

    <script>
        let selectedGesture = null;

        window.onload = function() {
            // Restore from sessionStorage if exists
            const stored = sessionStorage.getItem('evaluasi_answers');
            if (stored) {
                const answers = JSON.parse(stored);
                if (answers.soal9) {
                    selectedGesture = answers.soal9;
                    updateVisuals();
                }
            }
        };

        function selectGesture(gesture) {
            selectedGesture = gesture;
            updateVisuals();
            saveState();
        }

        function updateVisuals() {
            const btnUp = document.getElementById('btn-up');
            const btnDown = document.getElementById('btn-down');

            if (selectedGesture === 'up') {
                btnUp.style.backgroundColor = '#FFF5B8'; // Selection color
                btnUp.style.borderColor = '#FFF5B8';

                btnDown.style.backgroundColor = 'white';
                btnDown.style.borderColor = '#000000';
            } else if (selectedGesture === 'down') {
                btnDown.style.backgroundColor = '#FFF5B8'; // Selection color
                btnDown.style.borderColor = '#FFF5B8';

                btnUp.style.backgroundColor = 'white';
                btnUp.style.borderColor = '#000000';
            } else {
                btnUp.style.backgroundColor = 'white';
                btnUp.style.borderColor = '#000000';
                btnDown.style.backgroundColor = 'white';
                btnDown.style.borderColor = '#000000';
            }
        }

        function saveState() {
            const stored = sessionStorage.getItem('evaluasi_answers') || '{}';
            const answers = JSON.parse(stored);
            answers.soal9 = selectedGesture;
            sessionStorage.setItem('evaluasi_answers', JSON.stringify(answers));
        }

        function goNext() {
            if (!selectedGesture) {
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
