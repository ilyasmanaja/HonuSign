<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <title>HonuSign - Tebak Isyarat</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;600;700;900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Fredoka', sans-serif;
            background-color: #BEE9E8 !important;
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

        @keyframes float {
            0% {
                transform: translateY(0px) rotate(-1deg);
            }

            50% {
                transform: translateY(-8px) rotate(1.5deg);
            }

            100% {
                transform: translateY(0px) rotate(-1deg);
            }
        }

        .animate-float {
            animation: float 2s ease-in-out infinite;
        }
    </style>
</head>

<body class="selection:bg-transparent transition-transform">

    @php
        // Mengambil data quiz pertama dari database yang bertipe susun_huruf milik materi ini
        $quiz = \App\Models\Quiz::where('materi_id', $materi->id)->where('tipe', 'susun_huruf')->first();

        // Fallback data jika database kosong saat proses development
        $soalTeks = $quiz ? $quiz->pertanyaan : 'Siapakah tokoh yang menggunakan pakaian Riau?';
        $jawabanTeks = $quiz ? strtoupper($quiz->jawaban_benar) : 'SAMSUL';
        $gambarTokoh = $quiz ? json_decode($quiz->pilihan_data) : 'samsul_teluk_belangga.png';

        // Logika pengacakan huruf
        $hurufArray = str_split($jawabanTeks);
        shuffle($hurufArray);
    @endphp

    <!-- Back Button with Tooltip (Fixed Route) -->
    <div class="absolute top-4 left-4 md:top-6 md:left-6 z-[110] group/tooltip pointer-events-auto">
        <a href="{{ route('materi.index', ['mapel_slug' => $mapel->slug]) }}" aria-label="Kembali"
            class="bg-[#FFB3B3] text-black p-3.5 rounded-2xl font-bold brutal-border brutal-shadow-sm brutal-hover flex items-center justify-center w-14 h-14">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-7 h-7 text-black" fill="none"
                stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12" />
                <polyline points="12 19 5 12 12 5" />
            </svg>
        </a>
        <div
            class="pointer-events-none absolute left-0 top-full mt-3 bg-[#FFD1E3] brutal-border brutal-shadow-sm px-3 py-1.5 rounded-lg text-sm font-bold opacity-0 scale-95 group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-150 whitespace-nowrap z-50 text-black">
            Kembali ke Peta
        </div>
    </div>

    <!-- Title Header -->
    <div class="pt-16 md:pt-20 px-4 flex justify-center max-w-7xl mx-auto">
        <h1
            class="mb-4 bg-[#FFF5B8] brutal-border brutal-shadow-sm px-8 py-3 rounded-2xl text-2xl md:text-3xl font-black uppercase tracking-widest text-center transform -rotate-1 min-w-[220px] shadow-sm">
            Tebak Isyarat (Soal {{ $soal_ke }}/3)
        </h1>
    </div>

    <!-- Question Card (Dinamis) -->
    <div class="w-full max-w-6xl mx-auto px-4 md:px-8 mb-6">
        <div
            class="bg-[#FFFEFA] brutal-border brutal-shadow rounded-[2rem] p-6 flex flex-col md:flex-row items-center gap-6">
            <!-- Gambar Tokoh Dinamis -->
            <div
                class="shrink-0 bg-[#D4F1BE] p-3 brutal-border brutal-shadow rounded-[2rem] transform -rotate-2 hover:rotate-0 transition-transform duration-300 animate-float">
                <div class="bg-white p-2.5 rounded-2xl brutal-border shadow-inner">
                    <img src="{{ asset('images/materi/tahap1/' . $gambarTokoh) }}" alt="Tokoh Soal"
                        class="h-28 md:h-36 w-auto object-contain">
                </div>
            </div>
            <!-- Teks Soal Dinamis -->
            <div class="flex-grow text-center md:text-left">
                <span
                    class="inline-block px-4 py-1.5 bg-[#FFF5B8] brutal-border brutal-shadow-sm rounded-xl text-xs font-black uppercase tracking-wider mb-3">Tebak
                    Nama Tokoh</span>
                <h2 class="text-2xl md:text-3xl font-black text-black leading-snug">
                    {{ $soalTeks }}
                </h2>
            </div>
        </div>
    </div>

    <!-- Interactive Console -->
    <div class="pb-8 px-4 md:px-8 flex flex-col md:flex-row gap-6 max-w-6xl w-full mx-auto">

        <!-- Left Side: Hand Sign Options -->
        <div
            class="w-full md:w-1/2 bg-[#FFD1E3] brutal-border brutal-shadow rounded-[2rem] p-6 flex flex-col justify-center items-center">
            <h2 class="text-lg font-black uppercase tracking-widest mb-4 text-slate-800">Pilih Huruf Isyarat</h2>
            <div id="options" class="flex flex-wrap justify-center gap-4">
                @foreach ($hurufArray as $index => $h)
                    <div onclick="pickLetter('{{ $h }}', this)"
                        style="animation-delay: {{ $index * 0.25 }}s;"
                        class="cursor-pointer bg-white p-3 rounded-3xl brutal-border brutal-shadow brutal-hover transition-all w-24 h-24 md:w-28 md:h-28 flex items-center justify-center animate-float">
                        <img src="{{ asset('images/general/sibi tangan/' . strtoupper($h) . '.png') }}"
                            alt="{{ $h }}" class="w-20 h-20 md:w-24 md:h-24 object-contain rounded-lg">
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Right Side: Answer Slots -->
        <div
            class="w-full md:w-1/2 bg-[#FFFEFA] brutal-border brutal-shadow rounded-[2rem] p-6 flex flex-col justify-center">
            <h2 class="text-lg font-black uppercase tracking-widest mb-4 text-slate-800 text-center">Jawabanmu</h2>
            <div id="answer-slots"
                class="flex flex-wrap justify-center items-center gap-4 min-h-[110px] w-full p-4 bg-[#FFF9F0] rounded-2xl border-4 border-dashed border-black shadow-inner overflow-y-auto">
                <!-- Tempat kepingan huruf isyarat mendarat -->
            </div>
        </div>

    </div>

    <!-- Victory Modal (Fixed Route) -->
    <div id="success-modal"
        class="fixed inset-0 z-[9999] bg-slate-900/60 backdrop-blur-sm hidden flex-col items-center justify-center opacity-0 transition-all duration-300">
        <div class="relative w-full max-w-[480px] aspect-square transform scale-90 transition-transform duration-500 select-none"
            id="success-modal-content">
            <img src="{{ asset('images/selamat.png') }}" alt="Selamat!"
                class="w-full h-full object-contain rounded-[3rem] brutal-border brutal-shadow">

            <div class="absolute bottom-[9%] left-0 right-0 flex justify-center gap-[8%]">
                <div class="relative group/tooltip w-[18%] aspect-square">
                    <button onclick="resetGame()" aria-label="Ulangi"
                        class="w-full h-full bg-[#FFF5B8] text-black rounded-2xl brutal-border brutal-shadow-sm brutal-hover flex items-center justify-center cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            class="w-1/2 h-1/2 text-black fill-none stroke-current" stroke-width="3.5"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21.5 2v6h-6M21.34 15.57a10 10 0 1 1-.57-8.38l.57-1.19" />
                        </svg>
                    </button>
                </div>
                <div class="relative group/tooltip w-[18%] aspect-square">
                    <!-- Navigasi diarahkan dengan menyertakan mapel_slug -->
                    <a href="{{ route('materi.belajar', ['mapel_slug' => $mapel->slug, 'step' => 2, 'soal_ke' => 2]) }}"
                        aria-label="Lanjut"
                        class="w-full h-full bg-[#D4F1BE] text-black rounded-2xl brutal-border brutal-shadow-sm brutal-hover flex items-center justify-center cursor-pointer">
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
    </div>

    <!-- Failure Modal -->
    <div id="failure-modal"
        class="fixed inset-0 z-[9999] bg-slate-900/60 backdrop-blur-sm hidden flex-col items-center justify-center opacity-0 transition-all duration-300">
        <div class="relative w-full max-w-[480px] aspect-square transform scale-90 transition-transform duration-500 select-none"
            id="failure-modal-content">
            <img src="{{ asset('images/gagal.png') }}" alt="Gagal!"
                class="w-full h-full object-contain rounded-[3rem] brutal-border brutal-shadow">
            <div class="absolute bottom-[9%] left-0 right-0 flex justify-center">
                <div class="relative group/tooltip w-[18%] aspect-square">
                    <button onclick="hideFailureModal()" aria-label="Ulangi"
                        class="w-full h-full bg-[#FFF5B8] text-black rounded-2xl brutal-border brutal-shadow-sm brutal-hover flex items-center justify-center cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            class="w-1/2 h-1/2 text-black fill-none stroke-current" stroke-width="3.5"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21.5 2v6h-6M21.34 15.57a10 10 0 1 1-.57-8.38l.57-1.19" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Mengoper kunci jawaban dinamis ke JavaScript
        const correctAnswer = "{{ $jawabanTeks }}";
        let currentInput = "";

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

        function pickLetter(letter, element) {
            const slotContainer = document.getElementById('answer-slots');
            const newLetter = document.createElement('div');
            newLetter.className =
                "cursor-pointer bg-[#FFD1E3] p-2 rounded-2xl brutal-border brutal-shadow-sm hover:scale-95 transition-transform flex items-center justify-center animate-fly-in animate-float w-20 h-20 md:w-24 md:h-24";
            newLetter.innerHTML =
                `<img src="/images/general/sibi tangan/${letter.toUpperCase()}.png" class="w-16 h-16 md:w-20 md:h-20 object-contain rounded-lg">`;

            newLetter.style.animationDelay = (slotContainer.children.length * 0.15) + "s";
            newLetter.dataset.letter = letter;
            newLetter.onclick = () => {
                element.classList.remove('opacity-0', 'pointer-events-none');
                newLetter.remove();
                updateInputFromSlots();
            };

            slotContainer.appendChild(newLetter);
            currentInput += letter;
            element.classList.add('opacity-0', 'pointer-events-none');

            checkAnswer();
        }

        function updateInputFromSlots() {
            const slots = document.querySelectorAll('#answer-slots > div');
            currentInput = Array.from(slots).map(slot => slot.dataset.letter).join('');
            slots.forEach((slot, i) => {
                slot.style.animationDelay = (i * 0.15) + "s";
            });
            checkAnswer();
        }

        function checkAnswer() {
            if (currentInput.toUpperCase() === correctAnswer.toUpperCase()) {
                showSuccessModal();
                saveProgress(2, 100); // Progress disimpan untuk tahap 2
            } else if (currentInput.length === correctAnswer.length) {
                setTimeout(() => {
                    showFailureModal();
                }, 500);
            }
        }

        function resetGame() {
            currentInput = "";
            const answerSlots = document.getElementById('answer-slots');
            if (answerSlots) {
                answerSlots.innerHTML = "";
            }
            const options = document.querySelectorAll('#options div');
            options.forEach(opt => opt.classList.remove('opacity-0', 'pointer-events-none'));

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
