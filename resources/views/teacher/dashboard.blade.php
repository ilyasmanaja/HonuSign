<x-student-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-[2rem] p-8 border-4 border-slate-200">
                
                <div class="flex justify-between items-center mb-10">
                    <div>
                        <h2 class="text-3xl font-black text-slate-800 uppercase tracking-tighter">Monitoring Siswa 📊</h2>
                        <p class="text-slate-500 font-medium">Pantau progres belajar bahasa isyarat siswa secara real-time.</p>
                    </div>
                    <div class="bg-emerald-100 text-emerald-700 px-6 py-2 rounded-full font-bold text-sm border-2 border-emerald-200">
                        {{ $students->count() }} Siswa Terdaftar
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="text-slate-400 text-xs uppercase tracking-widest border-b-2 border-slate-100">
                                <th class="py-4 px-4">Nama Siswa</th>
                                <th class="py-4 px-4 text-center">T1</th>
                                <th class="py-4 px-4 text-center">T2 (Kuis)</th>
                                <th class="py-4 px-4 text-center">T3</th>
                                <th class="py-4 px-4 text-center">T4</th>
                                <th class="py-4 px-4 text-center">T5</th>
                                <th class="py-4 px-4 text-center">T6</th>
                                <th class="py-4 px-4 text-center bg-indigo-50 text-indigo-600 rounded-t-xl">Evaluasi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($students as $student)
                            <tr class="hover:bg-slate-50/50 transition-all">
                                <td class="py-5 px-4">
                                    <span class="font-bold text-slate-700">{{ $student->name }}</span>
                                    <br><span class="text-xs text-slate-400">{{ $student->email }}</span>
                                </td>
                                
                                {{-- Loop Tahap 1 sampai 7 (Evaluasi) --}}
                                @for($i = 1; $i <= 7; $i++)
                                    <td class="py-5 px-4 text-center {{ $i == 7 ? 'bg-indigo-50/30' : '' }}">
                                        @php
                                            $prog = $student->progress->where('tahap', $i)->first();
                                        @endphp

                                        @if($prog && $prog->is_completed)
                                            <div class="flex flex-col items-center">
                                                <span class="text-emerald-500">✅</span>
                                                @if($prog->score > 0)
                                                    <span class="text-[10px] font-black {{ $i == 7 ? 'text-indigo-600' : 'text-slate-500' }}">
                                                        Nilai: {{ $prog->score }}
                                                    </span>
                                                @endif
                                            </div>
                                        @else
                                            <span class="text-slate-200 text-xs">-</span>
                                        @endif
                                    </td>
                                @endfor
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-student-layout>