<x-student-layout>
    <div class="py-12 w-full flex flex-col items-center justify-center">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-black text-slate-700 tracking-tight">Halo, Han! Selamat Belajar SIBI 👋</h1>
            <p class="text-slate-600 mt-2 text-lg font-medium">Pilih menu untuk mulai latihan hari ini</p>
        </div>

        <div class="max-w-6xl w-full px-6 grid grid-cols-1 md:grid-cols-3 gap-8">

            <a href="{{ route('general.index') }}"
                class="group flex flex-col items-center justify-center bg-white border-4 border-blue-500 p-10 rounded-[2.5rem] active:shadow-none active:translate-y-2 transition-all">
                <span class="text-7xl block mb-4 group-hover:scale-110 transition-transform">🎮</span>
                <span class="text-2xl font-black text-slate-600 uppercase tracking-tighter">Fun & Play</span>
            </a>

            <a href="{{ route('materi.index') }}"
                class="group flex flex-col items-center justify-center bg-white border-4 border-green-500 p-10 rounded-[2.5rem] active:shadow-none active:translate-y-2 transition-all">

                <span class="text-7xl block mb-4 group-hover:scale-110 transition-transform">📚</span>
                <span class="text-2xl font-black text-slate-800 uppercase tracking-tighter">Study</span>

            </a>



            <button
                class="group bg-white border-4 border-purple-500 p-10 rounded-[2.5rem] active:shadow-none active:translate-y-2 transition-all">
                <span class="text-7xl block mb-4 group-hover:scale-110 transition-transform">🤟</span>
                <span class="text-2xl font-black text-slate-600 uppercase tracking-tighter">Evaluasi</span>
            </button>

        </div>

        <form method="POST" action="{{ route('logout') }}" class="mt-16">
            @csrf
            <button type="submit"
                class="text-white border-3 border-red-500 p-1 rounded-lg bg-red-500 hover:text-red-500 hover:bg-white font-bold transition-colors uppercase text-sm tracking-widest">
                Keluar Aplikasi
            </button>
        </form>
    </div>
</x-student-layout>