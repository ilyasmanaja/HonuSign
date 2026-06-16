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

        .slot-active {
            background-color: #FFF9F0 !important;
            border-style: dashed !important;
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
            <div class="text-center mb-6">
                <span
                    class="inline-block px-4 py-1.5 bg-[#FFF5B8] brutal-border brutal-shadow-sm rounded-xl text-xs font-black uppercase tracking-wider mb-3">Spasial</span>
                <h2 class="text-2xl md:text-3xl font-black text-black leading-snug">
                    Urutkan gambar berikut hingga menjadi urutan kegiatan membersihkan sekolah yang benar!
                </h2>
                <p class="text-sm text-slate-500 mt-2 font-bold uppercase tracking-widest">💡 Klik gambar di atas untuk
                    memasukkan ke dalam kotak angka!</p>
            </div>

            <!-- Scrambled Sources -->
            <div class="mb-8 bg-[#BEE9E8] brutal-border brutal-shadow rounded-[2rem] p-6">
                <h3 class="text-center font-black uppercase text-sm mb-4 tracking-wider text-slate-800">Pilihan Gambar
                </h3>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 justify-items-center">
                    @foreach (['A' => 'halaman_bersih.png', 'B' => 'buang_sampah.png', 'C' => 'menyapu_halaman.png', 'D' => 'kumpul_sampah.png'] as $letter => $imageName)
                        <button onclick="clickSource('{{ $letter }}')" id="source-{{ $letter }}"
                            class="w-full max-w-[140px] aspect-square bg-white brutal-border brutal-shadow-sm rounded-2xl overflow-hidden relative hover:-translate-y-1 transition-all duration-300 cursor-pointer">
                            @php
                                $imagePath = 'images/evaluasi/' . $imageName;
                                $fileExists = file_exists(public_path($imagePath));
                            @endphp
                            @if ($fileExists)
                                <img src="{{ asset($imagePath) }}" alt="{{ $letter }}"
                                    class="w-full h-full object-cover">
                            @else
                                <div
                                    class="w-full h-full flex flex-col items-center justify-center p-2 bg-[#FFF9F0] text-center text-black">
                                    <span class="text-2xl mb-1">🖼️</span>
                                    <span
                                        class="font-black text-[9px] uppercase tracking-wider text-slate-700">Aset:</span>
                                    <span
                                        class="font-bold text-[10px] bg-white px-1 py-0.5 brutal-border shadow-sm mt-1 font-mono text-slate-800 break-all select-all">{{ $imageName }}</span>
                                </div>
                            @endif
                            <div
                                class="absolute top-2 left-2 w-7 h-7 rounded-xl flex items-center justify-center font-black text-black border-2 border-black text-xs bg-[#FFF5B8]">
                                {{ $letter }}
                            </div>
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Sorted Slots -->
            <div class="bg-[#FFF9F0] brutal-border brutal-shadow rounded-[2rem] p-6">
                <h3 class="text-center font-black uppercase text-sm mb-4 tracking-wider text-slate-800">Urutan Kamu</h3>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 justify-items-center">
                    @for ($i = 1; $i <= 4; $i++)
                        <div id="slot-container-{{ $i }}"
                            class="w-full max-w-[140px] aspect-square rounded-2xl brutal-border border-4 border-dashed border-slate-400 bg-white flex flex-col items-center justify-center relative relative">
                            <span class="text-3xl font-black text-slate-300 select-none">{{ $i }}</span>
                            <!-- Placeholder for slotted item -->
                            <div id="slot-content-{{ $i }}" class="absolute inset-0 hidden"></div>
                        </div>
                    @endfor
                </div>
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
            <h3 class="text-2xl font-black text-black mb-3 uppercase">Urutkan Semua!</h3>
            <p class="text-slate-600 font-bold mb-6">Silakan urutkan keempat gambar di atas ke dalam semua kotak
                terlebih dahulu.</p>
            <button onclick="closeAlert()"
                class="w-full bg-[#FFF5B8] brutal-border brutal-shadow-sm brutal-hover py-3 rounded-xl font-black uppercase text-sm">
                Mengerti 👍
            </button>
        </div>
    </div>

    <script>
        // Store ordered letters
        let currentOrder = [null, null, null, null];
        const imageAssets = {
            'A': 'halaman_bersih.png',
            'B': 'buang_sampah.png',
            'C': 'menyapu_halaman.png',
            'D': 'kumpul_sampah.png'
        };
        const fileExists = {
            'A': {{ file_exists(public_path('images/evaluasi/halaman_bersih.png')) ? 'true' : 'false' }},
            'B': {{ file_exists(public_path('images/evaluasi/buang_sampah.png')) ? 'true' : 'false' }},
            'C': {{ file_exists(public_path('images/evaluasi/menyapu_halaman.png')) ? 'true' : 'false' }},
            'D': {{ file_exists(public_path('images/evaluasi/kumpul_sampah.png')) ? 'true' : 'false' }}
        };

        window.onload = function() {
            // Restore from sessionStorage if exists
            const stored = sessionStorage.getItem('evaluasi_answers');
            if (stored) {
                const answers = JSON.parse(stored);
                if (answers.soal3) {
                    const letters = answers.soal3.split('-');
                    if (letters.length === 4) {
                        letters.forEach((l, i) => {
                            if (l) {
                                placeLetterInSlot(l, i + 1);
                            }
                        });
                    }
                }
            }
        };

        function clickSource(letter) {
            // Check if already in a slot
            if (currentOrder.includes(letter)) {
                // If clicked from source but it is in a slot, we do nothing or we remove it
                const slotIndex = currentOrder.indexOf(letter);
                removeLetterFromSlot(slotIndex + 1);
                return;
            }

            // Find first empty slot
            const emptyIdx = currentOrder.indexOf(null);
            if (emptyIdx > -1) {
                placeLetterInSlot(letter, emptyIdx + 1);
                saveState();
            }
        }

        function placeLetterInSlot(letter, slotNum) {
            currentOrder[slotNum - 1] = letter;

            // Hide source card visually
            const sourceCard = document.getElementById('source-' + letter);
            sourceCard.style.opacity = '0.3';
            sourceCard.style.pointerEvents = 'none';

            // Show slotted content
            const slotContent = document.getElementById('slot-content-' + slotNum);
            slotContent.innerHTML = `
                <button onclick="removeLetterFromSlot(${slotNum})" class="w-full h-full bg-[#FFF5B8] brutal-border rounded-2xl overflow-hidden relative cursor-pointer flex items-center justify-center p-1">
                    ${fileExists[letter] ? `
                            <img src="/images/evaluasi/${imageAssets[letter]}" class="w-full h-full object-cover rounded-xl pointer-events-none">
                        ` : `
                            <div class="w-full h-full flex flex-col items-center justify-center bg-[#FFF9F0] text-center text-black pointer-events-none">
                                <span class="text-2xl mb-1">🖼️</span>
                                <span class="font-black text-[9px] uppercase tracking-wider text-slate-700">Aset:</span>
                                <span class="font-bold text-[10px] bg-white px-1 py-0.5 brutal-border mt-1 font-mono text-slate-800">${imageAssets[letter]}</span>
                            </div>
                        `}
                    <div class="absolute top-2 left-2 w-7 h-7 rounded-xl flex items-center justify-center font-black text-black border-2 border-black text-xs bg-[#BEE9E8]">
                        ${letter}
                    </div>
                </button>
            `;
            slotContent.classList.remove('hidden');
        }

        function removeLetterFromSlot(slotNum) {
            const letter = currentOrder[slotNum - 1];
            if (!letter) return;

            currentOrder[slotNum - 1] = null;

            // Show source card again
            const sourceCard = document.getElementById('source-' + letter);
            sourceCard.style.opacity = '1';
            sourceCard.style.pointerEvents = 'auto';

            // Hide slot content
            const slotContent = document.getElementById('slot-content-' + slotNum);
            slotContent.classList.add('hidden');
            slotContent.innerHTML = '';

            saveState();
        }

        function saveState() {
            const stored = sessionStorage.getItem('evaluasi_answers') || '{}';
            const answers = JSON.parse(stored);
            answers.soal3 = currentOrder.join('-');
            sessionStorage.setItem('evaluasi_answers', JSON.stringify(answers));
        }

        function goNext() {
            if (currentOrder.includes(null)) {
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
