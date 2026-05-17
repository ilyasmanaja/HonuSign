<x-student-layout>
    <div class="max-w-5xl w-full px-6 py-12 flex flex-col items-center">
        <!-- Progress Bar (Tahap 2) -->
        <div class="w-full mb-12 max-w-3xl">
            <div class="flex justify-between mb-4 items-end">
                <span class="font-black text-xl tracking-widest uppercase text-black">Tahap 2: Latihan Kuis</span>
                <span
                    class="text-xl font-black text-black bg-[#FFF5B8] brutal-border px-4 py-1 rounded-2xl transform rotate-2 shadow-[2px_2px_0_#000]">Soal
                    {{ $soal_ke }} dari 3</span>
            </div>
            <div class="w-full h-8 bg-white brutal-border brutal-shadow-sm rounded-2xl overflow-hidden p-1">
                <div class="h-full bg-[#BEE9E8] rounded-xl transition-all duration-1000 border-r-4 border-black"
                    style="width: {{ ($soal_ke / 3) * 100 }}%"></div>
            </div>
        </div>

        {{-- BAGIAN 1: UI UNTUK SUSUN HURUF --}}
        @if($quiz->tipe == 'susun_huruf')
            <!-- Pertanyaan dari Database -->
            <div
                class="bg-[#FFF5B8] brutal-border brutal-shadow p-8 md:p-10 rounded-[3rem] w-full max-w-3xl text-center mb-10 transform -rotate-1">
                <h2 class="text-3xl md:text-4xl font-black text-black uppercase tracking-tighter">
                    "{{ $quiz->pertanyaan }}"
                </h2>
            </div>

            <!-- Slot Jawaban -->
            <div id="answer-slots"
                class="flex flex-wrap justify-center items-center gap-4 mb-12 min-h-[140px] w-full max-w-4xl p-6 bg-[#FFFEFA] rounded-[2rem] brutal-border shadow-inner">
                <!-- Huruf akan muncul di sini saat diklik -->
            </div>

            <!-- Pilihan Huruf Isyarat -->
            <div class="text-center mb-6 w-full max-w-4xl bg-[#FFD1E3] brutal-border brutal-shadow rounded-[2.5rem] p-8">
                <p class="text-black font-black uppercase text-lg tracking-widest mb-6">Pilih Isyarat yang Benar:</p>
                <div id="options" class="flex flex-wrap justify-center gap-4">
                    @php
                        $jawaban = $quiz->jawaban_benar;
                        $hurufArray = str_split($jawaban);
                        shuffle($hurufArray);
                    @endphp

                    @foreach($hurufArray as $h)
                        <div onclick="pickLetter('{{ $h }}', this)"
                            class="cursor-pointer bg-white p-2 rounded-2xl brutal-border brutal-shadow-sm brutal-hover">
                            <img src="{{ asset('images/general/sibi tangan/' . $h . '.png') }}" alt="{{ $h }}"
                                class="w-20 h-20 md:w-24 md:h-24 object-contain rounded-xl">
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- BAGIAN 2: PUZZLE (SOAL KE-2) --}}
        @if($quiz->tipe == 'puzzle')
            <div class="bg-white dark:bg-slate-900 border-4 border-slate-200 p-6 rounded-[3rem] w-7xl max-w-7xl shadow-lg mb-8">
                <h2 class="text-xl font-black text-slate-800 dark:text-white uppercase mb-4 text-center">
                    {{ $quiz->pertanyaan }}
                </h2>

                <!-- Area Kiri: Puzzle Board -->
                <div
                    class="w-full lg:w-3/5 flex flex-col items-center justify-center bg-[#BEE9E8] brutal-border brutal-shadow rounded-[3rem] p-6 md:p-10">
                    <h2
                        class="text-2xl md:text-3xl font-black text-black uppercase mb-8 text-center bg-white brutal-border px-6 py-3 rounded-2xl transform -rotate-1">
                        {{ $quiz->pertanyaan }}
                    </h2>

                    <!-- Board Grid -->
                    <div id="puzzle-grid"
                        class="grid grid-cols-3 gap-1.5 bg-slate-200 p-1.5 rounded-3xl overflow-hidden aspect-video w-full shadow-2xl border-4 border-slate-100">
                        @php
                            $pieces = range(0, 8);
                            shuffle($pieces);
                        @endphp

                        @foreach($pieces as $index => $pos)
                            <div onclick="swapPiece({{ $index }})" id="piece-{{ $index }}" data-correct="{{ $pos }}"
                                class="puzzle-piece cursor-pointer border-2 border-black/10 transition-all duration-200 rounded-md hover:border-black hover:scale-[0.98]"
                                style="background-image: url('{{ asset('images/materi/tahap1/' . $quiz->jawaban_benar) }}'); 
                                                                                                               background-size: 300% 300%; 
                                                                                                               background-position: {{ ($pos % 3) * 50 }}% {{ floor($pos / 3) * 50 }}%;">
                            </div>
                        @endforeach
                    </div>

                    <p
                        class="mt-6 text-slate-700 font-bold text-center bg-[#FFF5B8] px-6 py-3 rounded-xl brutal-border brutal-shadow-sm text-sm transform rotate-1">
                        👆 Klik 2 kotak untuk menukar posisinya!
                    </p>
                </div>

                <!-- Area Kanan: Referensi & Kontrol -->
                <div class="w-full lg:w-2/5 flex flex-col gap-6">
                    <!-- Referensi Gambar -->
                    <div class="bg-[#FFFEFA] brutal-border brutal-shadow rounded-[2.5rem] p-8 flex flex-col items-center">
                        <h2
                            class="text-xl font-black uppercase tracking-widest mb-6 bg-[#FFD1E3] px-4 py-1 rounded-xl brutal-border transform -rotate-2">
                            Target Gambar</h2>
                        <div
                            class="w-full aspect-video brutal-border brutal-shadow-sm rounded-2xl overflow-hidden relative opacity-90 hover:opacity-100 transition-opacity">
                            <img src="{{ asset('images/materi/tahap1/' . $quiz->jawaban_benar) }}"
                                class="w-full h-full object-cover">
                        </div>
                    </div>

                    <!-- Progress Langkah -->
                    <div class="bg-[#E0BBE4] brutal-border brutal-shadow rounded-[2.5rem] p-6 text-center">
                        <span class="font-black text-lg uppercase tracking-widest block mb-3 text-black">Langkah
                            Ditukar:</span>
                        <span id="moves-count"
                            class="text-4xl text-black font-black bg-[#FFFEFA] brutal-border px-8 py-2 rounded-2xl transform rotate-2 inline-block brutal-shadow-sm">0</span>
                    </div>
                </div>

            </div>

            <style>
                .aspect-video {
                    aspect-ratio: 16 / 9;
                }

                .puzzle-piece.selected {
                    outline: 6px solid #FFF5B8;
                    outline-offset: -6px;
                    transform: scale(0.92);
                    z-index: 10;
                    filter: brightness(1.2);
                    border-radius: 8px;
                    box-shadow: inset 0 0 20px #FFF5B8;
                }
            </style>
        @endif

        {{-- BAGIAN 3: SUSUN KALIMAT (SOAL KE-3) --}}
        @if($quiz->tipe == 'susun_kalimat')
            <div class="w-full max-w-4xl flex flex-col items-center">
                <!-- Pertanyaan -->
                <div
                    class="bg-[#D4F1BE] brutal-border brutal-shadow p-8 rounded-[3rem] w-full text-center mb-10 transform rotate-1">
                    <h2 class="text-3xl font-black text-black uppercase tracking-tighter">
                        {{ $quiz->pertanyaan }}
                    </h2>
                </div>

                <!-- Area Kalimat Terbentuk -->
                <div id="sentence-slots"
                    class="flex flex-wrap justify-center gap-4 mb-10 min-h-[120px] w-full p-8 bg-[#FFFEFA] rounded-[2.5rem] brutal-border shadow-inner">
                    <!-- Kata-kata yang dipilih akan muncul di sini -->
                </div>

                <!-- Pilihan Kata -->
                <div class="text-center mb-6 w-full bg-[#E0BBE4] brutal-border brutal-shadow rounded-[3rem] p-8 md:p-10">
                    <p
                        class="text-black font-black uppercase text-lg tracking-widest mb-6 bg-white brutal-border inline-block px-4 py-2 rounded-xl transform -rotate-2">
                        Susun Kata Berikut:
                    </p>
                    <div id="word-options" class="flex flex-wrap justify-center gap-4">
                        @php
                            $words = json_decode($quiz->pilihan_data);
                            shuffle($words);
                        @endphp

                        @foreach($words as $word)
                            <button onclick="pickWord('{{ $word }}', this)"
                                class="bg-white px-8 py-4 rounded-2xl brutal-border brutal-shadow-sm brutal-hover font-black text-black uppercase text-xl transition-all">
                                {{ $word }}
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        <!-- Tombol Kontrol -->
        <div class="flex flex-wrap justify-center gap-6 mt-8">
            <button onclick="resetGame()"
                class="bg-white text-black px-8 py-4 rounded-3xl brutal-border brutal-shadow-sm brutal-hover font-black uppercase tracking-widest text-lg flex items-center gap-2">
                🔄 Ulangi
            </button>

            <a href="{{ route('materi.belajar', ['step' => 2, 'soal_ke' => $soal_ke + 1]) }}" id="next-btn"
                class="hidden bg-[#D4F1BE] text-black px-10 py-4 rounded-3xl brutal-border brutal-shadow-sm brutal-hover font-black uppercase tracking-widest text-lg flex items-center gap-2 transform transition-all animate-bounce">
                Lanjut! <span class="text-3xl">🚀</span>
            </a>
        </div>
    </div>

    <!-- Modal Sukses Kustom -->
    <div id="success-modal"
        class="fixed inset-0 z-[9999] bg-slate-900/60 backdrop-blur-sm hidden flex-col items-center justify-center opacity-0 transition-all duration-300">
        <div class="bg-[#BEE9E8] p-8 md:p-12 rounded-[3rem] brutal-border brutal-shadow flex flex-col items-center max-w-lg mx-4 transform scale-90 transition-transform duration-500 relative"
            id="success-modal-content">
            <button onclick="closeSuccessModal()"
                class="absolute top-4 right-4 bg-white brutal-border brutal-shadow-sm w-12 h-12 rounded-full flex items-center justify-center font-black text-2xl hover:bg-[#FF6B6B] hover:text-white transition-all transform hover:rotate-90">X</button>

            <div class="text-8xl mb-6 animate-bounce drop-shadow-[0_10px_0_rgba(0,0,0,0.2)]" id="modal-emoji">🌟</div>
            <h2 class="text-4xl md:text-5xl font-black text-white text-outline uppercase tracking-tighter text-center mb-2 transform -rotate-2 drop-shadow-[0_4px_0_#000]"
                id="modal-title">
                HEBAT!
            </h2>
            <p class="text-xl md:text-2xl font-bold text-slate-800 text-center mb-10 bg-[#FFF5B8] px-4 py-2 rounded-xl brutal-border"
                id="modal-desc">
                Jawaban kamu benar sekali!
            </p>

            <a href="{{ route('materi.belajar', ['step' => 2, 'soal_ke' => $soal_ke + 1]) }}"
                class="bg-[#D4F1BE] text-black px-10 py-5 rounded-[2.5rem] brutal-border brutal-shadow-sm brutal-hover font-black uppercase tracking-widest text-xl flex items-center justify-center gap-3 w-full transform hover:-translate-y-2 transition-all">
                Lanjut <span class="text-4xl">🚀</span>
            </a>
        </div>
    </div>

    <script>
        function showSuccessModal(title, desc, emoji) {
            document.getElementById('modal-title').innerText = title;
            document.getElementById('modal-desc').innerText = desc;
            document.getElementById('modal-emoji').innerText = emoji;

            const modal = document.getElementById('success-modal');
            const content = document.getElementById('success-modal-content');

            modal.classList.remove('hidden');
            modal.classList.add('flex');

            // Trigger reflow untuk animasi transisi
            void modal.offsetWidth;

            modal.classList.remove('opacity-0');
            content.classList.remove('scale-90');
            content.classList.add('scale-100');
        }

        function closeSuccessModal() {
            const modal = document.getElementById('success-modal');
            const content = document.getElementById('success-modal-content');

            modal.classList.add('opacity-0');
            content.classList.remove('scale-100');
            content.classList.add('scale-90');

            setTimeout(() => {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
            }, 300);
        }
        // Mengambil jawaban benar langsung dari database[cite: 2]
        const correctAnswer = "{{ $quiz->jawaban_benar }}";
        let currentInput = "";

        // Fungsi untuk mengirim nilai ke database via AJAX
        function saveProgress(tahap) {
            fetch('{{ route('materi.save_progress') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json', // <--- SANGAT PENTING: Minta balasan berupa JSON
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    materi_id: {{ $materi->id }},
                    tahap: tahap
                })
            })
                .then(async response => {
                    // Kalau statusnya bukan 200 OK, tangkap pesan errornya!
                    if (!response.ok) {
                        const err = await response.json();
                        console.error("Laravel Error Detail:", err);
                        alert("Waduh, gagal simpan nilai! Error: " + (err.message || "Cek Console Inspect Element"));
                        throw new Error("Gagal menyimpan");
                    }
                    return response.json();
                })
                .then(data => {
                    console.log("System:", data.message);
                    // (Opsional) Kamu bisa memunculkan alert kecil kalau mau pastikan sukses
                    // alert("Sukses tersimpan ke database!");
                })
                .catch(error => {
                    console.error('Error fetch:', error);
                });
        }

        function pickLetter(letter, element) {
            const slotContainer = document.getElementById('answer-slots');

            const newLetter = document.createElement('div');
            newLetter.className = "bg-[#FFD1E3] p-2 rounded-2xl brutal-border brutal-shadow-sm animate-bounce flex items-center justify-center";
            newLetter.innerHTML = `<img src="/images/general/sibi tangan/${letter}.png" class="w-20 h-20 md:w-24 md:h-24 object-contain rounded-xl">`;
            slotContainer.appendChild(newLetter);

            currentInput += letter;
            element.classList.add('opacity-0', 'pointer-events-none');

            if (currentInput === correctAnswer) {
                showSuccessModal("HEBAT!", "Susunan isyarat kamu BENAR!", "🎉");
                saveProgress(2, 100); // <--- TAMBAHKAN INI
                document.getElementById('next-btn').classList.remove('hidden');
            } else if (currentInput.length === correctAnswer.length) {
                setTimeout(() => {
                    alert('Yah, susunannya masih keliru. Yuk coba lagi!');
                    resetGame();
                }, 500);
            }
        }

        function resetGame() {
            // 1. Logika Ulangi untuk SUSUN HURUF
            const answerSlots = document.getElementById('answer-slots');
            if (answerSlots) {
                currentInput = "";
                answerSlots.innerHTML = "";
                const options = document.querySelectorAll('#options div');
                options.forEach(opt => opt.classList.remove('opacity-0', 'pointer-events-none'));
            }

            // 2. Logika Ulangi untuk SUSUN KALIMAT
            const sentenceSlots = document.getElementById('sentence-slots');
            if (sentenceSlots) {
                currentSentence = [];
                sentenceSlots.innerHTML = "";
                const wordOptions = document.querySelectorAll('#word-options button');
                wordOptions.forEach(opt => opt.classList.remove('opacity-0', 'pointer-events-none'));
            }

            // 3. Logika Ulangi untuk PUZZLE
            const puzzleGrid = document.getElementById('puzzle-grid');
            if (puzzleGrid) {
                // Cara paling aman dan instan untuk puzzle adalah me-reload halamannya
                // agar kodingan PHP (shuffle) bekerja lagi untuk mengacak ulang posisinya
                window.location.reload();
            }

            // Sembunyikan kembali tombol lanjut jika sedang mencoba lagi
            const nextBtn = document.getElementById('next-btn');
            if (nextBtn && !nextBtn.classList.contains('hidden')) {
                nextBtn.classList.add('hidden');
            }
        }

        let firstPiece = null;
        let puzzleMoves = 0;

        function swapPiece(index) {
            if (firstPiece === null) {
                // Klik pertama: tandai kotak
                firstPiece = index;
                document.getElementById(`piece-${index}`).classList.add('selected');
            } else {
                // Mencegah swap jika mengklik kotak yang sama
                if (firstPiece === index) {
                    document.getElementById(`piece-${firstPiece}`).classList.remove('selected');
                    firstPiece = null;
                    return;
                }

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

                // Tambah jumlah langkah
                puzzleMoves++;
                const movesEl = document.getElementById('moves-count');
                if (movesEl) movesEl.innerText = puzzleMoves;

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
                showSuccessModal("GOKIL!", "Puzzlenya utuh lagi!", "🧩");
                saveProgress(2, 100); // <--- TAMBAHKAN INI
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
            wordBadge.className = "bg-[#FFF5B8] text-black px-6 py-3 rounded-2xl brutal-border brutal-shadow-sm font-black uppercase text-2xl animate-bounce";
            wordBadge.innerText = word;
            sentenceContainer.appendChild(wordBadge);

            // Sembunyikan tombol pilihan
            element.classList.add('opacity-0', 'pointer-events-none');

            // Cek jika jumlah kata sudah sama
            const totalWords = correctSentence.split(' ').length;
            if (currentSentence.length === totalWords) {
                if (currentSentence.join(' ') === correctSentence) {
                    showSuccessModal("LUAR BIASA!", "Kalimatnya sudah benar!", "🌟");
                    saveProgress(2, 100); // <--- TAMBAHKAN INI
                    document.getElementById('next-btn').classList.remove('hidden');
                } else {
                    setTimeout(() => {
                        alert('Yah, susunan kalimatnya masih keliru. Yuk coba lagi!');
                        resetGame();
                    }, 500);
                }
            }
        }

    </script>
</x-student-layout>