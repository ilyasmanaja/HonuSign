<x-student-layout>
    <div class="max-w-7xl mx-auto w-full px-4 py-10 flex flex-col items-center gap-8">

        <!-- Floating Decorations -->
        <div class="fixed top-20 left-8 text-5xl animate-bounce pointer-events-none select-none opacity-30"
            style="animation-delay: 0.2s;">📊</div>
        <div class="fixed bottom-20 right-8 text-4xl animate-bounce pointer-events-none select-none opacity-30"
            style="animation-delay: 0.8s;">🎓</div>

        <!-- Header Section -->
        <div class="w-full flex flex-col md:flex-row justify-between items-start md:items-center gap-6">

            <!-- Judul -->
            <div>
                <div class="inline-block px-5 py-1.5 bg-[#BEE9E8] brutal-border brutal-shadow-sm rounded-2xl text-xs font-black uppercase tracking-widest mb-3 transform -rotate-1">
                    Panel Guru
                </div>
                <h1 class="text-4xl md:text-5xl font-black text-black uppercase tracking-tighter transform -rotate-1 drop-shadow-[0_4px_0_rgba(0,0,0,0.1)]">
                    Monitoring <span class="text-[#BEE9E8] text-outline drop-shadow-[0_4px_0_#000]">Siswa</span>
                </h1>
                <p class="text-slate-500 font-bold mt-2">Pantau progres belajar bahasa isyarat siswa secara real-time.</p>
            </div>

            <!-- Aksi Kanan -->
            <div class="flex items-center gap-4 flex-shrink-0">

                <!-- Badge Jumlah Siswa -->
                <div class="bg-[#D4F1BE] brutal-border brutal-shadow-sm px-6 py-3 rounded-2xl font-black text-black text-sm transform rotate-1">
                    👥 {{ $students->count() }} Siswa Terdaftar
                </div>

                <!-- Tombol Keluar -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="bg-[#FFB3B3] brutal-border brutal-shadow-sm brutal-hover px-6 py-3 rounded-2xl font-black text-black text-sm flex items-center gap-2 cursor-pointer">
                        🚪 Keluar Akun
                    </button>
                </form>
            </div>
        </div>

        <!-- Tabel Progress Siswa -->
        <div class="w-full bg-[#FFFEFA] brutal-border brutal-shadow rounded-[2.5rem] overflow-hidden">

            <!-- Mac-style header bar -->
            <div class="bg-white border-b-4 border-black px-6 py-4 flex items-center gap-3">
                <span class="w-4 h-4 rounded-full bg-[#FFB3B3] border-2 border-black"></span>
                <span class="w-4 h-4 rounded-full bg-[#FFF5B8] border-2 border-black"></span>
                <span class="w-4 h-4 rounded-full bg-[#D4F1BE] border-2 border-black"></span>
                <span class="ml-3 font-black text-sm uppercase tracking-widest text-slate-700">Rekap Progress Belajar</span>
            </div>

            <div class="overflow-x-auto p-2">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b-4 border-black">
                            <th class="py-4 px-6 font-black text-black text-sm uppercase tracking-widest bg-[#FFF5B8]">Nama Siswa</th>
                            <th class="py-4 px-4 text-center font-black text-black text-sm uppercase">T1</th>
                            <th class="py-4 px-4 text-center font-black text-black text-sm uppercase">T2 (Kuis)</th>
                            <th class="py-4 px-4 text-center font-black text-black text-sm uppercase">T3</th>
                            <th class="py-4 px-4 text-center font-black text-black text-sm uppercase">T4</th>
                            <th class="py-4 px-4 text-center font-black text-black text-sm uppercase">T5</th>
                            <th class="py-4 px-4 text-center font-black text-black text-sm uppercase">T6</th>
                            <th class="py-4 px-4 text-center font-black text-black text-sm uppercase bg-[#E0BBE4]">Evaluasi 🏆</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $student)
                            <tr class="border-b-2 border-black/10 hover:bg-[#BEE9E8]/20 transition-all duration-200">

                                <!-- Nama Siswa -->
                                <td class="py-5 px-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-2xl bg-[#BEE9E8] brutal-border brutal-shadow-sm flex items-center justify-center font-black text-lg flex-shrink-0">
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
                                    <td class="py-5 px-4 text-center {{ $i == 7 ? 'bg-[#E0BBE4]/20' : '' }}">
                                        @php
                                            $prog = $student->progress->where('tahap', $i)->first();
                                        @endphp

                                        @if($prog && $prog->is_completed)
                                            <div class="flex flex-col items-center gap-1">
                                                <span class="text-2xl">✅</span>
                                                @if($prog->score > 0)
                                                    <span
                                                        class="text-[11px] font-black px-2 py-0.5 rounded-lg {{ $i == 7 ? 'bg-[#E0BBE4] brutal-border' : 'bg-[#D4F1BE] brutal-border' }}">
                                                        {{ $prog->score }}
                                                    </span>
                                                @endif
                                            </div>
                                        @else
                                            <span class="text-2xl">—</span>
                                        @endif
                                    </td>
                                @endfor

                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="py-16 text-center">
                                    <div class="flex flex-col items-center gap-4">
                                        <span class="text-6xl">🎒</span>
                                        <p class="font-black text-xl text-slate-400 uppercase">Belum ada siswa terdaftar</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Legend -->
        <div class="flex flex-wrap gap-4 justify-center">
            <div class="flex items-center gap-2 bg-[#FFFEFA] brutal-border brutal-shadow-sm px-4 py-2 rounded-2xl text-sm font-bold">
                <span>✅</span> Tahap Selesai
            </div>
            <div class="flex items-center gap-2 bg-[#FFFEFA] brutal-border brutal-shadow-sm px-4 py-2 rounded-2xl text-sm font-bold">
                <span>—</span> Belum Dikerjakan
            </div>
            <div class="flex items-center gap-2 bg-[#D4F1BE] brutal-border brutal-shadow-sm px-4 py-2 rounded-2xl text-sm font-bold">
                <span>Angka</span> = Nilai Kuis
            </div>
            <div class="flex items-center gap-2 bg-[#E0BBE4] brutal-border brutal-shadow-sm px-4 py-2 rounded-2xl text-sm font-bold">
                🏆 = Evaluasi Akhir
            </div>
        </div>

    </div>
</x-student-layout>