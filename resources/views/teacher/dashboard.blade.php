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
                <button type="submit"
                    class="bg-[#FFB3B3] brutal-border brutal-shadow-sm brutal-hover px-6 py-3.5 rounded-2xl font-black text-black text-sm flex items-center gap-2 cursor-pointer uppercase tracking-wider">
                    Keluar Akun
                </button>
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
                                                @if($prog->score > 0)
                                                    <span class="text-[11px] font-black px-2 py-0.5 rounded-lg bg-white border border-black shadow-[1px_1px_0_#000] text-black">
                                                        {{ $prog->score }}
                                                    </span>
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
            <div class="flex items-center gap-2.5 bg-[#D4F1BE] brutal-border brutal-shadow-sm px-5 py-2.5 rounded-2xl text-xs font-black uppercase tracking-wider text-black">
                <span>Angka</span>
                Nilai Kuis / Latihan
            </div>
            <div class="flex items-center gap-2.5 bg-[#E0BBE4] brutal-border brutal-shadow-sm px-5 py-2.5 rounded-2xl text-xs font-black uppercase tracking-wider text-black">
                <span>Evaluasi</span>
                Ujian Akhir (Tahap 7)
            </div>
        </div>

    </div>
</x-student-layout>