<x-admin-layout>
    <div class="max-w-7xl mx-auto w-full px-4 py-10 flex flex-col items-center gap-8">

        <div class="w-full flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div>
                <div class="inline-block px-5 py-1.5 bg-[#BEE9E8] brutal-border brutal-shadow-sm rounded-2xl text-xs font-black uppercase tracking-widest mb-3 transform -rotate-1 text-black">
                    Panel Guru • {{ $mapel->nama }}
                </div>
                <h1 class="text-4xl md:text-5xl font-black text-black uppercase tracking-tighter transform -rotate-1 drop-shadow-[0_4px_0_rgba(0,0,0,0.1)]">
                    Monitoring <span class="text-[#BEE9E8] text-outline drop-shadow-[0_4px_0_#000]">Siswa</span>
                </h1>
                <p class="text-slate-500 font-bold mt-2">Pantau progres belajar bahasa isyarat siswa secara real-time.</p>
            </div>

            <div class="flex items-center gap-4 flex-shrink-0">
                <a href="{{ route('teacher.materi.index', ['mapel_slug' => $mapel->slug]) }}" 
                   class="bg-[#FFF5B8] brutal-border brutal-shadow-sm brutal-hover px-6 py-3.5 rounded-2xl font-black text-black text-sm flex items-center gap-2 cursor-pointer uppercase tracking-wider">
                    ← Kembali
                </a>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <div class="relative group/tooltip inline-block">
                        <button type="submit" class="bg-[#FFB3B3] brutal-border brutal-shadow-sm brutal-hover px-6 py-3.5 rounded-2xl font-black text-black text-sm flex items-center gap-2 cursor-pointer uppercase tracking-wider">
                            Keluar
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5 text-black fill-none stroke-current" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                <polyline points="16 17 21 12 16 7"></polyline>
                                <line x1="21" y1="12" x2="9" y2="12"></line>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-full">
            <div class="bg-[#FFF5B8] brutal-border brutal-shadow-sm rounded-[2rem] p-6 flex flex-col justify-between">
                <div>
                    <p class="text-xs uppercase font-black text-slate-700 tracking-wider mb-2">Jumlah Siswa</p>
                    <h3 class="text-4xl font-black text-black">{{ $students->count() }}</h3>
                </div>
                <p class="text-xs text-slate-600 font-bold mt-4">Total siswa terdaftar dalam sistem kelas.</p>
            </div>

            <div class="bg-[#BEE9E8] brutal-border brutal-shadow-sm rounded-[2rem] p-6 flex flex-col justify-between">
                <div>
                    <p class="text-xs uppercase font-black text-slate-700 tracking-wider mb-2">Tahap Pembelajaran</p>
                    <h3 class="text-4xl font-black text-black">6 Tahap</h3>
                </div>
                <p class="text-xs text-slate-600 font-bold mt-4">Jumlah tahapan materi belajar bahasa isyarat SIBI.</p>
            </div>

            <div class="bg-[#E0BBE4] brutal-border brutal-shadow-sm rounded-[2rem] p-6 flex flex-col justify-between">
                <div>
                    <p class="text-xs uppercase font-black text-slate-700 tracking-wider mb-2">Ujian Akhir</p>
                    <h3 class="text-4xl font-black text-black">Evaluasi</h3>
                </div>
                <p class="text-xs text-slate-600 font-bold mt-4">Tugas akhir/penilaian pemahaman siswa terintegrasi.</p>
            </div>
        </div>

        <div class="w-full bg-[#FFFEFA] brutal-border brutal-shadow rounded-[2.5rem] overflow-hidden">
            <div class="bg-white border-b-4 border-black px-6 py-4 flex items-center gap-3">
                <span class="w-4 h-4 rounded-full bg-[#FFB3B3] border-2 border-black"></span>
                <span class="w-4 h-4 rounded-full bg-[#FFF5B8] border-2 border-black"></span>
                <span class="w-4 h-4 rounded-full bg-[#D4F1BE] border-2 border-black"></span>
                <span class="ml-3 font-black text-sm uppercase tracking-widest text-slate-700">Rekap Progress Belajar Siswa</span>
            </div>

            <div class="overflow-x-auto p-2">
                <table class="w-full text-left border-collapse min-w-[800px]">
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
                                                        </button>
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
                                    <p class="font-black text-lg text-slate-400 uppercase tracking-widest">Belum ada siswa terdaftar</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <div id="detail-modal" class="fixed inset-0 z-[9999] bg-slate-900/60 backdrop-blur-sm hidden flex-col items-center justify-center opacity-0 transition-all duration-300">
        <div class="bg-white brutal-border brutal-shadow rounded-[2.5rem] w-full max-w-lg mx-4 flex flex-col transform scale-90 transition-transform duration-300 overflow-hidden" id="detail-content">
            <div class="bg-white border-b-4 border-black px-6 py-4 flex items-center justify-between">
                <span class="font-black text-sm uppercase tracking-widest text-slate-700">Detail Jawaban</span>
                <button onclick="closeDetailModal()" class="text-black font-black uppercase text-xs hover:text-red-500">Tutup (X)</button>
            </div>
            <div class="p-6 overflow-y-auto max-h-[60vh] flex flex-col gap-4 bg-[#FFF9F0]">
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
                <div class="flex flex-col gap-3" id="modal-questions-list"></div>
            </div>
        </div>
    </div>

    <script>
        const questionDescriptions = {
            "1": { title: "Soal 1: Piket & Kebersihan Kelas", category: "Literasi", text: "Memilih aktivitas membersihkan kelas agar rapi." },
            "2": { title: "Soal 2: Menghargai Keberagaman", category: "Literasi", text: "Mengidentifikasi gambar sikap menghargai perbedaan agama." },
            "3": { title: "Soal 3: Urutan Membersihkan", category: "Spasial", text: "Menyusun alur gambar temporal kegiatan piket sekolah." },
            "4": { title: "Soal 4: Puzzle Keragaman", category: "Spasial", text: "Menyusun kepingan puzzle gambar anak-anak daerah." },
            "5": { title: "Soal 5: Hubungkan Makna", category: "Literasi", text: "Menghubungkan gambar keragaman ke teks maknanya." },
            "6": { title: "Soal 6: Susun Kalimat", category: "Literasi", text: "Menyusun acak kata: Abdul Ikut Kerja Bakti." },
            "7": { title: "Soal 7: Deteksi Gerakan", category: "Spasial", text: "Mengidentifikasi gerakan menari pada Tari Zapin Riau." },
            "8": { title: "Soal 8: Siluet Alat Musik", category: "Spasial", text: "Mencocokkan gambar berwarna dengan bayangannya." },
            "9": { title: "Soal 9: Evaluasi Kebersihan", category: "Spasial", text: "Menilai perbuatan kerja bakti (Bagus / Buruk)." },
            "10": { title: "Soal 10: Siti Membantu", category: "Literasi", text: "Mengambil keputusan menolong teman membawa buku." }
        };

        function showEvaluationDetail(studentName, answers, score) {
            document.getElementById('modal-student-name').innerText = studentName;
            document.getElementById('modal-score').innerText = score + '/100';

            const list = document.getElementById('modal-questions-list');
            list.innerHTML = '';

            if (!answers || Object.keys(answers).length === 0) {
                list.innerHTML = `<div class="bg-white border-2 border-dashed border-slate-300 rounded-xl p-6 text-center text-slate-500 font-bold">Detail jawaban tidak tersedia.</div>`;
            } else {
                for (let qId = 1; qId <= 10; qId++) {
                    const isCorrect = answers[qId];
                    const qInfo = questionDescriptions[qId];
                    const row = document.createElement('div');
                    row.className = `brutal-border p-4 rounded-xl flex items-center justify-between gap-4 ${isCorrect ? 'bg-[#D4F1BE]/40' : 'bg-[#FFB3B3]/40'}`;
                    row.innerHTML = `
                        <div class="flex-grow">
                            <div class="font-black text-sm text-slate-800">${qInfo.title}</div>
                            <p class="text-xs text-slate-600 font-bold">${qInfo.text}</p>
                        </div>
                        <div class="flex-shrink-0 font-black text-lg ${isCorrect ? 'text-green-600' : 'text-red-600'}">
                            ${isCorrect ? '✓' : '✕'}
                        </div>
                    `;
                    list.appendChild(row);
                }
            }

            const modal = document.getElementById('detail-modal');
            const content = document.getElementById('detail-content');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                content.classList.remove('scale-90');
                content.classList.add('scale-100');
            }, 10);
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
</x-admin-layout>