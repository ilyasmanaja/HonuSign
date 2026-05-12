<x-student-layout>
    <div class="max-w-4xl w-full px-6 py-12 flex flex-col items-center min-h-screen">

        <div class="w-full mb-10">
            <div class="flex justify-between mb-2">
                <span id="soal-title" class="text-xs font-black text-indigo-600 uppercase tracking-widest">Soal 1 dari
                    10</span>
                <span id="score-display" class="text-xs font-black text-slate-400 uppercase tracking-widest">Skor:
                    0</span>
            </div>
            <div class="w-full bg-slate-200 h-3 rounded-full overflow-hidden border-2 border-white">
                <div id="progress-bar" class="bg-indigo-500 h-full transition-all duration-500" style="width: 10%">
                </div>
            </div>
        </div>

        <div id="quiz-container"
            class="w-full bg-white rounded-[3rem] border-4 border-slate-200 shadow-2xl p-10 md:p-14 mb-10 transition-all duration-300">
        </div>

        <div id="navigation" class="flex gap-4">
        </div>
    </div>

    <script>
        // DATA SOAL EVALUASI (Hardcoded dari Word) 
        const allQuestions = [
            {
                id: 1,
                tipe: 'pilihan_gambar',
                pertanyaan: "Jika kita membersihkan kelas maka kelas akan terlihat rapi. Pilihlah aktivitas apa saja yang dapat menciptakan kelas yang rapi dan bersih? [cite: 2]",
                pilihan: {
                    A: "{{ asset('images/wahyu_sapu_kelas.jpg') }}",
                    B: "{{ asset('images/ina_sapu_halaman.jpg') }}",
                    C: "{{ asset('images/ririn_cuci_piring.jpg') }}",
                    D: "{{ asset('images/bayu_bersih_selokan.jpg') }}"
                },
                jawaban: "A"
            },
            {
                id: 2,
                tipe: 'pilihan_gambar',
                pertanyaan: "Gambar manakah yang menunjukkan sikap menghargai keberagaman? [cite: 9]",
                pilihan: {
                    A: "{{ asset('images/menghargai_agama.jpg') }}", 
                    B: "{{ asset('images/gotong_royong_kelas.jpg') }}",
                    C: "{{ asset('images/mengobrol_santai.jpg') }}",
                    D: "{{ asset('images/mengganggu_ibadah.jpg') }}"
                },
                jawaban: "A"
            },
            {
                id: 3,
                tipe: 'pilihan_ganda',
                pertanyaan: "Menurut Ananda bagaimana keadaan halaman sekolah setelah kegiatan tersebut selesai?",
                gambar_soal: "{{ asset('images/kegiatan_bersih.jpg') }}", // Gambar 1, 2, dan 3 dalam satu frame 
                pilihan: {
                    A: "Bersih",
                    B: "Tidak bersih"
                },
                jawaban: "A"
            },
            {
                id: 4,
                tipe: 'puzzle',
                pertanyaan: "Susunlah puzzle di bawah ini menjadi seperti gambar yang ada di samping!",
                target_img: "{{ asset('images/kelas.png') }}",
                jawaban: "0-1-2-3-4-5" // Urutan untuk 6 kepingan
            },
            {
                id: 5,
                tipe: 'pilihan_ganda',
                pertanyaan: "Berdasarkan gambar di bawah ini, apa yang dilakukan oleh anak-anak?",
                gambar_soal: "{{ asset('images/evaluasi/tarian.png') }}", // Pastikan file gambar tarian zapin ada
                pilihan: {
                    A: "Menari",
                    B: "Belajar",
                    C: "Tidur"
                },
                jawaban: "A"
            }

        ];

        let currentStep = 0;
        let correctCount = 0; // Menghitung jawaban yang benar
        let userSequence = [];
        let firstSelection = null; // Menyimpan kepingan pertama yang diklik

        function loadSoal() {
            const q = allQuestions[currentStep];
            const container = document.getElementById('quiz-container');
            userSequence = []; // Reset urutan setiap ganti soal

            // 1. Update Header Progress
            document.getElementById('soal-title').innerText = `Soal ${currentStep + 1} dari ${allQuestions.length}`;
            document.getElementById('progress-bar').style.width = `${((currentStep + 1) / allQuestions.length) * 100}%`;

            // 2. Tampilkan Judul Pertanyaan
            let html = `<h3 class="text-2xl font-bold text-slate-700 mb-8 leading-tight">${q.pertanyaan}</h3>`;

            // 3. Tampilkan Gambar Soal (Jika ada)
            if (q.gambar_soal) {
                html += `
        <div class="w-full mb-8 rounded-[2rem] overflow-hidden border-4 border-slate-100 shadow-inner">
            <img src="${q.gambar_soal}" class="w-full h-auto object-contain" 
                 onerror="this.src='https://placehold.co/800x400?text=Gambar+Soal+Tidak+Ditemukan'">
        </div>`;
            }

            // 4. Logika Tampilan Pilihan Jawaban
            if (q.tipe === 'pilihan_gambar') {
                html += `<div class="grid grid-cols-2 gap-6">`;
                for (let key in q.pilihan) {
                    html += `
            <button onclick="checkAnswer('${key}')" class="group relative overflow-hidden border-4 border-slate-100 rounded-[2rem] hover:border-indigo-500 transition-all shadow-sm bg-white">
                <img src="${q.pilihan[key]}" class="w-full h-48 object-cover group-hover:scale-105 transition-all" onerror="this.src='https://placehold.co/400x300?text=Gambar+Pilihan+Tidak+Ada'">
                <div class="absolute top-4 left-4 w-10 h-10 bg-white/90 backdrop-blur rounded-xl flex items-center justify-center font-black text-slate-400 group-hover:text-indigo-600 shadow-sm">
                    ${key}
                </div>
            </button>`;
                }
                html += `</div>`;
            }
            else if (q.tipe === 'pilihan_ganda') {
                html += `<div class="grid grid-cols-1 md:grid-cols-2 gap-4">`;
                for (let key in q.pilihan) {
                    html += `
            <button onclick="checkAnswer('${key}')" class="p-6 border-4 border-slate-100 rounded-2xl hover:border-indigo-500 hover:bg-indigo-50 transition-all text-center font-bold text-slate-600 text-lg">
                ${q.pilihan[key]}
            </button>`;
                }
                html += `</div>`;
            }
            // --- UPDATE: Tambahkan Tipe Puzzle ---
            else if (q.tipe === 'puzzle') {
                html += `
    <div class="flex flex-col md:flex-row gap-8 items-start">
        <div class="w-full md:w-2/3">
            <p class="text-sm text-slate-400 mb-4 font-bold uppercase tracking-widest text-center italic">Klik 2 kepingan untuk menukar posisinya:</p>
            <div id="puzzle-board" class="grid grid-cols-3 gap-2 bg-slate-50 p-4 rounded-[2rem] border-4 border-dashed border-slate-200">
                </div>
        </div>
        <div class="w-full md:w-1/3 flex flex-col items-center">
            <p class="text-sm text-slate-400 mb-4 font-bold uppercase tracking-widest text-center font-black">Panduan:</p>
            <div class="border-4 border-indigo-500 rounded-2xl overflow-hidden shadow-lg mb-6">
                <img src="${q.target_img}" class="w-full h-auto opacity-80">
            </div>
            <button onclick="checkSequence()" class="w-full bg-slate-800 text-white py-4 rounded-2xl font-black uppercase shadow-[0_6px_0_0_#1e293b] active:translate-y-1 active:shadow-none transition-all">
                Selesai Susun 🧩
            </button>
        </div>
    </div>`;

                setTimeout(() => {
                    const img = new Image();
                    img.src = q.target_img;
                    img.onload = function () {
                        const pieces = [];
                        const rows = 2; // Tetap 2 baris
                        const cols = 3; // Menjadi 3 kolom
                        const pW = img.width / cols;
                        const pH = img.height / rows;

                        // Loop sekarang sampai 6 (rows * cols)
                        for (let i = 0; i < 6; i++) {
                            const canvas = document.createElement('canvas');
                            canvas.width = pW;
                            canvas.height = pH;
                            const ctx = canvas.getContext('2d');

                            // Kalkulasi koordinat X dan Y untuk 6 potongan
                            const sx = (i % cols) * pW;
                            const sy = Math.floor(i / cols) * pH;

                            ctx.drawImage(img, sx, sy, pW, pH, 0, 0, pW, pH);
                            pieces.push({ id: i, data: canvas.toDataURL() });
                        }

                        window.shuffledPieces = [...pieces].sort(() => Math.random() - 0.5);
                        renderPuzzle();
                    };
                }, 0);
            }

            container.innerHTML = html;
        }

        function checkAnswer(userPick) {
            const q = allQuestions[currentStep];

            // Cek jawaban benar atau salah secara diam-diam
            if (userPick === q.jawaban) {
                correctCount++;
            }

            // Langsung pindah ke soal berikutnya tanpa memaksa benar
            nextStep();
        }

        function nextStep() {
            if (currentStep < allQuestions.length - 1) {
                currentStep++;
                loadSoal();
            } else {
                finishEvaluasi();
            }
        }



        function renderPuzzle() {
            const board = document.getElementById('puzzle-board');
            board.innerHTML = window.shuffledPieces.map((p, index) => `
        <button onclick="handlePuzzleClick(${index})" 
            id="piece-${index}"
            class="relative overflow-hidden rounded-xl border-4 ${firstSelection === index ? 'border-yellow-400 scale-95 ring-4 ring-yellow-200' : 'border-white'} shadow-sm transition-all aspect-square bg-white">
            <img src="${p.data}" class="w-full h-full object-cover pointer-events-none">
        </button>
    `).join('');
        }

        function handlePuzzleClick(index) {
            if (firstSelection === null) {
                // Klik pertama: tandai sebagai kepingan yang mau dipindah
                firstSelection = index;
                renderPuzzle();
            } else {
                // Klik kedua: tukar posisi dengan kepingan pertama
                const temp = window.shuffledPieces[firstSelection];
                window.shuffledPieces[firstSelection] = window.shuffledPieces[index];
                window.shuffledPieces[index] = temp;

                firstSelection = null; // Reset seleksi
                renderPuzzle(); // Gambar ulang papan puzzle
            }
        }

        function checkSequence() {
            const q = allQuestions[currentStep];
            // Ambil urutan ID dari papan yang sekarang sudah ditukar-tukar
            const currentOrder = window.shuffledPieces.map(p => p.id).join('-');

            // Bandingkan dengan jawaban "0-1-2-3"
            if (currentOrder === q.jawaban) {
                correctCount++;
            }

            nextStep();
        }

        function finishEvaluasi() {
            // Hitung nilai akhir dalam skala 0-100
            const finalScore = Math.round((correctCount / allQuestions.length) * 100);

            document.getElementById('quiz-container').innerHTML = `
            <div class="text-center py-10">
                <div class="text-6xl mb-6">📝</div>
                <h2 class="text-4xl font-black text-indigo-600 mb-4 uppercase tracking-tighter">Hasil Evaluasi [cite: 1]</h2>
                <p class="text-lg text-slate-500 mb-10 font-medium">Kamu telah menyelesaikan semua soal. Berikut adalah nilai yang kamu dapatkan:</p>
                
                <div class="bg-indigo-50 p-10 rounded-[3rem] mb-10 border-8 border-white shadow-inner">
                    <span class="text-slate-400 font-bold uppercase block mb-1 tracking-widest text-sm">Skor Akhir</span>
                    <span id="final-score" class="text-8xl font-black text-indigo-600">${finalScore}</span>
                </div>

                <button onclick="submitToTeacher(${finalScore})" class="w-full bg-indigo-600 text-white p-6 rounded-[2.5rem] font-black uppercase shadow-[0_10px_0_0_#4f46e5] hover:translate-y-1 active:shadow-none transition-all text-xl flex items-center justify-center gap-3">
                    Kirim Nilai ke Guru 🚀
                </button>
            </div>
        `;
        }

        function submitToTeacher(score) {
            // Kirim nilai ke database melalui AJAX agar muncul di dashboard guru
            fetch('{{ route('materi.save_progress') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    materi_id: 1,
                    tahap: 7, // Kita tandai tahap 7 sebagai Evaluasi Akhir
                    score: score
                })
            }).then(() => {
                alert("Nilai " + score + " berhasil dikirim!");
                window.location.href = "{{ route('dashboard') }}";
            }).catch(err => {
                console.error("Gagal mengirim nilai:", err);
                window.location.href = "{{ route('dashboard') }}";
            });
        }

        // Jalankan soal pertama saat halaman dimuat
        window.onload = loadSoal;
    </script>
</x-student-layout>