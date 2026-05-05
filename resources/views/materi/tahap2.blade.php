<x-student-layout>
    <div class="max-w-4xl w-full px-6 py-12 flex flex-col items-center">
        <!-- Progress Bar (Tahap 2) -->
        <div class="w-full mb-10">
            <div class="flex justify-between mb-2">
                <span class="text-xs font-black text-blue-600 uppercase tracking-widest">Tahap 2: Jawab
                    Pertanyaan</span>
                {{-- Menampilkan nomor soal dari total 3 soal --}}
                <span class="text-xs font-black text-slate-400 uppercase tracking-widest">Soal {{ $soal_ke }} dari
                    3</span>
            </div>
            <div class="w-full bg-slate-200 dark:bg-slate-800 h-3 rounded-full overflow-hidden border-2 border-white">
                {{-- Progress bar akan bertambah seiring bertambahnya soal_ke --}}
                <div class="bg-blue-500 h-full transition-all duration-1000" style="width: {{ ($soal_ke / 3) * 100 }}%">
                </div>
            </div>
        </div>

        {{-- BAGIAN 1: UI UNTUK SUSUN HURUF --}}
        @if($quiz->tipe == 'susun_huruf')
            <!-- Pertanyaan dari Database -->
            <div
                class="bg-white dark:bg-slate-900 border-4 border-slate-200 p-8 rounded-[3rem] w-full text-center shadow-lg mb-8">
                <h2 class="text-2xl font-black text-slate-800 dark:text-white uppercase">
                    "{{ $quiz->pertanyaan }}"
                </h2>
            </div>

            <!-- Slot Jawaban -->
            <div id="answer-slots"
                class="flex flex-wrap justify-center gap-4 mb-12 min-h-[120px] w-full p-6 bg-slate-50 dark:bg-slate-800/50 rounded-[2rem] border-4 border-dashed border-slate-300">
                <!-- Huruf akan muncul di sini saat diklik -->
            </div>

            <!-- Pilihan Huruf Isyarat (Diambil dari jawaban_benar di database) -->
            <div class="text-center mb-6">
                <p class="text-slate-400 font-bold uppercase text-xs tracking-widest mb-4">Pilih Isyarat yang Benar:</p>
                <div id="options" class="flex flex-wrap justify-center gap-4">
                    @php
                        $jawaban = $quiz->jawaban_benar;
                        $hurufArray = str_split($jawaban);
                        shuffle($hurufArray); // Acak hurufnya setiap halaman diakses
                    @endphp

                    @foreach($hurufArray as $h)
                        <div onclick="pickLetter('{{ $h }}', this)"
                            class="cursor-pointer bg-white dark:bg-slate-700 p-2 rounded-2xl border-4 border-slate-200 hover:border-pink-500 hover:-translate-y-1 transition-all shadow-md">
                            <img src="{{ asset('images/sibi/' . $h . '.jpg') }}" alt="{{ $h }}"
                                class="w-16 h-16 object-contain">
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- BAGIAN 2: PLACEHOLDER UNTUK PUZZLE (SOAL KE-2) --}}
        @if($quiz->tipe == 'puzzle')
            <div
                class="bg-white dark:bg-slate-900 border-4 border-slate-200 p-6 rounded-[3rem] w-full max-w-md shadow-lg mb-8">
                <h2 class="text-xl font-black text-slate-800 dark:text-white uppercase mb-4 text-center">
                    {{ $quiz->pertanyaan }}
                </h2>

                <!-- Area Grid Puzzle -->
                <div id="puzzle-grid"
                    class="grid grid-cols-3 gap-1 bg-slate-200 p-1 rounded-2xl overflow-hidden aspect-square">
                    @php
                        // Membuat array 0-8 dan mengacaknya
                        $pieces = range(0, 8);
                        shuffle($pieces);
                    @endphp

                    @foreach($pieces as $index => $pos)
                        <div onclick="swapPiece({{ $index }})" id="piece-{{ $index }}" data-correct="{{ $pos }}"
                            class="puzzle-piece cursor-pointer border border-white/20 transition-all duration-200"
                            style="background-image: url('{{ asset('images/asset/' . $quiz->jawaban_benar) }}'); 
                                                            background-size: 300% 300%; 
                                                            background-position: {{ ($pos % 3) * 50 }}% {{ floor($pos / 3) * 50 }}%;">
                        </div>
                    @endforeach
                </div>
            </div>

            <style>
                .puzzle-piece.selected {
                    outline: 5px solid #3b82f6;
                    outline-offset: -5px;
                    transform: scale(0.95);
                    z-index: 10;
                }
            </style>
        @endif

        {{-- BAGIAN 3: PLACEHOLDER UNTUK SUSUN KALIMAT (SOAL KE-3) --}}
        @if($quiz->tipe == 'susun_kalimat')
            <div class="w-full max-w-2xl flex flex-col items-center">
                <!-- Pertanyaan -->
                <div
                    class="bg-white dark:bg-slate-900 border-4 border-slate-200 p-8 rounded-[3rem] w-full text-center shadow-lg mb-8">
                    <h2 class="text-xl font-black text-slate-800 dark:text-white uppercase">
                        {{ $quiz->pertanyaan }}
                    </h2>
                </div>

                <!-- Area Kalimat Terbentuk -->
                <div id="sentence-slots"
                    class="flex flex-wrap justify-center gap-3 mb-10 min-h-[80px] w-full p-6 bg-white dark:bg-slate-800 rounded-[2.5rem] border-4 border-blue-100 shadow-inner">
                    <!-- Kata-kata yang dipilih akan muncul di sini -->
                </div>

                <!-- Pilihan Kata (Diambil dari pilihan_data di database) -->
                <div class="text-center mb-6 w-full">
                    <p class="text-slate-400 font-bold uppercase text-xs tracking-widest mb-4">Susun Kata Berikut:</p>
                    <div id="word-options" class="flex flex-wrap justify-center gap-3">
                        @php
                            // Decode data JSON dari database
                            $words = json_decode($quiz->pilihan_data);
                            shuffle($words); // Acak urutannya agar menantang
                        @endphp

                        @foreach($words as $word)
                            <button onclick="pickWord('{{ $word }}', this)"
                                class="bg-white dark:bg-slate-700 px-6 py-3 rounded-2xl border-4 border-slate-200 font-bold text-slate-700 dark:text-white hover:border-blue-500 hover:-translate-y-1 transition-all shadow-sm">
                                {{ $word }}
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        <!-- Tombol Kontrol -->
        <div class="flex gap-4 mt-8">
            <button onclick="resetGame()"
                class="bg-slate-200 text-slate-600 px-6 py-3 rounded-2xl font-black uppercase text-sm">Ulangi</button>

            {{-- Link Lanjut menggunakan parameter soal_ke + 1 --}}
            <a href="{{ route('materi.belajar', ['step' => 2, 'soal_ke' => $soal_ke + 1]) }}" id="next-btn"
                class="hidden bg-green-500 text-white px-10 py-3 rounded-2xl font-black uppercase text-sm shadow-[0_5px_0_0_#15803d] hover:translate-y-1 active:shadow-none transition-all">
                Lanjut! 🚀
            </a>
        </div>
    </div>

    <script>
        // Mengambil jawaban benar langsung dari database[cite: 2]
        const correctAnswer = "{{ $quiz->jawaban_benar }}";
        let currentInput = "";

        function pickLetter(letter, element) {
            const slotContainer = document.getElementById('answer-slots');

            const newLetter = document.createElement('div');
            newLetter.className = "bg-pink-500 p-2 rounded-2xl border-4 border-white shadow-lg animate-bounce-short";
            newLetter.innerHTML = `<img src="/images/sibi/${letter}.jpg" class="w-16 h-16 object-contain">`;
            slotContainer.appendChild(newLetter);

            currentInput += letter;
            element.classList.add('opacity-0', 'pointer-events-none');

            if (currentInput.length === correctAnswer.length) {
                if (currentInput === correctAnswer) {
                    alert("Yeeay! Jawaban Kamu BENAR! 🎉");
                    document.getElementById('next-btn').classList.remove('hidden');
                } else {
                    alert("Waduh, urutannya masih salah. Coba lagi yuk!");
                    resetGame();
                }
            }
        }

        function resetGame() {
            currentInput = "";
            const slots = document.getElementById('answer-slots');
            if (slots) slots.innerHTML = "";
            const options = document.querySelectorAll('#options div');
            options.forEach(opt => opt.classList.remove('opacity-0', 'pointer-events-none'));
        }

        let firstPiece = null;

        function swapPiece(index) {
            if (firstPiece === null) {
                // Klik pertama: tandai kotak
                firstPiece = index;
                document.getElementById(`piece-${index}`).classList.add('selected');
            } else {
                // Klik kedua: tukar data dan tampilan
                const p1 = document.getElementById(`piece-${firstPiece}`);
                const p2 = document.getElementById(`piece-${index}`);

                // Tukar Background Position
                const tempBG = p1.style.backgroundPosition;
                p1.style.backgroundPosition = p2.style.backgroundPosition;
                p2.style.backgroundPosition = tempBG;

                // Tukar Data Correct (untuk cek kemenangan)
                const tempData = p1.getAttribute('data-correct');
                p1.setAttribute('data-correct', p2.getAttribute('data-correct'));
                p2.setAttribute('data-correct', tempData);

                // Bersihkan seleksi
                p1.classList.remove('selected');
                firstPiece = null;

                checkPuzzleWin();
            }
        }

        function checkPuzzleWin() {
            const pieces = document.querySelectorAll('.puzzle-piece');
            let isCorrect = true;

            pieces.forEach((piece, index) => {
                // Cek apakah data-correct sesuai dengan urutan index (0,1,2...8)
                if (parseInt(piece.getAttribute('data-correct')) !== index) {
                    isCorrect = false;
                }
            });

            if (isCorrect) {
                alert("Gokil! Puzzlenya jadi utuh lagi! 🧩✨");
                document.getElementById('next-btn').classList.remove('hidden');
            }
        }

        let currentSentence = [];
        const correctSentence = "{{ $quiz->jawaban_benar }}"; // Diambil dari database

        function pickWord(word, element) {
            const sentenceContainer = document.getElementById('sentence-slots');

            // Tambahkan kata ke array dan ke tampilan
            currentSentence.push(word);

            const wordBadge = document.createElement('span');
            wordBadge.className = "bg-blue-500 text-white px-5 py-2 rounded-xl font-bold shadow-md animate-pop-in";
            wordBadge.innerText = word;
            sentenceContainer.appendChild(wordBadge);

            // Sembunyikan tombol pilihan
            element.classList.add('opacity-0', 'pointer-events-none');

            // Cek jika jumlah kata sudah sama
            const totalWords = correctSentence.split(' ').length;
            if (currentSentence.length === totalWords) {
                if (currentSentence.join(' ') === correctSentence) {
                    alert("Luar Biasa! Kalimatnya sudah benar! 🌟");
                    document.getElementById('next-btn').classList.remove('hidden');
                } else {
                    alert("Hmm, sepertinya urutan katanya masih kurang tepat. Coba lagi!");
                    resetSentence();
                }
            }
        }

        function resetSentence() {
            currentSentence = [];
            const slots = document.getElementById('sentence-slots');
            if (slots) slots.innerHTML = "";

            const options = document.querySelectorAll('#word-options button');
            options.forEach(opt => opt.classList.remove('opacity-0', 'pointer-events-none'));

            // Panggil resetGame yang lama juga jika perlu untuk membersihkan state global
            if (typeof resetGame === "function") resetGame();
        }
    </script>
</x-student-layout>