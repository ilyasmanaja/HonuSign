<x-student-layout>
    <div class="max-w-7xl mx-auto w-full px-6 py-12 flex flex-col items-center gap-8 relative">

        <div class="w-full flex justify-start z-10">
            <a href="{{ route('dashboard.mapel', ['mapel_slug' => $mapel->slug]) }}" class="bg-[#FFB3B3] brutal-border brutal-shadow-sm brutal-hover px-6 py-3 rounded-2xl font-black text-black text-sm flex items-center gap-2 uppercase tracking-wider">
                ← Kembali ke Menu
            </a>
        </div>

        <div class="text-center mb-6 z-10">
            <div class="inline-block px-5 py-1.5 bg-[#FFF5B8] brutal-border brutal-shadow-sm rounded-2xl text-sm font-black uppercase tracking-widest mb-4 transform -rotate-2 text-black">
                Latihan Bebas
            </div>
            <h1 class="text-4xl md:text-6xl font-black text-black uppercase tracking-tighter transform -rotate-1 drop-shadow-[0_4px_0_rgba(0,0,0,0.1)]">
                Kamus <span class="text-[#BEE9E8] text-outline drop-shadow-[0_4px_0_#000]">Isyarat</span>
            </h1>
            <p class="text-slate-600 font-bold mt-4 text-lg max-w-2xl mx-auto">Pilih kata yang ingin kamu latih. Kamera AI akan menemanimu belajar mengeja huruf demi huruf!</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 w-full z-10">
            @foreach($daftarKata as $item)
                <a href="{{ route('ai.kamera', ['mapel_slug' => $mapel->slug, 'kata' => $item['kata']]) }}" 
                   class="block brutal-border brutal-shadow brutal-hover rounded-[2.5rem] overflow-hidden group cursor-pointer"
                   style="background-color: {{ $item['color'] }}">
                    
                    <div class="h-32 md:h-40 flex items-center justify-center bg-[#FFFEFA] border-b-4 border-black relative">
                        <span class="text-6xl md:text-7xl group-hover:scale-110 transition-transform duration-300 transform group-hover:rotate-6">
                            {{ $item['emoji'] }}
                        </span>
                        <div class="absolute inset-0 bg-black/5 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <span class="bg-black text-white px-3 py-1.5 rounded-xl font-black text-xs uppercase tracking-wider scale-90 group-hover:scale-100 transition-transform">
                                Mulai Kamera
                            </span>
                        </div>
                    </div>
                    
                    <div class="p-4 md:p-5 text-center">
                        <h3 class="font-black text-black text-xl md:text-2xl uppercase tracking-widest">{{ $item['kata'] }}</h3>
                        <p class="text-xs font-bold text-slate-700 mt-1 opacity-70">{{ strlen($item['kata']) }} Huruf</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</x-student-layout>