<x-student-layout>
    <div class="py-12 w-full flex flex-col items-center justify-center">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-black text-white uppercase tracking-tight">Mode Belajar</h1>
            <p class="text-slate-400 mt-2 text-lg">Pilih metode belajar SIBI kamu</p>
        </div>

        <div class="max-w-6xl w-full px-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <a href="{{ route('materi.membaca') }}" class="group bg-white border-4 border-yellow-400 p-8 rounded-4xl active:shadow-none active:translate-y-2 transition-all text-center">
                <span class="text-6xl block mb-4 group-hover:scale-110 transition-transform">📖</span>
                <span class="text-xl font-black text-slate-800 uppercase">Membaca</span>
            </a>

            <a href="{{ route('materi.quiz') }}" class="group bg-white border-4 border-pink-500 p-8 rounded-4xl active:shadow-none active:translate-y-2 transition-all text-center">
                <span class="text-6xl block mb-4 group-hover:scale-110 transition-transform">📝</span>
                <span class="text-xl font-black text-slate-800 uppercase">Quiz</span>
            </a>

            <a href="{{ route('materi.puzzle') }}" class="group bg-white border-4 border-orange-500 p-8 rounded-4xl active:shadow-none active:translate-y-2 transition-all text-center">
                <span class="text-6xl block mb-4 group-hover:scale-110 transition-transform">🧩</span>
                <span class="text-xl font-black text-slate-800 uppercase">Puzzle</span>
            </a>

            <button class="bg-slate-800 border-4 border-dashed border-slate-700 p-8 rounded-4xl opacity-50 cursor-not-allowed text-center">
                <span class="text-6xl block mb-4">🎬</span>
                <span class="text-xl font-black text-slate-500 uppercase tracking-tighter">Video</span>
            </button>
        </div>

        <a href="{{ route('dashboard') }}" class="mt-16 text-slate-500 hover:text-white font-bold transition-colors uppercase text-sm tracking-widest">
            ← Kembali ke Dashboard
        </a>
    </div>
</x-student-layout>