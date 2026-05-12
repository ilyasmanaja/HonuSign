<x-student-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Fredoka:wght@400;500;600;700&display=swap');

        body {
            font-family: 'Fredoka', sans-serif !important;
            background-color: #FFFEFA !important;
            /* Putih Gading */
        }

        .brutal-border {
            border: 3px solid #000000 !important;
        }

        .brutal-shadow {
            box-shadow: 6px 6px 0px 0px #000000 !important;
        }

        .brutal-shadow-sm {
            box-shadow: 3px 3px 0px 0px #000000 !important;
        }

        .brutal-hover {
            transition: all 0.2s ease-in-out !important;
        }

        .brutal-hover:hover {
            transform: translate(-3px, -3px) !important;
            box-shadow: 9px 9px 0px 0px #000000 !important;
        }

        .brutal-hover:active {
            transform: translate(2px, 2px) !important;
            box-shadow: 2px 2px 0px 0px #000000 !important;
        }

        .text-outline {
            text-shadow:
                -1px -1px 0 #000,
                1px -1px 0 #000,
                -1px 1px 0 #000,
                1px 1px 0 #000,
                2px 2px 0 #000;
        }
    </style>

    <div class="py-12 w-full flex flex-col items-center justify-center font-['Fredoka']">
        <div class="text-center mb-16 pt-8 md:pt-0">
            <h1 class="text-4xl md:text-5xl font-bold text-black tracking-tighter mb-6 leading-tight">
                Koleksi <span class="text-[#FFD1E3] text-outline">Fun & Play 🎮</span>
            </h1>
            <p class="text-xl font-medium text-slate-700 mt-6 px-4">Pilih permainan seru yang ingin kamu mainkan hari
                ini!</p>
        </div>

        <div class="max-w-6xl w-full px-6 grid grid-cols-1 md:grid-cols-3 gap-8">

            <!-- Card 1: Riau Discovery -->
            <a href="{{ route('general.puzzle') }}"
                class="brutal-hover block bg-[#BEE9E8] brutal-border brutal-shadow rounded-[2.5rem] overflow-hidden group flex flex-col h-full">

                <!-- Bagian Gambar (Mengikuti efek Fun & Play: Zoom saat hover) -->
                <div class="h-56 overflow-hidden bg-[#FFFEFA] brutal-border border-t-0 border-l-0 border-r-0 relative">
                    <img src="{{ asset('images/page/puzzle page.png') }}" alt="Riau Discovery"
                        class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110"
                        onerror="this.src='https://via.placeholder.com/400x300?text=Peta+Riau+Discovery'" />

                    <!-- Badge Kecil -->
                    <div
                        class="absolute text-black bottom-4 right-4 bg-[#FFFEFA] brutal-border brutal-shadow-sm px-3 py-1 rounded-xl font-bold text-sm">
                        🧩 Riau Discovery
                    </div>
                </div>

                <!-- Bagian Tombol  -->
                <div class="p-6">
                    <div
                        class="w-full bg-[#FFF5B8] text-black text-xl py-4 rounded-2xl font-bold uppercase tracking-widest brutal-border brutal-shadow-sm transition-all duration-150 text-center group-hover:bg-white">
                        Mainkan
                    </div>
                </div>
            </a>

            <!-- Card 2: Harmoni Alat Musik (Sliding Puzzle) -->
            <a href="{{ route('general.puzzle_instrument') }}"
                class="brutal-hover block bg-[#E0BBE4] brutal-border brutal-shadow rounded-[2.5rem] overflow-hidden group flex flex-col h-full">

                <!-- Bagian Gambar (Menggunakan foto Alat Musik Riau dengan efek Zoom) -->
                <div class="h-56 overflow-hidden bg-[#FFFEFA] brutal-border border-t-0 border-l-0 border-r-0 relative">
                    <img src="{{ asset('images/page/sliding page.png') }}" alt="Harmoni Riau"
                        class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110"
                        onerror="this.src='https://via.placeholder.com/400x300?text=Alat+Musik+Tradisional+Riau'" />

                    <div
                        class="absolute text-black bottom-4 right-4 bg-[#FFFEFA] brutal-border brutal-shadow-sm px-3 py-1 rounded-xl font-bold text-sm">
                        🎹 Harmoni Riau
                    </div>
                </div>

                <div class="p-8 flex flex-col flex-grow text-center items-center">
                    <div
                        class="mt-auto w-full bg-[#FFF5B8] text-black text-xl py-4 rounded-2xl font-bold uppercase tracking-widest brutal-border brutal-shadow-sm group-hover:bg-white transition-all duration-150 text-center">
                        Mainkan
                    </div>
                </div>
            </a>

            <a href="{{ route('general.memory') }}"
                class="brutal-hover block bg-[#FFF5B8] brutal-border brutal-shadow rounded-[2.5rem] overflow-hidden group flex flex-col h-full">

                <!-- Bagian Gambar (Mengikuti gaya Fun & Play: Zoom saat hover) -->
                <div class="h-56 overflow-hidden bg-[#FFFEFA] brutal-border border-t-0 border-l-0 border-r-0 relative">
                    <img src="{{ asset('images/page/memory page.png') }}" alt="Memori Visual"
                        class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110"
                        onerror="this.src='https://via.placeholder.com/400x300?text=Memori+Visual+SIBI'" />

                    <!-- Badge Indikator Game -->
                    <div
                        class="absolute text-black bottom-4 right-4 bg-[#FFFEFA] brutal-border brutal-shadow-sm px-3 py-1 rounded-xl font-bold text-sm">
                        🎯 Memori Visual
                    </div>
                </div>

                <div class="p-8 flex flex-col flex-grow text-center items-center">
                    <div
                        class="mt-auto w-full bg-[#BEE9E8] text-black text-xl py-4 rounded-2xl font-bold uppercase tracking-widest brutal-border brutal-shadow-sm group-hover:bg-white transition-all duration-150 text-center">
                        Mainkan
                    </div>
                </div>
            </a>

        </div>

        <div class="mt-16">
            <a href="{{ route('dashboard') }}"
                class="bg-[#FFFEFA] text-black px-8 py-3 rounded-2xl font-bold brutal-border brutal-shadow-sm brutal-hover transition-colors uppercase tracking-widest inline-block">
                ⬅ Kembali ke Beranda
            </a>
        </div>
    </div>
</x-student-layout>