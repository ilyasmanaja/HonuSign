<x-student-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Fredoka:wght@400;600;700;900&display=swap');

        .font-fredoka {
            font-family: 'Fredoka', sans-serif;
        }
    </style>

    <div class="py-12 w-full flex flex-col items-center justify-center font-fredoka">
        <div class="text-center mb-12">
            <h1 class="text-5xl md:text-6xl font-black text-sky-600 tracking-tight drop-shadow-sm mb-4">Koleksi Fun &
                Play 🎮</h1>
            <p class="text-slate-500 mt-2 text-xl font-medium">Pilih permainan seru yang ingin kamu mainkan hari ini!
            </p>
        </div>

        <div class="max-w-6xl w-full px-6 grid grid-cols-1 md:grid-cols-3 gap-8">

            <!-- Card 1: Riau Discovery -->
            <a href="{{ route('general.puzzle') }}"
                class="group bg-gradient-to-b from-sky-300 to-sky-400 p-8 rounded-[3rem] shadow-[0_15px_30px_rgba(14,165,233,0.3)] border-b-8 border-sky-500 transform md:hover:-translate-y-3 transition-transform duration-300 relative overflow-hidden flex flex-col items-center text-center active:scale-[0.98]">

                <!-- Dekorasi Latar -->
                <div class="absolute -top-6 -right-6 w-32 h-32 bg-white/20 rounded-full blur-xl"></div>
                <div class="absolute bottom-10 -left-6 w-24 h-24 bg-white/20 rounded-full blur-xl"></div>

                <div
                    class="w-24 h-24 bg-white rounded-full flex items-center justify-center text-sky-500 mb-6 shadow-[inset_0_4px_6px_rgba(0,0,0,0.1)] md:group-hover:scale-110 transition-transform duration-300 relative z-10 border-4 border-sky-100">
                    <span class="text-6xl">🗺️</span>
                </div>

                <h3 class="text-3xl font-black text-white mb-3 drop-shadow-md tracking-wide relative z-10">Riau
                    Discovery</h3>

                <p class="text-sky-50 text-lg leading-relaxed mb-8 font-medium relative z-10">Susun kepingan peta dan
                    kenali nama-nama kabupaten di Riau!</p>

                <div
                    class="mt-auto w-full bg-orange-500 text-white text-xl py-4 rounded-full font-black uppercase tracking-widest shadow-[0_6px_0_#c2410c] border-4 border-white relative z-10 transition-all duration-150 md:group-hover:bg-orange-400 md:group-hover:translate-y-[2px] md:group-hover:shadow-[0_4px_0_#c2410c] group-active:translate-y-[6px] group-active:shadow-none group-active:bg-orange-600">
                    Mainkan
                </div>
            </a>

            <!-- Card 2: Permainan 2 (Coming Soon) -->
            <div
                class="bg-slate-200 p-8 rounded-[3rem] border-b-8 border-slate-300 relative overflow-hidden flex flex-col items-center text-center opacity-90">
                <div
                    class="absolute inset-0 z-10 flex flex-col items-center justify-center bg-slate-800/40 backdrop-blur-[4px] rounded-[3rem]">
                    <span class="text-7xl mb-4 drop-shadow-lg">🔒</span>
                    <span
                        class="bg-slate-800 text-white px-6 py-2 rounded-full font-bold tracking-widest text-sm border-2 border-slate-600 shadow-md">SEGERA
                        HADIR</span>
                </div>
                <div
                    class="w-24 h-24 bg-white rounded-full flex items-center justify-center text-slate-400 mb-6 shadow-inner border-4 border-slate-100">
                    <span class="text-6xl">🧩</span>
                </div>
                <h3 class="text-2xl font-black text-slate-500 mb-3 tracking-wide">Tebak Kata SIBI</h3>
                <p class="text-slate-500 text-lg leading-relaxed font-medium">Cocokkan isyarat tangan dengan kata yang
                    tepat.</p>
            </div>

            <!-- Card 3: Permainan 3 (Coming Soon) -->
            <div
                class="bg-slate-200 p-8 rounded-[3rem] border-b-8 border-slate-300 relative overflow-hidden flex flex-col items-center text-center opacity-90">
                <div
                    class="absolute inset-0 z-10 flex flex-col items-center justify-center bg-slate-800/40 backdrop-blur-[4px] rounded-[3rem]">
                    <span class="text-7xl mb-4 drop-shadow-lg">🔒</span>
                    <span
                        class="bg-slate-800 text-white px-6 py-2 rounded-full font-bold tracking-widest text-sm border-2 border-slate-600 shadow-md">SEGERA
                        HADIR</span>
                </div>
                <div
                    class="w-24 h-24 bg-white rounded-full flex items-center justify-center text-slate-400 mb-6 shadow-inner border-4 border-slate-100">
                    <span class="text-6xl">🎯</span>
                </div>
                <h3 class="text-2xl font-black text-slate-500 mb-3 tracking-wide">Memori Visual</h3>
                <p class="text-slate-500 text-lg leading-relaxed font-medium">Latih ingatanmu dengan mencocokkan kartu
                    bergambar.</p>
            </div>

        </div>

        <div class="mt-16">
            <a href="{{ route('dashboard') }}"
                class="bg-white text-slate-500 px-8 py-3 rounded-full font-bold border-2 border-slate-200 shadow-sm hover:text-sky-600 hover:border-sky-300 transition-colors uppercase tracking-widest">
                ⬅ Kembali ke Beranda
            </a>
        </div>
    </div>
</x-student-layout>