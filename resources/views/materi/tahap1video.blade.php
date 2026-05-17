<x-student-layout>

    <!-- Main Container Wrapper -->
    <div class="max-w-5xl mx-auto w-full px-4 py-8 md:py-12 flex flex-col items-center">

        <!-- Progress Bar & Navigasi -->
        <div class="w-full mb-10">
            <!-- Header Kembali -->
            <div class="w-full mb-8 flex justify-start">
                <a href="{{ route('materi.belajar', ['step' => 1]) }}"
                    class="bg-[#FFF5B8] brutal-border brutal-shadow-sm brutal-hover px-6 py-4 rounded-3xl font-black text-black text-xl flex items-center gap-3 z-10 transform hover:-translate-y-1 transition-transform">
                    <span class="text-3xl">⬅️</span> Kembali ke Cerita
                </a>
            </div>

            <!-- Progress Bar -->
            <div class="w-full max-w-3xl mx-auto">
                <div class="flex flex-col md:flex-row justify-between mb-4 items-start md:items-end gap-3">
                    <span class="font-black text-xl md:text-2xl tracking-widest uppercase text-black">Video Peragaan
                        SIBI</span>
                    <span
                        class="text-sm md:text-lg font-black text-black bg-[#FFD1E3] brutal-border px-4 py-2 rounded-2xl transform md:rotate-2 shadow-[2px_2px_0_#000]">
                        Misi 1 dari 6
                    </span>
                </div>
                <div class="w-full h-8 bg-white brutal-border brutal-shadow-sm rounded-2xl overflow-hidden p-1">
                    <div class="h-full bg-[#BEE9E8] rounded-xl transition-all duration-1000 border-r-4 border-black"
                        style="width: 16.6%"></div>
                </div>
            </div>
        </div>

        <!-- Header Judul Materi -->
        <div class="text-center mb-10">
            <h1
                class="text-4xl md:text-6xl font-black text-[#FFF5B8] text-outline uppercase tracking-tighter transform -rotate-1 drop-shadow-[0_6px_0_#000]">
                {{ $materi->judul }}
            </h1>
        </div>

        <!-- Player Video -->
        <div
            class="w-full max-w-4xl bg-[#BEE9E8] brutal-border brutal-shadow rounded-[3rem] overflow-hidden flex flex-col relative">
            <!-- Mac window style top bar -->
            <div class="bg-white border-b-4 border-black px-6 py-4 flex items-center gap-3">
                <span class="w-4 h-4 md:w-5 md:h-5 rounded-full bg-[#FF6B6B] border-2 border-black"></span>
                <span class="w-4 h-4 md:w-5 md:h-5 rounded-full bg-[#FFF5B8] border-2 border-black"></span>
                <span class="w-4 h-4 md:w-5 md:h-5 rounded-full bg-[#D4F1BE] border-2 border-black"></span>
                <span class="ml-3 font-black text-sm md:text-base uppercase tracking-widest text-slate-700">Pemutar
                    Video SIBI</span>
            </div>

            <div class="flex-grow flex flex-col items-center justify-center p-6 md:p-10 bg-[#FFFEFA] relative">

                <!-- Video/Image Placeholder -->
                <div
                    class="w-full bg-white brutal-border brutal-shadow-sm rounded-3xl p-4 mb-8 flex justify-center hover:scale-[1.02] transition-transform duration-300 cursor-pointer">
                    <img src="{{ asset('images/' . $materi->video_peragaan) }}" alt="Peragaan {{ $materi->judul }}"
                        class="w-full max-w-2xl h-auto object-contain rounded-2xl brutal-border">
                </div>

                <!-- Kontrol Video Khusus Tunarungu -->
                <div class="flex flex-col md:flex-row justify-center gap-4 md:gap-8 w-full max-w-2xl">
                    <button type="button"
                        class="flex-1 bg-[#FFF5B8] brutal-border brutal-shadow-sm brutal-hover px-6 py-5 rounded-2xl font-black text-lg uppercase flex items-center justify-center gap-4">
                        <span class="text-3xl">🐌</span> Lambat 0.5x
                    </button>
                    <button type="button"
                        class="flex-1 bg-[#FFD1E3] brutal-border brutal-shadow-sm brutal-hover px-6 py-5 rounded-2xl font-black text-lg uppercase flex items-center justify-center gap-4">
                        <span class="text-3xl">⏪</span> Ulangi 5s
                    </button>
                </div>

            </div>
        </div>

    </div>

</x-student-layout>