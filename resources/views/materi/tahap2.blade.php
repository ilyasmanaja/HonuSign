<x-student-layout>
    <div class="max-w-5xl w-full px-6 py-12 flex flex-col items-center">
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

        {{-- BAGIAN 2: PUZZLE (SOAL KE-2) --}}
        @if($quiz->tipe == 'puzzle')
            <div class="bg-white dark:bg-slate-900 border-4 border-slate-200 p-6 rounded-[3rem] w-7xl max-w-7xl shadow-lg mb-8">
                <h2 class="text-xl font-black text-slate-800 dark:text-white uppercase mb-4 text-center">
                    {{ $quiz->pertanyaan }}
                </h2>

                <div class="flex flex-col md:flex-row gap-6 items-center">
                    <!-- Sisi Kiri: Gambar Referensi (Kecil) -->
                    <div class="w-full md:w-1/3">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 text-center">Contoh
                            Jawaban:</p>
                        <div
                            class="relative rounded-xl overflow-hidden border-2 border-slate-200 shadow-sm opacity-70 hover:opacity-100 transition-opacity">
                            <img src="{{ asset('images/' . $quiz->jawaban_benar) }}"
                                class="w-full grayscale-[50%] hover:grayscale-0">
                            <div class="absolute inset-0 bg-blue-500/10"></div>
                        </div>
                    </div>

                    <!-- Sisi Kanan: Area Grid Puzzle (16:9) -->
                    <div id="puzzle-grid"
                        class="grid grid-cols-3 gap-1.5 bg-slate-200 p-1.5 rounded-3xl overflow-hidden aspect-video w-full shadow-2xl border-4 border-slate-100">
                        @php
                            $pieces = range(0, 8);
                            shuffle($pieces);
                        @endphp

                        @foreach($pieces as $index => $pos)
                            <div onclick="swapPiece({{ $index }})" id="piece-{{ $index }}" data-correct="{{ $pos }}"
                                class="puzzle-piece cursor-pointer border border-white/10 transition-all duration-200" style="background-image: url('{{ asset('images/' . $quiz->jawaban_benar) }}'); 
                                       background-size: 300% 300%; 
                                       background-position: {{ ($pos % 3) * 50 }}% {{ floor($pos / 3) * 50 }}%;">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <style>
                .aspect-video {
                    aspect-ratio: 16 / 9;
                }

                .puzzle-piece.selected {
                    outline: 5px solid #3b82f6;
                    outline-offset: -5px;
                    transform: scale(0.98);
                    z-index: 10;
                    filter: brightness(1.2);
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
                class="hidden bg-blue-600 hover:bg-blue-500 text-white px-10 py-3 rounded-2xl font-black uppercase text-sm hover:translate-y-1 active:shadow-none transition-all">
                Lanjut! 🚀
            </a>
        </div>
    </div>

    <script>
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
            newLetter.className = "bg-pink-500 p-2 rounded-2xl border-4 border-white shadow-lg animate-bounce-short";
            newLetter.innerHTML = `<img src="/images/sibi/${letter}.jpg" class="w-16 h-16 object-contain">`;
            slotContainer.appendChild(newLetter);

            currentInput += letter;
            element.classList.add('opacity-0', 'pointer-events-none');

            if (currentInput === correctAnswer) {
                alert("Yeeay! Jawaban Kamu BENAR! 🎉");
                saveProgress(2, 100); // <--- TAMBAHKAN INI
                document.getElementById('next-btn').classList.remove('hidden');
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
            wordBadge.className = "bg-blue-500 text-white px-5 py-2 rounded-xl font-bold shadow-md animate-pop-in";
            wordBadge.innerText = word;
            sentenceContainer.appendChild(wordBadge);

            // Sembunyikan tombol pilihan
            element.classList.add('opacity-0', 'pointer-events-none');

            // Cek jika jumlah kata sudah sama
            const totalWords = correctSentence.split(' ').length;
            if (currentSentence.join(' ') === correctSentence) {
                alert("Luar Biasa! Kalimatnya sudah benar! 🌟");
                saveProgress(2, 100); // <--- TAMBAHKAN INI
                document.getElementById('next-btn').classList.remove('hidden');
            }
        }

    </script>
</x-student-layout>