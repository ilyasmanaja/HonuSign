<x-student-layout>
    <div class="max-w-7xl mx-auto w-full px-4 py-10 flex flex-col items-center gap-8">

        <!-- Header Section -->
        <div class="w-full flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <!-- Judul -->
            <div>
                <div class="inline-block px-5 py-1.5 bg-[#BEE9E8] brutal-border brutal-shadow-sm rounded-2xl text-xs font-black uppercase tracking-widest mb-3 transform -rotate-1 text-black">
                    Panel Guru
                </div>
                <h1 class="text-4xl md:text-5xl font-black text-black uppercase tracking-tighter transform -rotate-1 drop-shadow-[0_4px_0_rgba(0,0,0,0.1)]">
                    Monitoring <span class="text-[#BEE9E8] text-outline drop-shadow-[0_4px_0_#000]">Siswa</span>
                </h1>
                <p class="text-slate-500 font-bold mt-2">Pantau progres belajar bahasa isyarat siswa secara real-time.</p>
            </div>

            <!-- Tombol Keluar (Clean & Elegant Style) -->
            <form method="POST" action="{{ route('logout') }}" class="flex-shrink-0">
                @csrf
                <div class="relative group/tooltip inline-block">
                    <button type="submit"
                        class="bg-[#FFB3B3] brutal-border brutal-shadow-sm brutal-hover px-6 py-3.5 rounded-2xl font-black text-black text-sm flex items-center gap-2 cursor-pointer uppercase tracking-wider">
                        Keluar Akun
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            class="w-5 h-5 text-black fill-none stroke-current" stroke-width="3.5"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                    </button>
                    <div class="pointer-events-none absolute top-full left-1/2 -translate-x-1/2 mt-3 bg-[#FFD1E3] brutal-border brutal-shadow-sm px-3 py-1.5 rounded-lg text-sm font-bold opacity-0 scale-95 group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-150 whitespace-nowrap z-50 text-black">
                        Keluar dari Sesi
                    </div>
                </div>
            </form>
        </div>

        <!-- Stats Overview Cards (Bento System) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-full">
            <!-- Card 1: Total Siswa -->
            <div class="bg-[#FFF5B8] brutal-border brutal-shadow-sm rounded-[2rem] p-6 flex flex-col justify-between">
                <div>
                    <p class="text-xs uppercase font-black text-slate-700 tracking-wider mb-2">Jumlah Siswa</p>
                    <h3 class="text-4xl font-black text-black">{{ $students->count() }}</h3>
                </div>
                <p class="text-xs text-slate-600 font-bold mt-4">Total siswa terdaftar dalam sistem kelas.</p>
            </div>

            <!-- Card 2: Tahapan Belajar -->
            <div class="bg-[#BEE9E8] brutal-border brutal-shadow-sm rounded-[2rem] p-6 flex flex-col justify-between">
                <div>
                    <p class="text-xs uppercase font-black text-slate-700 tracking-wider mb-2">Tahap Pembelajaran</p>
                    <h3 class="text-4xl font-black text-black">6 Tahap</h3>
                </div>
                <p class="text-xs text-slate-600 font-bold mt-4">Jumlah tahapan materi belajar bahasa isyarat SIBI.</p>
            </div>

            <!-- Card 3: Evaluasi Akhir -->
            <div class="bg-[#E0BBE4] brutal-border brutal-shadow-sm rounded-[2rem] p-6 flex flex-col justify-between">
                <div>
                    <p class="text-xs uppercase font-black text-slate-700 tracking-wider mb-2">Ujian Akhir</p>
                    <h3 class="text-4xl font-black text-black">Evaluasi</h3>
                </div>
                <p class="text-xs text-slate-600 font-bold mt-4">Tugas akhir/penilaian pemahaman siswa terintegrasi.</p>
            </div>
        </div>

        <!-- Tabel Progress Siswa -->
        <div class="w-full bg-[#FFFEFA] brutal-border brutal-shadow rounded-[2.5rem] overflow-hidden">
            <!-- Mac-style Header Bar -->
            <div class="bg-white border-b-4 border-black px-6 py-4 flex items-center gap-3">
                <span class="w-4 h-4 rounded-full bg-[#FFB3B3] border-2 border-black"></span>
                <span class="w-4 h-4 rounded-full bg-[#FFF5B8] border-2 border-black"></span>
                <span class="w-4 h-4 rounded-full bg-[#D4F1BE] border-2 border-black"></span>
                <span class="ml-3 font-black text-sm uppercase tracking-widest text-slate-700">Rekap Progress Belajar Siswa</span>
            </div>

            <div class="overflow-x-auto p-2">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b-4 border-black">
                            <th class="py-4 px-6 font-black text-black text-sm uppercase tracking-widest bg-[#FFF5B8]">Nama Siswa</th>
                            <th class="py-4 px-4 text-center font-black text-black text-sm uppercase tracking-wider">Tahap 1</th>
                            <th class="py-4 px-4 text-center font-black text-black text-sm uppercase tracking-wider">Tahap 2</th>
                            <th class="py-4 px-4 text-center font-black text-black text-sm uppercase tracking-wider">Tahap 3</th>
                            <th class="py-4 px-4 text-center font-black text-black text-sm uppercase tracking-wider">Tahap 4</th>
                            <th class="py-4 px-4 text-center font-black text-black text-sm uppercase tracking-wider">Tahap 5</th>
                            <th class="py-4 px-4 text-center font-black text-black text-sm uppercase tracking-wider">Tahap 6</th>
                            <th class="py-4 px-4 text-center font-black text-black text-sm uppercase tracking-wider bg-[#E0BBE4]">Evaluasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $student)
                            <tr class="border-b-2 border-black/10 hover:bg-[#BEE9E8]/20 transition-all duration-200">
                                <!-- Nama Siswa -->
                                <td class="py-5 px-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-2xl bg-[#BEE9E8] brutal-border brutal-shadow-sm flex items-center justify-center font-black text-black text-lg flex-shrink-0">
                                            {{ strtoupper(substr($student->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="font-black text-black text-base">{{ $student->name }}</p>
                                            <p class="text-xs text-slate-400 font-medium">{{ $student->email }}</p>
                                        </div>
                                    </div>
                                </td>

                                {{-- Loop Tahap 1 sampai 7 (Evaluasi) --}}
                                @for($i = 1; $i <= 7; $i++)
                                    <td class="py-5 px-4 text-center {{ $i == 7 ? 'bg-[#E0BBE4]/10' : '' }}">
                                        @php
                                            $prog = $student->progress->where('tahap', $i)->first();
                                        @endphp

                                        @if($prog && $prog->is_completed)
                                            <div class="flex flex-col items-center gap-1.5 justify-center">
                                                <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-[#D4F1BE] border-2 border-black text-black shadow-[2px_2px_0_#000]">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-4 h-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                                    </svg>
                                                </span>
                                                @if($prog->score !== null && $i == 7)
                                                    <div class="relative group/tooltip inline-block">
                                                        <button onclick="showEvaluationDetail('{{ addslashes($student->name) }}', {{ $prog->answers ? json_encode($prog->answers) : 'null' }}, {{ $prog->score }})"
                                                                class="text-[11px] font-black px-2.5 py-1 rounded-lg bg-[#FFF5B8] border border-black shadow-[1px_1px_0_#000] text-black hover:-translate-y-0.5 hover:shadow-[2px_2px_0_#000] active:translate-y-0.5 active:shadow-[0px_0px_0_#000] transition-all cursor-pointer flex items-center gap-1">
                                                            <span>{{ $prog->score }}</span>
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                                class="w-3.5 h-3.5 text-black fill-none stroke-current" stroke-width="3.5"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                                <circle cx="11" cy="11" r="8"></circle>
                                                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                                            </svg>
                                                        </button>
                                                        <div class="pointer-events-none absolute bottom-full left-1/2 -translate-x-1/2 mb-2 bg-[#FFD1E3] brutal-border brutal-shadow-sm px-3 py-1.5 rounded-lg text-[10px] font-bold opacity-0 scale-95 group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-150 whitespace-nowrap z-50 text-black">
                                                            Detail Jawaban
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        @else
                                            <span class="text-slate-300 font-bold text-lg">—</span>
                                        @endif
                                    </td>
                                @endfor
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="py-16 text-center bg-[#FFFEFA]">
                                    <div class="flex flex-col items-center justify-center gap-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-16 h-16 text-slate-300">
                                            <circle cx="12" cy="12" r="10" opacity="0.2" />
                                            <path d="M12 14a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-7 6v-1a5 5 0 0 1 10 0v1" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                        </svg>
                                        <p class="font-black text-lg text-slate-400 uppercase tracking-widest">Belum ada siswa terdaftar</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Legend (Petunjuk) -->
        <div class="flex flex-wrap gap-4 justify-center">
            <div class="flex items-center gap-2.5 bg-[#FFFEFA] brutal-border brutal-shadow-sm px-5 py-2.5 rounded-2xl text-xs font-black uppercase tracking-wider text-slate-700">
                <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-[#D4F1BE] border border-black text-black">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-3 h-3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                </span>
                Tahap Selesai
            </div>
            <div class="flex items-center gap-2.5 bg-[#FFFEFA] brutal-border brutal-shadow-sm px-5 py-2.5 rounded-2xl text-xs font-black uppercase tracking-wider text-slate-700">
                <span class="text-slate-300 font-bold">—</span>
                Belum Dikerjakan
            </div>
            <div class="flex items-center gap-2.5 bg-[#E0BBE4] brutal-border brutal-shadow-sm px-5 py-2.5 rounded-2xl text-xs font-black uppercase tracking-wider text-black">
                <span>Evaluasi</span>
                Ujian Akhir (Tahap 7)
            </div>
        </div>

    </div>

    <!-- Detail Evaluasi Modal -->
    <div id="detail-modal" class="fixed inset-0 z-[9999] bg-slate-900/60 backdrop-blur-sm hidden flex-col items-center justify-center opacity-0 transition-all duration-300">
        <div class="bg-white brutal-border brutal-shadow rounded-[2.5rem] w-full max-w-lg mx-4 flex flex-col transform scale-90 transition-transform duration-300 overflow-hidden" id="detail-content">
            <!-- Mac-style Header Bar -->
            <div class="bg-white border-b-4 border-black px-6 py-4 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-[#FFB3B3] border border-black"></span>
                    <span class="w-3 h-3 rounded-full bg-[#FFF5B8] border border-black"></span>
                    <span class="w-3 h-3 rounded-full bg-[#D4F1BE] border border-black"></span>
                    <span class="ml-2 font-black text-sm uppercase tracking-widest text-slate-700">Detail Jawaban Evaluasi</span>
                </div>
                <div class="relative group/tooltip inline-block">
                    <button onclick="closeDetailModal()" class="text-slate-400 hover:text-black cursor-pointer select-none flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            class="w-6 h-6 text-black fill-none stroke-current" stroke-width="3.5"
                            stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                    <div class="pointer-events-none absolute bottom-full left-1/2 -translate-x-1/2 mb-2 bg-[#FFD1E3] brutal-border brutal-shadow-sm px-3 py-1.5 rounded-lg text-xs font-bold opacity-0 scale-95 group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-150 whitespace-nowrap z-50 text-black">
                        Tutup
                    </div>
                </div>
            </div>

            <!-- Modal Content Body -->
            <div class="p-6 overflow-y-auto max-h-[60vh] flex flex-col gap-4 bg-[#FFF9F0]">
                <!-- Student Card -->
                <div class="bg-white brutal-border brutal-shadow-sm rounded-2xl p-4 flex justify-between items-center">
                    <div>
                        <span class="text-xs font-black uppercase tracking-wider text-slate-500 block">Siswa</span>
                        <span id="modal-student-name" class="text-lg font-black text-black">-</span>
                    </div>
                    <div class="bg-[#FFF5B8] brutal-border px-3 py-1 rounded-xl transform rotate-2 text-center">
                        <span class="text-[10px] font-black uppercase text-slate-600 block">Skor</span>
                        <span id="modal-score" class="font-black text-lg text-black">-</span>
                    </div>
                </div>

                <div class="h-0.5 bg-black/10 my-1"></div>

                <!-- Questions List -->
                <div class="flex flex-col gap-3" id="modal-questions-list">
                    <!-- Dynamic question rows go here -->
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="bg-white border-t-4 border-black p-4 flex justify-end">
                <button onclick="closeDetailModal()" class="bg-[#FFF5B8] brutal-border brutal-shadow-sm brutal-hover px-6 py-2.5 rounded-xl font-black uppercase text-xs cursor-pointer text-black">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <script>
        const questionDescriptions = {
            "1": { title: "Soal 1: Piket & Kebersihan Kelas", category: "Literasi", text: "Memilih aktivitas membersihkan kelas agar rapi." },
            "2": { title: "Soal 2: Menghargai Keberagaman", category: "Literasi", text: "Mengidentifikasi gambar sikap menghargai perbedaan agama." },
            "3": { title: "Soal 3: Urutan Membersihkan Sekolah", category: "Spasial", text: "Menyusun alur gambar temporal kegiatan piket sekolah." },
            "4": { title: "Soal 4: Puzzle Keragaman Budaya", category: "Spasial", text: "Menyusun kepingan puzzle gambar anak-anak daerah." },
            "5": { title: "Soal 5: Hubungkan Aksi ke Makna", category: "Literasi", text: "Menghubungkan gambar keragaman ke teks maknanya." },
            "6": { title: "Soal 6: Susun Kalimat Kerja Bakti", category: "Literasi", text: "Menyusun acak kata: Abdul Ikut Kerja Bakti Di Sekolah." },
            "7": { title: "Soal 7: Deteksi Gerakan Tari Zapin", category: "Spasial", text: "Mengidentifikasi gerakan menari pada Tari Zapin Riau." },
            "8": { title: "Soal 8: Siluet Alat Musik Riau", category: "Spasial", text: "Mencocokkan gambar berwarna alat musik dengan bayangannya." },
            "9": { title: "Soal 9: Evaluasi Kebersihan", category: "Spasial & Sikap", text: "Menilai perbuatan kerja bakti (Bagus / Buruk)." },
            "10": { title: "Soal 10: Siti Membantu Teman", category: "Literasi", text: "Mengambil keputusan menolong teman membawa buku." }
        };

        function showEvaluationDetail(studentName, answers, score) {
            document.getElementById('modal-student-name').innerText = studentName;
            document.getElementById('modal-score').innerText = score + '/100';

            const list = document.getElementById('modal-questions-list');
            list.innerHTML = '';

            if (!answers || Object.keys(answers).length === 0) {
                list.innerHTML = `
                    <div class="bg-white border-2 border-dashed border-slate-300 rounded-xl p-6 text-center text-slate-500 font-bold">
                        Detail jawaban tidak tersedia untuk data progress lama.
                    </div>
                `;
            } else {
                for (let qId = 1; qId <= 10; qId++) {
                    const isCorrect = answers[qId];
                    const qInfo = questionDescriptions[qId];
                    
                    const row = document.createElement('div');
                    row.className = `brutal-border p-4 rounded-xl flex items-center justify-between gap-4 ${isCorrect ? 'bg-[#D4F1BE]/40' : 'bg-[#FFB3B3]/40'}`;
                    row.innerHTML = `
                        <div class="flex-grow">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="px-2 py-0.5 text-[9px] font-black uppercase tracking-wider rounded border border-black bg-white text-black">
                                    ${qInfo.category}
                                </span>
                                <span class="font-black text-sm text-slate-800">${qInfo.title}</span>
                            </div>
                            <p class="text-xs text-slate-600 font-bold">${qInfo.text}</p>
                        </div>
                        <div class="flex-shrink-0 flex items-center justify-center">
                            ${isCorrect ? `
                                <span class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-[#D4F1BE] border-2 border-black text-black font-black text-xs shadow-[1px_1px_0_#000]">
                                    ✓
                                </span>
                            ` : `
                                <span class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-[#FFB3B3] border-2 border-black text-black font-black text-xs shadow-[1px_1px_0_#000]">
                                    ✕
                                </span>
                            `}
                        </div>
                    `;
                    list.appendChild(row);
                }
            }

            // Open Modal
            const modal = document.getElementById('detail-modal');
            const content = document.getElementById('detail-content');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            void modal.offsetWidth;
            modal.classList.remove('opacity-0');
            content.classList.remove('scale-90');
            content.classList.add('scale-100');
        }

        function closeDetailModal() {
            const modal = document.getElementById('detail-modal');
            const content = document.getElementById('detail-content');
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