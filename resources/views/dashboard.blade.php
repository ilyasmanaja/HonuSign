<x-student-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Fredoka:wght@400;500;600;700&display=swap');

        /* Font and Background for the entire page */
        body {
            font-family: 'Fredoka', sans-serif !important;
            background-color: #FFFEFA !important;
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

    <!-- Tombol Keluar Kiri Atas -->
    <div class="fixed top-6 left-6 z-[60]">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="bg-[#FF6B6B] text-black brutal-border brutal-shadow-sm brutal-hover px-5 py-2 rounded-xl font-bold uppercase tracking-tight text-sm flex items-center gap-2 group transition-colors hover:bg-white hover:text-black">
                Keluar
            </button>
        </form>
    </div>

    <div class="py-12 w-full flex flex-col items-center justify-center font-['Fredoka']">
        <div class="text-center mb-16 pt-8 md:pt-0">
            <h1 class="text-4xl md:text-5xl font-bold text-black tracking-tighter mb-6 leading-tight">
                Halo, {{ auth()->user()->name }}! <br />
                <span
                    class="inline-block bg-[#FFF5B8] brutal-border brutal-shadow-sm px-6 py-2 mt-4 rounded-3xl transform -rotate-2 text-black">
                    Selamat Belajar 👋
                </span>
            </h1>
            <p class="text-xl font-medium text-slate-700 mt-6 px-4">Pilih menu di bawah untuk mulai latihan hari ini</p>
        </div>

        <div class="max-w-6xl w-full px-6 grid grid-cols-1 md:grid-cols-3 gap-8">

            <!-- Fun & Play -->
            <a href="{{ route('general.index') }}"
                class="brutal-hover block bg-[#FFD1E3] brutal-border brutal-shadow rounded-[2.5rem] overflow-hidden group">
                <div class="h-56 overflow-hidden bg-[#FFFEFA] brutal-border border-t-0 border-l-0 border-r-0 relative">
                    <img src="{{ asset('images/page/fun&play.png') }}" alt="Fun & Play"
                        class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110"
                        onerror="this.src='https://via.placeholder.com/400x300?text=Fun+%26+Play'" />
                </div>
                <div class="p-8 text-center">
                    <span class="text-3xl font-bold text-black uppercase tracking-tighter">Fun & Play</span>
                </div>
            </a>

            <!-- Study -->
            <a href="{{ route('materi.index') }}"
                class="brutal-hover block bg-[#D4F1BE] brutal-border brutal-shadow rounded-[2.5rem] overflow-hidden group transform md:-translate-y-4">
                <div class="h-56 overflow-hidden bg-[#FFFEFA] brutal-border border-t-0 border-l-0 border-r-0 relative">
                    <img src="{{ asset('images/page/studies.png') }}" alt="Study"
                        class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110"
                        onerror="this.src='https://via.placeholder.com/400x300?text=Study'" />
                </div>
                <div class="p-8 text-center">
                    <span class="text-3xl font-bold text-black uppercase tracking-tighter">Study</span>
                </div>
            </a>

            <!-- Evaluasi -->
            <button type="button"
                class="brutal-hover w-full block bg-[#E0BBE4] brutal-border brutal-shadow rounded-[2.5rem] overflow-hidden group text-left">
                <div class="h-56 overflow-hidden bg-[#FFFEFA] brutal-border border-t-0 border-l-0 border-r-0 relative">
                    <img src="{{ asset('images/page/evaluasi.png') }}" alt="Evaluasi"
                        class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110"
                        onerror="this.src='https://via.placeholder.com/400x300?text=Evaluasi'" />
                </div>
                <div class="p-8 text-center">
                    <span class="text-3xl font-bold text-black uppercase tracking-tighter">Evaluasi</span>
                </div>
            </button>

        </div>
    </div>
</x-student-layout>