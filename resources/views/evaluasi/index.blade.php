<x-student-layout>
    <div class="max-w-4xl w-full px-6 py-12 flex flex-col items-center">

        <!-- Progress Bar -->
        <div class="w-full mb-10 max-w-3xl">
            <div class="flex justify-between mb-4 items-end">
                <span id="soal-title" class="font-black text-xl tracking-widest uppercase text-black">Soal 1 dari
                    5</span>
                <span id="score-display"
                    class="text-xl font-black text-black bg-[#FFF5B8] brutal-border px-4 py-1 rounded-2xl transform rotate-2 shadow-[2px_2px_0_#000]">Skor:
                    0</span>
            </div>
            <div class="w-full h-8 bg-white brutal-border brutal-shadow-sm rounded-2xl overflow-hidden p-1">
                <div id="progress-bar"
                    class="h-full bg-[#E0BBE4] rounded-xl transition-all duration-500 border-r-4 border-black"
                    style="width: 10%"></div>
            </div>
        </div>

        <!-- Quiz Container -->
        <div id="quiz-container"
            class="w-full bg-[#FFFEFA] brutal-border brutal-shadow rounded-[3rem] p-8 md:p-12 mb-10 transition-all duration-300">
        </div>

        <!-- Navigation -->
        <div id="navigation" class="flex gap-4"></div>
    </div>

    <script>
        const allQuestions = [{
            id: 1,
            tipe: 'pilihan_gambar',
            pertanyaan: "Jika kita membersihkan kelas maka kelas akan terlihat rapi. Pilihlah aktivitas apa saja yang dapat menciptakan kelas yang rapi dan bersih?",
            pilihan: {
                A: "{{ asset('images/evaluasi/siska_piket.png') }}",
                B: "{{ asset('images/evaluasi/buang_sampah_sungai.png') }}",
                C: "{{ asset('images/evaluasi/coret_halte.png') }}",
                D: "{{ asset('images/evaluasi/sampah_sungai.png') }}"
            },
            jawaban: "A"
        },
        {
            id: 2,
            tipe: 'pilihan_gambar',
            pertanyaan: "Gambar manakah yang menunjukkan sikap menghargai keberagaman?",
            pilihan: {
                A: "{{ asset('images/evaluasi/langgar_lalulintas.png') }}",
                B: "{{ asset('images/evaluasi/kerja_bakti.png') }}",
                C: "{{ asset('images/evaluasi/ngobrol_shalat.png') }}",
                D: "{{ asset('images/evaluasi/idul_fitri2.png') }}"
            },
            jawaban: "D"
        },
        {
            id: 3,
            tipe: 'pilihan_ganda',
            pertanyaan: "Menurut Ananda bagaimana keadaan halaman sekolah setelah kegiatan tersebut selesai?",
            gambar_soal: "{{ asset('images/evaluasi/goro.png') }}",
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
            target_img: "{{ asset('images/materi/tahap1/kelas.png') }}",
            jawaban: "0-1-2-3-4-5"
        },
        {
            id: 5,
            tipe: 'pilihan_ganda',
            pertanyaan: "Berdasarkan gambar di bawah ini, apa yang dilakukan oleh anak-anak?",
            gambar_soal: "{{ asset('images/evaluasi/tarian.png') }}",
            pilihan: {
                A: "Menari",
                B: "Belajar",
                C: "Tidur"
            },
            jawaban: "A"
        }
        ];

        let currentStep = 0;
        let correctCount = 0;
        let userSequence = [];
        let firstSelection = null;

        const PASTEL_COLORS = ['#BEE9E8', '#FFD1E3', '#FFF5B8', '#D4F1BE', '#E0BBE4'];
        const BADGE_LABELS = ['A', 'B', 'C', 'D'];

        function loadSoal() {
            const q = allQuestions[currentStep];
            const container = document.getElementById('quiz-container');
            userSequence = [];
            firstSelection = null;

            // Update progress
            document.getElementById('soal-title').innerText =
                `Soal ${currentStep + 1} dari ${allQuestions.length}`;
            document.getElementById('progress-bar').style.width =
                `${((currentStep + 1) / allQuestions.length) * 100}%`;

            // Pertanyaan
            let html =
                `<h3 class="text-2xl md:text-3xl font-black text-black mb-8 leading-snug">${q.pertanyaan}</h3>`;

            // Gambar soal jika ada
            if (q.gambar_soal) {
                html +=
                    `<div class="w-full mb-8 brutal-border brutal-shadow-sm rounded-[2rem] overflow-hidden bg-white">
                        <img src="${q.gambar_soal}" class="w-full h-auto object-contain"
                             onerror="this.src='https://placehold.co/800x400?text=Gambar+Tidak+Ditemukan'">
                     </div>`;
            }

            // Pilihan Gambar
            if (q.tipe === 'pilihan_gambar') {
                html += `<div class="grid grid-cols-2 gap-4">`;
                let i = 0;
                for (let key in q.pilihan) {
                    const color = PASTEL_COLORS[i % PASTEL_COLORS.length];
                    html += `
                        <button onclick="checkAnswer('${key}')"
                            class="group relative overflow-hidden aspect-square brutal-border brutal-shadow-sm rounded-[2rem] hover:-translate-y-2 transition-all duration-300 bg-white cursor-pointer"
                            style="box-shadow: 6px 6px 0 #000;">
                            <img src="${q.pilihan[key]}" class="w-full h-full object-cover group-hover:scale-105 transition-all duration-300"
                                 onerror="this.src='https://placehold.co/400x400?text=${key}'">
                            <div class="absolute top-3 left-3 w-10 h-10 rounded-2xl flex items-center justify-center font-black text-black border-2 border-black text-sm"
                                 style="background-color: ${color};">
                                ${key}
                            </div>
                        </button>`;
                    i++;
                }
                html += `</div>`;
            }
            // Pilihan Ganda
            else if (q.tipe === 'pilihan_ganda') {
                html += `<div class="grid grid-cols-1 md:grid-cols-2 gap-4">`;
                let i = 0;
                for (let key in q.pilihan) {
                    const color = PASTEL_COLORS[i % PASTEL_COLORS.length];
                    html += `
                        <button onclick="checkAnswer('${key}')"
                            class="p-6 brutal-border brutal-shadow-sm rounded-2xl hover:-translate-y-2 transition-all duration-300 text-center font-black text-black text-xl cursor-pointer flex items-center gap-4"
                            style="background-color: ${color}; box-shadow: 4px 4px 0 #000;">
                            <span class="w-10 h-10 bg-white rounded-xl flex items-center justify-center font-black text-base border-2 border-black flex-shrink-0">${key}</span>
                            ${q.pilihan[key]}
                        </button>`;
                    i++;
                }
                html += `</div>`;
            }
            // Puzzle
            else if (q.tipe === 'puzzle') {
                html += `
                    <div class="flex flex-col md:flex-row gap-8 items-start">
                        <div class="w-full md:w-2/3">
                            <p class="text-sm font-black text-slate-500 mb-4 uppercase tracking-widest text-center bg-[#FFF5B8] brutal-border brutal-shadow-sm px-4 py-2 rounded-xl inline-block">
                                👆 Klik 2 kepingan untuk menukar!
                            </p>
                            <div id="puzzle-board" class="grid grid-cols-3 gap-2 bg-[#BEE9E8] brutal-border brutal-shadow-sm p-4 rounded-[2rem]"></div>
                        </div>
                        <div class="w-full md:w-1/3 flex flex-col items-center gap-4">
                            <p class="text-sm font-black text-black uppercase tracking-widest bg-[#FFD1E3] brutal-border brutal-shadow-sm px-4 py-2 rounded-xl">Target Gambar:</p>
                            <div class="brutal-border brutal-shadow-sm rounded-2xl overflow-hidden w-full">
                                <img src="${q.target_img}" class="w-full h-auto opacity-90">
                            </div>
                            <button onclick="checkSequence()"
                                class="w-full bg-[#D4F1BE] brutal-border brutal-shadow brutal-hover text-black py-4 rounded-2xl font-black uppercase text-lg cursor-pointer">
                                Selesai Susun 🧩
                            </button>
                        </div>
                    </div>`;

                setTimeout(() => {
                    const img = new Image();
                    img.src = q.target_img;
                    img.onload = function () {
                        const pieces = [];
                        const rows = 2;
                        const cols = 3;
                        const pW = img.width / cols;
                        const pH = img.height / rows;

                        for (let i = 0; i < 6; i++) {
                            const canvas = document.createElement('canvas');
                            canvas.width = pW;
                            canvas.height = pH;
                            const ctx = canvas.getContext('2d');
                            const sx = (i % cols) * pW;
                            const sy = Math.floor(i / cols) * pH;
                            ctx.drawImage(img, sx, sy, pW, pH, 0, 0, pW, pH);
                            pieces.push({
                                id: i,
                                data: canvas.toDataURL()
                            });
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
            if (userPick === q.jawaban) correctCount++;
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
                    class="relative overflow-hidden rounded-xl brutal-border transition-all aspect-square bg-white cursor-pointer ${firstSelection === index ? 'scale-95 opacity-70' : ''}"
                    style="box-shadow: ${firstSelection === index ? '0 0 0 4px #FFF5B8' : '3px 3px 0 #000'};">
                    <img src="${p.data}" class="w-full h-full object-cover pointer-events-none">
                </button>
            `).join('');
        }

        function handlePuzzleClick(index) {
            if (firstSelection === null) {
                firstSelection = index;
                renderPuzzle();
            } else {
                const temp = window.shuffledPieces[firstSelection];
                window.shuffledPieces[firstSelection] = window.shuffledPieces[index];
                window.shuffledPieces[index] = temp;
                firstSelection = null;
                renderPuzzle();
            }
        }

        function checkSequence() {
            const q = allQuestions[currentStep];
            const currentOrder = window.shuffledPieces.map(p => p.id).join('-');
            if (currentOrder === q.jawaban) correctCount++;
            nextStep();
        }

        function finishEvaluasi() {
            const finalScore = Math.round((correctCount / allQuestions.length) * 100);
            const emoji = finalScore >= 80 ? '🏆' : finalScore >= 60 ? '🌟' : '💪';
            const pesan = finalScore >= 80 ? 'Luar Biasa!' : finalScore >= 60 ? 'Bagus Sekali!' :
                'Semangat Terus!';
            const bgColor = finalScore >= 80 ? '#D4F1BE' : finalScore >= 60 ? '#FFF5B8' : '#FFD1E3';

            // Update progress bar ke 100%
            document.getElementById('progress-bar').style.width = '100%';
            document.getElementById('soal-title').innerText = 'Evaluasi Selesai!';

            document.getElementById('quiz-container').innerHTML = `
                <div class="text-center py-8 flex flex-col items-center gap-6">
                    <div class="text-8xl animate-bounce">${emoji}</div>

                    <h2 class="text-4xl md:text-5xl font-black text-black uppercase tracking-tighter transform -rotate-1">
                        ${pesan}
                    </h2>
                    <p class="text-lg font-bold text-slate-500">Kamu telah menyelesaikan semua soal evaluasi!</p>

                    <div class="brutal-border brutal-shadow rounded-[2.5rem] p-10 w-full max-w-xs" style="background-color: ${bgColor};">
                        <span class="font-black text-black uppercase tracking-widest block mb-2 text-sm">Skor Akhir Kamu</span>
                        <span class="text-8xl font-black text-black">${finalScore}</span>
                        <span class="text-2xl font-black text-black">/100</span>
                    </div>

                    <button onclick="submitToTeacher(${finalScore})"
                        class="bg-[#D4F1BE] brutal-border brutal-shadow brutal-hover text-black px-12 py-5 rounded-[3rem] font-black uppercase tracking-widest text-xl flex items-center gap-4 cursor-pointer">
                        Kirim ke Guru <span class="text-3xl animate-bounce">🚀</span>
                    </button>
                </div>
            `;
        }

        function submitToTeacher(score) {
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
                    score: score
                })
            }).then(() => {
                window.location.href = "{{ route('dashboard') }}";
            })
                .catch(err => {
                    console.error("Gagal mengirim nilai:", err);
                    window.location.href = "{{ route('dashboard') }}";
                });
        }

        window.onload = loadSoal;
    </script>
</x-student-layout>