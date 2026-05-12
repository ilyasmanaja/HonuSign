<x-student-layout>
    <div class="py-12 w-full flex flex-col items-center justify-center">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-black text-slate-700 tracking-tight">Halo, Han! Selamat Belajar SIBI 👋</h1>
            <p class="text-slate-600 mt-2 text-lg font-medium">Pilih menu untuk mulai latihan hari ini</p>
        </div>

        <div class="max-w-6xl w-full px-6 grid grid-cols-1 md:grid-cols-3 gap-8">

            <a href="{{ route('general.index') }}"
                class="group block bg-white border-4 border-blue-500 rounded-[2.5rem] overflow-hidden shadow-lg transition-transform duration-200 hover:-translate-y-1 active:shadow-none">
                <div class="h-56 overflow-hidden bg-slate-100">
                    <img src="{{ asset('images/page/fun&play.png') }}" alt="Fun & Play"
                        class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105" />
                </div>
                <div class="p-8 text-center">
                    <span class="text-2xl font-black text-slate-600 uppercase tracking-tighter">Fun & Play</span>
                </div>
            </a>

            <a href="{{ route('materi.index') }}"
                class="group block bg-white border-4 border-green-500 rounded-[2.5rem] overflow-hidden shadow-lg transition-transform duration-200 hover:-translate-y-1 active:shadow-none">
                <div class="h-56 overflow-hidden bg-slate-100">
                    <img src="{{ asset('images/page/studies.png') }}" alt="Study"
                        class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105" />
                </div>
                <div class="p-8 text-center">
                    <span class="text-2xl font-black text-slate-800 uppercase tracking-tighter">Study</span>
                </div>
            </a>

            <button type="button"
                class="group w-full bg-white border-4 border-purple-500 rounded-[2.5rem] overflow-hidden shadow-lg transition-transform duration-200 hover:-translate-y-1 active:shadow-none">
                <div class="h-56 overflow-hidden bg-slate-100">
                    <img src="{{ asset('images/page/evaluasi.png') }}" alt="Evaluasi"
                        class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105" />
                </div>
                <div class="p-8 text-center">
                    <span class="text-2xl font-black text-slate-600 uppercase tracking-tighter">Evaluasi</span>
                </div>
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