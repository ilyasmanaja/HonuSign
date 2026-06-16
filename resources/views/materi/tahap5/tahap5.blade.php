<x-student-layout>
    <!-- Interactive Visual Tutorial Overlay -->
    <div id="tutorial-overlay"
        class="fixed inset-0 bg-slate-900/80 backdrop-blur-md z-[5000] flex items-center justify-center p-4 transition-opacity duration-500 opacity-0 pointer-events-none">
        <div class="bg-[#FFFEFA] brutal-border brutal-shadow p-8 md:p-12 rounded-[3rem] max-w-xl w-full flex flex-col items-center text-center relative transform scale-90 transition-transform duration-500"
            id="tutorial-modal-content">

            <div
                class="bg-[#FFF5B8] px-6 py-2 rounded-2xl brutal-border brutal-shadow-sm font-black text-sm mb-6 -rotate-2 text-black">
                AKTIVITAS MANDIRI
            </div>

            <h2 class="text-3xl md:text-4xl font-black text-black tracking-tight mb-6">
                Ayo Memilah Perilaku!
            </h2>

            <!-- Drag Demonstration Animation -->
            <div
                class="relative w-full max-w-sm h-64 bg-[#BEE9E8] brutal-border rounded-[2rem] p-4 mb-8 mx-auto overflow-hidden shadow-inner">
                <!-- Drop Box (Top) -->
                <div class="absolute top-4 left-4 right-4 flex justify-between gap-4">
                    <div class="w-1/2 h-16 bg-[#D4F1BE] brutal-border rounded-xl flex items-center justify-center text-xs font-black text-black text-center p-1 shadow-sm transition-all duration-300"
                        id="sim-box-positif">Cinta Tanah Air </div>
                    <div class="w-1/2 h-16 bg-[#FFB3B3] brutal-border rounded-xl flex items-center justify-center text-xs font-black text-black text-center p-1 shadow-sm transition-all duration-300"
                        id="sim-box-negatif">Tidak Cinta </div>
                </div>
                <!-- Cards and hand dragging (Bottom) -->
                <!-- Green card (positive) on the left -->
                <div id="sim-card-green"
                    class="bg-[#D4F1BE] p-2 brutal-border rounded-xl shadow-md text-[10px] font-black text-black z-10 w-28 text-center absolute transition-all duration-500"
                    style="top: 150px; left: 6%; width: 42%;">
                    Upacara Khidmat
                </div>
                <!-- Red card (negative) on the right -->
                <div id="sim-card-red"
                    class="bg-[#FFB3B3] p-2 brutal-border rounded-xl shadow-md text-[10px] font-black text-black z-10 w-28 text-center absolute transition-all duration-500"
                    style="top: 150px; left: 52%; width: 42%;">
                    Buang Sampah Sembarangan
                </div>
                <!-- Hand Cursor Icon -->
                <span id="sim-cursor" class="text-4xl absolute z-20 transition-all duration-500"
                    style="top: 175px; left: 45%;">👇</span>
            </div>

            <!-- Penjelasan Teks -->
            <div class="flex flex-col gap-4 text-left w-full bg-[#F8FAFC] brutal-border p-6 rounded-2xl mb-8 shadow-sm">
                <div class="flex items-start gap-3">
                    <span
                        class="bg-[#FFF5B8] w-8 h-8 rounded-xl brutal-border flex items-center justify-center font-black text-black text-sm shrink-0 mt-0.5">1</span>
                    <p class="font-bold text-slate-700 text-sm md:text-base"><b>Seret Kartu</b>: Sentuh dan geser kartu
                        perilaku di bawah ini.</p>
                </div>
                <div class="flex items-start gap-3">
                    <span
                        class="bg-[#D4F1BE] w-8 h-8 rounded-xl brutal-border flex items-center justify-center font-black text-black text-sm shrink-0 mt-0.5">2</span>
                    <p class="font-bold text-slate-700 text-sm md:text-base"><b>Kelompokkan</b>: Masukkan ke kotak hijau
                        (Cinta Tanah Air) atau kotak merah (Tidak Cinta).</p>
                </div>
            </div>

            <!-- Confirm Button -->
            <div class="relative group/tooltip inline-block">
                <button onclick="closeTutorial()"
                    class="w-20 h-20 bg-[#D4F1BE] text-black rounded-full brutal-border brutal-shadow-sm brutal-hover flex items-center justify-center cursor-pointer animate-pulse">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        class="w-10 h-10 text-black fill-none stroke-current" stroke-width="3.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                </button>
                <div class="pointer-events-none absolute bottom-full left-1/2 -translate-x-1/2 mb-3 bg-[#FFD1E3] brutal-border brutal-shadow-sm px-3 py-1.5 rounded-lg text-sm font-bold opacity-0 scale-95 group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-150 whitespace-nowrap z-50 text-black">
                    Mulai Belajar
                </div>
            </div>
        </div>
    </div>

    <!-- Victory Success Modal -->
    <div id="victory-modal"
        class="fixed inset-0 bg-slate-900/80 backdrop-blur-md hidden flex-col items-center justify-center opacity-0 transition-all duration-300 z-[8000]">
        <div class="relative w-full max-w-[480px] aspect-square transform scale-90 transition-transform duration-500 select-none mx-4"
            id="victory-modal-content">

            <!-- Main Image -->
            <img src="{{ asset('images/selamat.png') }}" alt="Selamat!"
                class="w-full h-full object-contain rounded-[3rem] brutal-border brutal-shadow">

            <!-- Interactive Buttons Overlaid over pre-rendered spots -->
            <div class="absolute bottom-[9%] left-0 right-0 flex justify-center gap-[8%]">
                <!-- Replay Button -->
                <div class="relative group/tooltip inline-block w-[18%] aspect-square">
                    <button onclick="resetGame()" aria-label="Ulangi"
                        class="bg-[#FFF5B8] text-black w-full h-full rounded-2xl brutal-border brutal-shadow-sm brutal-hover flex items-center justify-center cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            class="w-1/2 h-1/2 text-black fill-none stroke-current" stroke-width="3.5"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21.5 2v6h-6M21.34 15.57a10 10 0 1 1-.57-8.38l.57-1.19" />
                        </svg>
                    </button>
                    <div class="pointer-events-none absolute bottom-full left-1/2 -translate-x-1/2 mb-3 bg-[#FFD1E3] brutal-border brutal-shadow-sm px-3 py-1.5 rounded-lg text-sm font-bold opacity-0 scale-95 group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-150 whitespace-nowrap z-50 text-black">
                        Main Lagi
                    </div>
                </div>
                <!-- Next Button -->
                <div class="relative group/tooltip inline-block w-[18%] aspect-square">
                    <button id="next-stage-btn" onclick="goToNextStage()" aria-label="Lanjut"
                        class="bg-[#D4F1BE] text-black w-full h-full rounded-2xl brutal-border brutal-shadow-sm brutal-hover flex items-center justify-center cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            class="w-1/2 h-1/2 text-black fill-none stroke-current" stroke-width="3.5"
                            stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </button>
                    <div class="pointer-events-none absolute bottom-full left-1/2 -translate-x-1/2 mb-3 bg-[#FFD1E3] brutal-border brutal-shadow-sm px-3 py-1.5 rounded-lg text-sm font-bold opacity-0 scale-95 group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-150 whitespace-nowrap z-50 text-black">
                        Lanjut
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Correct / Success Toast Popup -->
    <div id="success-toast"
        class="fixed inset-0 flex items-center justify-center z-[9000] pointer-events-none hidden transition-all duration-300 opacity-0 scale-90">
        <div
            class="bg-[#D4F1BE] brutal-border brutal-shadow p-8 rounded-[2.5rem] flex flex-col items-center gap-4 text-center max-w-sm w-full mx-4">
            <!-- Icon Ceklis -->
            <div
                class="w-20 h-20 bg-green-500 rounded-full flex items-center justify-center brutal-border brutal-shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="w-12 h-12 text-black">
                    <circle cx="12" cy="12" r="10" opacity="0.2" />
                    <path d="M10 15.172l-3.5-3.5-1.414 1.414 4.914 4.914 9.9-9.9-1.414-1.414z" />
                </svg>
            </div>
            <h4 class="text-3xl font-black text-black tracking-wider mt-2">BENAR</h4>
        </div>
    </div>

    <!-- Incorrect / Error Toast Popup -->
    <div id="error-toast"
        class="fixed inset-0 flex items-center justify-center z-[9000] pointer-events-none hidden transition-all duration-300 opacity-0 scale-90">
        <div
            class="bg-[#FFB3B3] brutal-border brutal-shadow p-8 rounded-[2.5rem] flex flex-col items-center gap-4 text-center max-w-sm w-full mx-4">
            <!-- Icon Silang -->
            <div
                class="w-20 h-20 bg-red-500 rounded-full flex items-center justify-center brutal-border brutal-shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="w-12 h-12 text-black">
                    <path
                        d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z" />
                </svg>
            </div>
            <h4 class="text-3xl font-black text-black tracking-wider mt-2">SALAH</h4>
        </div>
    </div>

    <div class="max-w-5xl w-full px-6 py-12 flex flex-col items-center">

        <!-- Progress Bar -->
        <div class="w-full mb-10 max-w-3xl">
            <div class="flex justify-between mb-4 items-end">
                <span class="font-black text-xl tracking-widest uppercase text-black">Memahami</span>
            </div>
            <div class="w-full h-8 bg-white brutal-border brutal-shadow-sm rounded-2xl overflow-hidden p-1">
                <div class="h-full bg-[#FFD1E3] rounded-xl transition-all duration-1000 border-r-4 border-black"
                    style="width: 83.3%"></div>
            </div>
        </div>

        <!-- Header Judul -->
        <div class="text-center mb-10">
            <h1
                class="text-4xl md:text-5xl font-black text-black uppercase tracking-tighter transform -rotate-1 mb-2 flex justify-center items-center gap-3">
                Ayo Kita <span class="text-[#FFD1E3] text-outline drop-shadow-[0_4px_0_#000]">Memahami</span>!
            </h1>
        </div>

        <!-- Kontainer Utama -->
        <div class="w-full bg-[#FFD1E3] brutal-border brutal-shadow rounded-[3rem] p-6 md:p-8 mb-10">
            <div class="bg-[#FFFEFA] brutal-border brutal-shadow-sm rounded-[2rem] p-6 md:p-10">

                <!-- Header Card (Centered, No Icon) -->
                <div class="flex justify-center mb-8 border-b-4 border-slate-200 pb-6">
                    <h3 class="font-black text-black uppercase tracking-widest text-xl md:text-2xl text-center">Cinta
                        &amp; Tidak Cinta Tanah Air</h3>
                </div>

                <p class="text-xl text-slate-700 leading-relaxed font-bold mb-10 text-center">
                    Tarik dan kelompokkan setiap perilaku di bawah ini ke kotak yang benar!
                </p>

                <!-- Drop Zones Boxes (at the top) -->
                <div class="flex flex-col md:flex-row gap-8 justify-between w-full mb-10">
                    <!-- Positive Box -->
                    <div id="box-positif"
                        class="brutal-border brutal-shadow rounded-[3rem] p-6 flex flex-col items-center justify-start min-h-[350px] w-full md:w-1/2 bg-[#D4F1BE] transition-transform duration-300">
                        <h4
                            class="font-black text-black uppercase tracking-wider text-lg md:text-xl text-center border-b-4 border-black pb-2 w-full mb-4">
                            Cinta Tanah Air
                        </h4>
                        <!-- List area -->
                        <div id="list-positif"
                            class="w-full flex flex-col gap-3 overflow-y-auto flex-grow max-h-[300px] p-2">
                            <!-- Correctly sorted cards will land here -->
                        </div>
                    </div>

                    <!-- Negative Box -->
                    <div id="box-negatif"
                        class="brutal-border brutal-shadow rounded-[3rem] p-6 flex flex-col items-center justify-start min-h-[350px] w-full md:w-1/2 bg-[#FFB3B3] transition-transform duration-300">
                        <h4
                            class="font-black text-black uppercase tracking-wider text-lg md:text-xl text-center border-b-4 border-black pb-2 w-full mb-4">
                            Tidak Cinta Tanah Air
                        </h4>
                        <!-- List area -->
                        <div id="list-negatif"
                            class="w-full flex flex-col gap-3 overflow-y-auto flex-grow max-h-[300px] p-2">
                            <!-- Correctly sorted cards will land here -->
                        </div>
                    </div>
                </div>

                <!-- Pool of Draggable Cards (at the bottom) -->
                <div class="w-full flex flex-col items-center mt-6">
                    <p class="font-black text-black text-lg md:text-xl uppercase tracking-wider mb-4">Tarik Kartu di
                        Bawah Ini:</p>
                    <div id="cards-pool"
                        class="flex flex-wrap justify-center gap-6 max-w-4xl min-h-[14rem] items-center p-6 bg-slate-50 rounded-[2rem] border-4 border-dashed border-slate-200 w-full">
                        @php
                            $keberagaman = [
                                [
                                    'id' => 1,
                                    'judul' => 'Amir mengikuti upacara dengan khidmat',
                                    'gambar' => 'upacara_bendera.png',
                                    'color' => '#D4F1BE',
                                    'positif' => true,
                                ],
                                [
                                    'id' => 2,
                                    'judul' => 'Abdul mencoret-coret dinding kelas',
                                    'gambar' => 'coret_tembok.png',
                                    'color' => '#FFB3B3',
                                    'positif' => false,
                                ],
                                [
                                    'id' => 3,
                                    'judul' => 'Okta membuang sampah pada tempatnya',
                                    'gambar' => 'okta_sampah.png',
                                    'color' => '#D4F1BE',
                                    'positif' => true,
                                ],
                                [
                                    'id' => 4,
                                    'judul' => 'Ariva membuang sampah di Sungai',
                                    'gambar' => 'buang_sampah.png',
                                    'color' => '#FFB3B3',
                                    'positif' => false,
                                ],
                                [
                                    'id' => 5,
                                    'judul' => 'Okta berbicara keras saat teman beribadah',
                                    'gambar' => 'bicara_solat.png',
                                    'color' => '#FFB3B3',
                                    'positif' => false,
                                ],
                                [
                                    'id' => 6,
                                    'judul' => 'Sisca melaksanakan piket dengan sungguh',
                                    'gambar' => 'siska_piket.png',
                                    'color' => '#D4F1BE',
                                    'positif' => true,
                                ],
                            ];
                            shuffle($keberagaman);
                        @endphp

                        @foreach ($keberagaman as $idx => $item)
                            <div id="card-{{ $idx }}"
                                data-positif="{{ $item['positif'] ? 'true' : 'false' }}" data-id="{{ $item['id'] }}"
                                class="drag-card cursor-grab active:cursor-grabbing brutal-border brutal-shadow-sm rounded-[2rem] overflow-hidden select-none w-52 flex-shrink-0 bg-white hover:scale-105 transition-all duration-200 touch-none relative z-20"
                                data-title="{{ $item['judul'] }}"
                                data-gambar="{{ asset('images/tahap5/' . $item['gambar']) }}"
                                data-color="{{ $item['color'] }}">
                                <div
                                    class="w-full h-28 bg-[#FFFEFA] border-b-4 border-black overflow-hidden relative pointer-events-none">
                                    <img src="{{ asset('images/tahap5/' . $item['gambar']) }}"
                                        alt="{{ $item['judul'] }}"
                                        class="w-full h-full object-cover pointer-events-none"
                                        onerror="this.style.display='none'">
                                </div>
                                <div class="p-3 flex items-center justify-center min-h-[3.5rem] pointer-events-none">
                                    <p
                                        class="font-black text-black text-xs text-center leading-snug pointer-events-none">
                                        {{ $item['judul'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="w-full max-w-5xl flex justify-center gap-12 items-center mt-8 px-4">
            <!-- Tombol Keluar & Simpan (Visual House Icon) -->
            <div class="relative group/tooltip inline-block">
                <a href="{{ route('materi.index') }}" onclick="tandaiSelesai(event, this.href, 5)"
                    class="bg-[#FFB3B3] w-20 h-20 flex items-center justify-center brutal-border brutal-shadow-sm brutal-hover text-black rounded-full transform hover:-translate-y-2 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        class="w-10 h-10 text-black fill-none stroke-current" stroke-width="3.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                </a>
                <div class="pointer-events-none absolute bottom-full left-1/2 -translate-x-1/2 mb-3 bg-[#FFD1E3] brutal-border brutal-shadow-sm px-3 py-1.5 rounded-lg text-sm font-bold opacity-0 scale-95 group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-150 whitespace-nowrap z-50 text-black">
                    Keluar &amp; Simpan
                </div>
            </div>

            <!-- Tombol Lanjut (Visual Right Chevron Play Icon) -->
            <div class="relative group/tooltip inline-block">
                <a href="{{ route('materi.belajar', ['step' => 6]) }}" onclick="tandaiSelesai(event, this.href, 5)"
                    class="bg-[#D4F1BE] w-20 h-20 flex items-center justify-center brutal-border brutal-shadow-sm brutal-hover text-black rounded-full transform hover:-translate-y-2 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        class="w-10 h-10 text-black fill-none stroke-current" stroke-width="3.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
                <div class="pointer-events-none absolute bottom-full left-1/2 -translate-x-1/2 mb-3 bg-[#FFD1E3] brutal-border brutal-shadow-sm px-3 py-1.5 rounded-lg text-sm font-bold opacity-0 scale-95 group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-150 whitespace-nowrap z-50 text-black">
                    Lanjut
                </div>
            </div>
        </div>
    </div>

    <style>
        .drag-card {
            transition: transform 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.15), box-shadow 0.2s ease;
        }

        .drag-card:active {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        @keyframes demo-drag {

            0%,
            100% {
                transform: translate(0, 0);
            }

            50% {
                transform: translate(-60px, -95px);
            }
        }

        @keyframes demo-hand {

            0%,
            100% {
                transform: translate(10px, 40px);
            }

            50% {
                transform: translate(-70px, -50px);
            }
        }

        .animate-demo-drag {
            animation: demo-drag 3.5s ease-in-out infinite;
        }

        .animate-demo-hand {
            animation: demo-hand 3.5s ease-in-out infinite;
        }

        @keyframes bounce-short {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-8px);
            }
        }

        .animate-bounce-short {
            animation: bounce-short 0.4s ease-out;
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            20%,
            60% {
                transform: translateX(-6px);
            }

            40%,
            80% {
                transform: translateX(6px);
            }
        }

        .animate-shake {
            animation: shake 0.4s ease-in-out;
        }

        #success-toast,
        #error-toast {
            transition: opacity 0.3s ease, transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
    </style>

    <script>
        let activeDragCard = null;
        let startX = 0;
        let startY = 0;
        let currentTranslateX = 0;
        let currentTranslateY = 0;
        let originalParent = null;
        let originalZIndex = '';
        let originalTransition = '';
        let sortedCount = 0;
        const totalCards = 6;

        document.addEventListener('DOMContentLoaded', () => {
            showTutorial();
            initializeDragAndDrop();
        });

        let tutorialTimers = [];
        let tutorialLoopTimeout = null;

        function runTutorialLoop() {
            clearAllTutorialTimers();
            runTutorialAnimation();
            tutorialLoopTimeout = setTimeout(runTutorialLoop, 8500);
        }

        function clearAllTutorialTimers() {
            tutorialTimers.forEach(timer => clearTimeout(timer));
            tutorialTimers = [];
        }

        function runTutorialAnimation() {
            const cardGreen = document.getElementById('sim-card-green');
            const cardRed = document.getElementById('sim-card-red');
            const cursor = document.getElementById('sim-cursor');
            const boxPositif = document.getElementById('sim-box-positif');
            const boxNegatif = document.getElementById('sim-box-negatif');

            if (!cardGreen || !cardRed || !cursor || !boxPositif || !boxNegatif) {
                return;
            }

            // --- STEP 0: Reset State (t = 0) ---
            cardGreen.style.left = '6%';
            cardGreen.style.top = '150px';
            cardGreen.style.opacity = '1';
            cardGreen.style.transform = 'scale(1)';
            cardGreen.style.borderColor = '#000000';
            cardGreen.classList.remove('animate-shake');

            cardRed.style.left = '52%';
            cardRed.style.top = '150px';
            cardRed.style.opacity = '1';
            cardRed.style.transform = 'scale(1)';
            cardRed.style.borderColor = '#000000';
            cardRed.classList.remove('animate-shake');

            boxPositif.style.backgroundColor = '#D4F1BE';
            boxPositif.style.transform = 'none';
            boxNegatif.style.backgroundColor = '#FFB3B3';
            boxNegatif.style.transform = 'none';

            cursor.style.left = '45%';
            cursor.style.top = '175px';
            cursor.style.transform = 'scale(1)';
            cursor.textContent = '👇';

            // --- PHASE 1: Drag Green to Red Box (Incorrect) ---
            tutorialTimers.push(setTimeout(() => {
                cursor.style.left = '25%';
                cursor.style.top = '140px';
            }, 600));

            tutorialTimers.push(setTimeout(() => {
                cursor.style.transform = 'scale(0.8)';
            }, 1200));

            tutorialTimers.push(setTimeout(() => {
                cursor.style.left = '70%';
                cursor.style.top = '15px';

                cardGreen.style.left = '52%';
                cardGreen.style.top = '20px';
            }, 1500));

            tutorialTimers.push(setTimeout(() => {
                cursor.textContent = '❌';
                cursor.style.transform = 'scale(1.2)';
                cardGreen.classList.add('animate-shake');
                cardGreen.style.borderColor = '#ef4444';
                boxNegatif.style.backgroundColor = '#ef4444';
            }, 2200));

            tutorialTimers.push(setTimeout(() => {
                cursor.textContent = '👇';
                cursor.style.transform = 'scale(1)';
                cardGreen.classList.remove('animate-shake');
                cardGreen.style.borderColor = '#000000';
                boxNegatif.style.backgroundColor = '#FFB3B3';

                cursor.style.left = '25%';
                cursor.style.top = '140px';
                cardGreen.style.left = '6%';
                cardGreen.style.top = '150px';
            }, 2800));

            // --- PHASE 2: Drag Green Card to Green Box (Correct) ---
            tutorialTimers.push(setTimeout(() => {
                cursor.style.transform = 'scale(0.8)';
            }, 3600));

            tutorialTimers.push(setTimeout(() => {
                cursor.style.left = '25%';
                cursor.style.top = '15px';

                cardGreen.style.left = '6%';
                cardGreen.style.top = '20px';
            }, 3900));

            tutorialTimers.push(setTimeout(() => {
                cursor.textContent = '✅';
                cursor.style.transform = 'scale(1.2)';
                cardGreen.style.transform = 'scale(0.8)';
                cardGreen.style.opacity = '0.4';
                boxPositif.style.transform = 'scale(1.05)';
            }, 4600));

            // --- PHASE 3: Drag Red Card to Red Box (Correct) ---
            tutorialTimers.push(setTimeout(() => {
                boxPositif.style.transform = 'none';
                cursor.textContent = '👇';
                cursor.style.transform = 'scale(1)';
                cursor.style.left = '70%';
                cursor.style.top = '140px';
            }, 5200));

            tutorialTimers.push(setTimeout(() => {
                cursor.style.transform = 'scale(0.8)';
            }, 5800));

            tutorialTimers.push(setTimeout(() => {
                cursor.style.left = '70%';
                cursor.style.top = '15px';

                cardRed.style.left = '52%';
                cardRed.style.top = '20px';
            }, 6100));

            tutorialTimers.push(setTimeout(() => {
                cursor.textContent = '✅';
                cursor.style.transform = 'scale(1.2)';
                cardRed.style.transform = 'scale(0.8)';
                cardRed.style.opacity = '0.4';
                boxNegatif.style.transform = 'scale(1.05)';
            }, 6800));

            tutorialTimers.push(setTimeout(() => {
                boxNegatif.style.transform = 'none';
                cursor.style.transform = 'scale(0)';
            }, 7500));
        }

        function showTutorial() {
            const overlay = document.getElementById('tutorial-overlay');
            const content = document.getElementById('tutorial-modal-content');
            if (overlay && content) {
                overlay.classList.remove('opacity-0', 'pointer-events-none');
                overlay.classList.add('opacity-100', 'pointer-events-auto');
                content.classList.remove('scale-90');
                content.classList.add('scale-100');

                runTutorialLoop();
            }
        }

        // Add keyboard escape support for accessibility
        window.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeTutorial();
            }
        });

        function closeTutorial() {
            const overlay = document.getElementById('tutorial-overlay');
            const content = document.getElementById('tutorial-modal-content');
            if (overlay && content) {
                overlay.classList.add('opacity-0', 'pointer-events-none');
                overlay.classList.remove('opacity-100', 'pointer-events-auto');
                content.classList.add('scale-90');
                content.classList.remove('scale-100');

                clearAllTutorialTimers();
                if (tutorialLoopTimeout) {
                    clearTimeout(tutorialLoopTimeout);
                    tutorialLoopTimeout = null;
                }
            }
        }

        function initializeDragAndDrop() {
            const cards = document.querySelectorAll('.drag-card');
            cards.forEach(card => {
                // Mouse Events
                card.addEventListener('mousedown', startDrag);
                // Touch Events
                card.addEventListener('touchstart', startDrag, {
                    passive: false
                });
            });

            document.addEventListener('mousemove', dragMove);
            document.addEventListener('touchmove', dragMove, {
                passive: false
            });

            document.addEventListener('mouseup', endDrag);
            document.addEventListener('touchend', endDrag);
        }

        function startDrag(e) {
            if (activeDragCard) return;

            const card = e.currentTarget;
            activeDragCard = card;
            originalParent = card.parentElement;

            // Get pointer starting coordinates
            const clientX = e.type.startsWith('touch') ? e.touches[0].clientX : e.clientX;
            const clientY = e.type.startsWith('touch') ? e.touches[0].clientY : e.clientY;

            startX = clientX;
            startY = clientY;
            currentTranslateX = 0;
            currentTranslateY = 0;

            // Styling for dragging
            originalZIndex = card.style.zIndex;
            originalTransition = card.style.transition;
            card.style.zIndex = '1000';
            card.style.transition = 'none';
            card.classList.remove('hover:scale-105');

            if (e.type.startsWith('touch')) {
                // Prevent scrolling on mobile while dragging
                e.preventDefault();
            }
        }

        function dragMove(e) {
            if (!activeDragCard) return;

            const clientX = e.type.startsWith('touch') ? e.touches[0].clientX : e.clientX;
            const clientY = e.type.startsWith('touch') ? e.touches[0].clientY : e.clientY;

            currentTranslateX = clientX - startX;
            currentTranslateY = clientY - startY;

            // Add rotation effect based on move distance
            const rotation = currentTranslateX * 0.05;
            activeDragCard.style.transform =
                `translate3d(${currentTranslateX}px, ${currentTranslateY}px, 0) rotate(${rotation}deg)`;

            if (e.type.startsWith('touch')) {
                e.preventDefault();
            }
        }

        function endDrag(e) {
            if (!activeDragCard) return;

            const card = activeDragCard;
            activeDragCard = null;

            // Check boundaries
            const cardRect = card.getBoundingClientRect();
            const cardCenterX = cardRect.left + cardRect.width / 2;
            const cardCenterY = cardRect.top + cardRect.height / 2;

            const positifBox = document.getElementById('box-positif');
            const negatifBox = document.getElementById('box-negatif');

            const posRect = positifBox.getBoundingClientRect();
            const negRect = negatifBox.getBoundingClientRect();

            let targetBox = null;
            if (cardCenterX >= posRect.left && cardCenterX <= posRect.right &&
                cardCenterY >= posRect.top && cardCenterY <= posRect.bottom) {
                targetBox = 'positif';
            } else if (cardCenterX >= negRect.left && cardCenterX <= negRect.right &&
                cardCenterY >= negRect.top && cardCenterY <= negRect.bottom) {
                targetBox = 'negatif';
            }

            const cardIsPositif = card.getAttribute('data-positif') === 'true';

            if (targetBox) {
                const isCorrect = (targetBox === 'positif' && cardIsPositif) || (targetBox === 'negatif' && !cardIsPositif);

                if (isCorrect) {
                    handleCorrectDrop(card, targetBox, cardCenterX, cardCenterY);
                } else {
                    handleIncorrectDrop(card);
                }
            } else {
                resetCardPosition(card);
            }
        }

        function handleCorrectDrop(card, targetBox, x, y) {
            createStarExplosion(x, y);
            showToast('success');

            // Remove card from pool
            card.style.opacity = '0';
            card.style.transform = 'scale(0.5)';
            setTimeout(() => {
                card.remove();
            }, 200);

            // Add item to correct box list
            const listEl = document.getElementById(`list-${targetBox}`);
            const title = card.getAttribute('data-title');
            const gambar = card.getAttribute('data-gambar');
            const color = card.getAttribute('data-color');

            const item = document.createElement('div');
            item.className =
                "bg-white p-3 rounded-2xl brutal-border flex items-center gap-3 w-full animate-bounce-short shadow-sm";
            item.style.backgroundColor = color;
            item.innerHTML = `
                <img src="${gambar}" class="w-12 h-12 object-cover rounded-xl brutal-border bg-white flex-shrink-0" onerror="this.style.display='none'">
                <p class="font-bold text-black text-xs md:text-sm leading-snug">${title}</p>
            `;
            listEl.appendChild(item);

            sortedCount++;
            if (sortedCount === totalCards) {
                setTimeout(() => {
                    showVictoryModal();
                }, 1000);
            }
        }

        function handleIncorrectDrop(card) {
            showToast('error');
            card.classList.add('animate-shake');
            setTimeout(() => {
                card.classList.remove('animate-shake');
                resetCardPosition(card);
            }, 400);
        }

        function resetCardPosition(card) {
            card.style.transition = 'transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
            card.style.transform = 'translate3d(0, 0, 0)';
            setTimeout(() => {
                card.style.zIndex = originalZIndex;
                card.style.transition = originalTransition;
                card.classList.add('hover:scale-105');
            }, 400);
        }

        function showToast(type) {
            const toast = document.getElementById(`${type}-toast`);
            if (toast) {
                toast.classList.remove('hidden');
                toast.classList.add('flex');
                void toast.offsetWidth;
                toast.classList.remove('opacity-0', 'scale-90');
                toast.classList.add('opacity-100', 'scale-100');

                setTimeout(() => {
                    toast.classList.remove('opacity-100', 'scale-100');
                    toast.classList.add('opacity-0', 'scale-90');
                    setTimeout(() => {
                        toast.classList.remove('flex');
                        toast.classList.add('hidden');
                    }, 300);
                }, 1500);
            }
        }

        function createStarExplosion(x, y) {
            const particleCount = 20;
            const container = document.body;
            for (let i = 0; i < particleCount; i++) {
                const star = document.createElement('div');
                star.className = 'fixed text-2xl pointer-events-none z-[9999] select-none';
                star.innerHTML = ['⭐', '✨', '🌟'][Math.floor(Math.random() * 3)];
                star.style.left = `${x}px`;
                star.style.top = `${y}px`;
                container.appendChild(star);

                const angle = Math.random() * Math.PI * 2;
                const speed = 2 + Math.random() * 8;
                const vx = Math.cos(angle) * speed;
                const vy = Math.sin(angle) * speed - 2;
                let posX = x;
                let posY = y;
                let opacity = 1;
                let scale = 0.5 + Math.random() * 1;

                const animate = () => {
                    posX += vx;
                    posY += vy + 0.1;
                    opacity -= 0.02;
                    scale -= 0.01;

                    star.style.left = `${posX}px`;
                    star.style.top = `${posY}px`;
                    star.style.opacity = opacity;
                    star.style.transform = `scale(${scale})`;

                    if (opacity > 0) {
                        requestAnimationFrame(animate);
                    } else {
                        star.remove();
                    }
                };
                requestAnimationFrame(animate);
            }
        }

        function showVictoryModal() {
            const modal = document.getElementById('victory-modal');
            const content = document.getElementById('victory-modal-content');
            if (modal && content) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                void modal.offsetWidth;
                modal.classList.remove('opacity-0');
                modal.classList.add('opacity-100');
                content.classList.remove('scale-90');
                content.classList.add('scale-100');
            }
        }

        function resetGame() {
            location.reload();
        }

        function goToNextStage() {
            const nextUrl = "{{ route('materi.belajar', ['step' => 6]) }}";
            const btn = document.getElementById('next-stage-btn');
            if (btn) {
                btn.innerHTML = `
                    <svg class="animate-spin h-5 w-5 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                `;
                btn.classList.add('opacity-75', 'cursor-not-allowed');
            }

            fetch('{{ route('materi.save_progress') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    materi_id: {{ $materi->id ?? 1 }},
                    tahap: 5,
                    score: 100
                })
            }).then(() => {
                window.location.href = nextUrl;
            }).catch(() => {
                window.location.href = nextUrl;
            });
        }

        function tandaiSelesai(event, nextUrl, tahapKe) {
            event.preventDefault();

            const btn = event.currentTarget;
            btn.innerHTML = 'Menyimpan... ⏳';
            btn.classList.add('opacity-75', 'cursor-not-allowed');

            fetch('{{ route('materi.save_progress') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    materi_id: {{ $materi->id ?? 1 }},
                    tahap: tahapKe,
                    score: sortedCount === totalCards ? 100 : 0
                })
            }).then(() => {
                window.location.href = nextUrl;
            }).catch(() => {
                window.location.href = nextUrl;
            });
        }
    </script>
</x-student-layout>
