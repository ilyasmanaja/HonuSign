<x-student-layout>
    <div class="text-center max-w-4xl px-6">
        <span class="inline-block px-4 py-1.5 mb-6 text-sm font-bold tracking-widest text-blue-400 uppercase bg-blue-400/10 rounded-full border border-blue-400/20">
            LIDM 2026 - Universitas Riau
        </span>

        <h1 class="text-6xl md:text-7xl font-black text-teal-400 leading-none tracking-tighter mb-6">
            HONU<span class="text-blue-400">SIGN.</span>
        </h1>
        
        <p class="text-xl text-slate-400 mb-10 leading-relaxed max-w-2xl mx-auto font-medium">
            Platform belajar bahasa isyarat SIBI yang interaktif untuk teman-teman tuna rungu. Belajar lebih mudah, kapan saja, di mana saja.
        </p>

        <div class="flex flex-col md:flex-row items-center justify-center gap-6">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="w-full md:w-auto px-10 py-5 bg-blue-600 hover:bg-blue-500 text-white font-black text-xl rounded-3xl shadow-[0_10px_0_0_#2563eb] active:shadow-none active:translate-y-2 transition-all uppercase tracking-wider">
                        Masuk Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="w-full md:w-auto px-10 py-5 border-4 border-teal-400 bg-teal-400 hover:bg-teal-50 text-teal-50 hover:text-teal-400 hover:border-4 font-black text-xl rounded-3xl active:shadow-none active:translate-y-2 transition-all uppercase tracking-wider text-center">
                        Mulai Belajar
                    </a>
                    
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="w-full md:w-auto px-10 py-5 border-4 border-blue-400 bg-blue-400 hover:bg-teal-50 text-teal-50 hover:text-teal-400 hover:border-4 font-black text-xl rounded-3xl active:shadow-none active:translate-y-2 transition-all uppercase tracking-wider text-center">
                            Daftar Akun
                        </a>
                    @endif
                @endauth
            @endif
        </div>

        <p class="mt-20 text-slate-600 font-bold uppercase text-xs tracking-[0.3em]">
            Developed with ❤️ in Pekanbaru
        </p>
    </div>
</x-student-layout>