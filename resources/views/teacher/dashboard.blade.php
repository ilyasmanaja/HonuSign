<x-admin-layout>
    <div class="max-w-5xl mx-auto py-12 px-6">
        
        <div class="mb-10 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="text-center md:text-left">
                <h1 class="text-4xl font-black text-black uppercase tracking-tight mb-2">Halo Guru HonuSign! 👋</h1>
                <p class="text-lg font-bold text-slate-600">Silakan pilih mata pelajaran terlebih dahulu untuk mengelola atau menambah materi baru.</p>
            </div>
            
            <form method="POST" action="{{ route('logout') }}" class="flex-shrink-0">
                @csrf
                <div class="relative group/tooltip inline-block">
                    <button type="submit"
                        class="bg-[#FFB3B3] border-4 border-black shadow-[4px_4px_0_#000] hover:-translate-y-1 active:translate-y-1 active:shadow-[2px_2px_0_#000] transition-all px-6 py-3.5 rounded-2xl font-black text-black text-sm flex items-center gap-2 cursor-pointer uppercase tracking-wider">
                        Keluar Akun
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            class="w-5 h-5 text-black fill-none stroke-current" stroke-width="3"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                    </button>
                    <div class="pointer-events-none absolute top-full left-1/2 -translate-x-1/2 mt-3 bg-[#FFD1E3] border-2 border-black shadow-[2px_2px_0_#000] px-3 py-1.5 rounded-lg text-sm font-bold opacity-0 scale-95 group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-150 whitespace-nowrap z-50 text-black">
                        Keluar dari Sesi
                    </div>
                </div>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach ($mapels as $index => $mapel)
                @php
                    // Variasi warna brutalist agar dinamis
                    $bgColors = ['#FFF5B8', '#BEE9E8', '#D4F1BE'];
                    $bg = $bgColors[$index % 3];
                @endphp
                <div class="p-8 border-4 border-black rounded-[2.5rem] flex flex-col justify-between hover:-translate-y-2 transition-transform duration-300 shadow-[8px_8px_0_#000]" 
                     style="background-color: {{ $bg }}">
                    <div>
                        <div class="w-16 h-16 bg-white border-4 border-black rounded-2xl flex items-center justify-center text-3xl mb-6 shadow-[4px_4px_0_#000]">
                            📚
                        </div>
                        <h2 class="text-2xl font-black text-black uppercase mb-3">{{ $mapel->nama }}</h2>
                        <p class="font-bold text-slate-700 text-sm leading-relaxed mb-6">
                            {{ $mapel->deskripsi ?? 'Kelola seluruh pembelajaran, video peragaan, kuis interaktif, dan canvas mewarnai untuk kelas ini.' }}
                        </p>
                    </div>

                    <a href="{{ route('teacher.materi.index', ['mapel_slug' => $mapel->slug]) }}" 
                       class="w-full text-center bg-white p-4 rounded-xl border-4 border-black font-black text-black uppercase tracking-wider hover:bg-slate-50 transition-colors block shadow-[4px_4px_0_#000]">
                        Pilih Mapel →
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</x-admin-layout>