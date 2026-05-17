<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HonuSign - Belajar SIBI Interaktif</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Fredoka', sans-serif;
            background-color: #FFFEFA;
        }

        .brutal-border {
            border: 3px solid #000000;
        }

        .brutal-shadow {
            box-shadow: 6px 6px 0px 0px #000000;
        }

        .brutal-shadow-sm {
            box-shadow: 3px 3px 0px 0px #000000;
        }

        .brutal-hover:hover {
            transform: translate(-3px, -3px);
            box-shadow: 9px 9px 0px 0px #000000;
        }

        .brutal-hover:active {
            transform: translate(2px, 2px);
            box-shadow: 2px 2px 0px 0px #000000;
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
</head>

<body class="antialiased text-slate-900">

    <!-- Navbar -->
    <nav class="fixed w-full z-50 bg-[#FFFEFA] brutal-border border-t-0 border-l-0 border-r-0">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <div class="text-3xl font-bold tracking-tight">
                Honu<span class="text-[#FFD1E3] text-outline">Sign</span>
            </div>
            <div class="hidden md:flex gap-8 font-bold text-lg">
                <a href="#beranda"
                    class="hover:text-pink-500 hover:underline decoration-2 underline-offset-4 transition-all">Beranda</a>
                <a href="#fitur"
                    class="hover:text-blue-500 hover:underline decoration-2 underline-offset-4 transition-all">Fitur</a>
                <a href="#tentang"
                    class="hover:text-green-500 hover:underline decoration-2 underline-offset-4 transition-all">Tentang
                    Kami</a>
            </div>
            <div class="flex items-center gap-4 font-bold">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="px-6 py-2 bg-[#D4F1BE] brutal-border brutal-shadow-sm brutal-hover rounded-xl transition-all">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}"
                            class="px-6 py-2 bg-[#FFF5B8] brutal-border brutal-shadow-sm brutal-hover rounded-xl transition-all">Masuk</a>
                        <!-- @if (Route::has('register'))
                                    <a href="{{ route('register') }}"
                                        class="px-6 py-2 bg-[#BEE9E8] brutal-border brutal-shadow-sm brutal-hover rounded-xl transition-all hidden sm:inline-block">Daftar</a>
                                @endif -->
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="beranda" class="pt-32 pb-20 md:pt-48 md:pb-32 px-6">
        <div class="max-w-7xl mx-auto grid gap-12 items-center lg:grid-cols-[1fr_1fr]">
            <div class="max-w-2xl">
                <div
                    class="inline-flex px-4 py-2 mb-6 text-sm font-bold bg-[#E0BBE4] brutal-border brutal-shadow-sm rounded-xl">
                    LIDM 2026 - Universitas Riau
                </div>
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold leading-tight mb-8">
                    Belajar dengan <span
                        class="inline-block bg-[#FFF5B8] brutal-border brutal-shadow-sm px-4 py-1 rounded-2xl transform -rotate-2">Mudah</span>
                    & <span
                        class="inline-block bg-[#FFD1E3] brutal-border brutal-shadow-sm px-4 py-1 rounded-2xl transform rotate-2 mt-2 lg:mt-0">Seru!</span>
                </h1>
                <p class="text-xl md:text-2xl font-medium mb-10 leading-relaxed">
                    HonuSign hadir untuk anak-anak dan keluarga yang ingin anak spesialnya belajar dengan cara
                    menyenangkan dan interaktif.
                </p>
                <div class="flex flex-col sm:flex-row gap-6">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="inline-flex items-center justify-center px-10 py-4 bg-[#D4F1BE] font-bold text-xl brutal-border brutal-shadow brutal-hover rounded-2xl transition-all text-center">
                            Lanjut Belajar
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="inline-flex items-center justify-center px-10 py-4 bg-[#BEE9E8] font-bold text-xl brutal-border brutal-shadow brutal-hover rounded-2xl transition-all text-center">
                            Mulai Belajar
                        </a>
                        <!-- @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="inline-flex items-center justify-center px-10 py-4 bg-[#FFFEFA] font-bold text-xl brutal-border brutal-shadow brutal-hover rounded-2xl transition-all text-center">
                                    Daftar Gratis
                                </a>
                            @endif -->
                    @endauth
                </div>
            </div>

            <div class="relative flex justify-center">
                <img src="{{ asset('images/page/hero.png') }}" alt="HonuSign Hero" class="w-full max-w-lg"
                    onerror="this.src='https://via.placeholder.com/600x600?text=Hero+Image'" />
            </div>
        </div>
    </section>

    <!-- Fitur Section (Bento Grid) -->
    <section id="fitur" class="py-24 bg-[#BEE9E8] px-6 brutal-border border-l-0 border-r-0">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2
                    class="text-4xl md:text-5xl font-bold mb-6 bg-[#FFFEFA] inline-block px-8 py-3 brutal-border brutal-shadow rounded-3xl transform -rotate-1">
                    Kenapa HonuSign?</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="bg-[#FFFEFA] p-8 rounded-3xl brutal-border brutal-shadow brutal-hover transition-all">
                    <div
                        class="w-16 h-16 bg-[#FFF5B8] rounded-2xl flex items-center justify-center text-3xl mb-6 brutal-border brutal-shadow-sm">
                        📚
                    </div>
                    <h3 class="text-2xl font-bold mb-3">Materi Terstruktur</h3>
                    <p class="font-medium text-lg leading-relaxed">Dari teori dasar hingga perbendaharaan kata visual.
                        Mudah dipahami pemula.</p>
                </div>

                <!-- Card 2 -->
                <div
                    class="bg-[#FFFEFA] p-8 rounded-3xl brutal-border brutal-shadow brutal-hover transition-all lg:col-span-2">
                    <div
                        class="w-16 h-16 bg-[#FFD1E3] rounded-2xl flex items-center justify-center text-3xl mb-6 brutal-border brutal-shadow-sm">
                        🎮
                    </div>
                    <h3 class="text-2xl font-bold mb-3">Kuis & Gamifikasi</h3>
                    <p class="font-medium text-lg leading-relaxed">Kumpulkan poin dengan menjawab kuis menebak isyarat.
                        Belajar serasa bermain game yang seru dan menantang!</p>
                </div>

                <!-- Card 3 -->
                <div class="bg-[#FFFEFA] p-8 rounded-3xl brutal-border brutal-shadow brutal-hover transition-all">
                    <div
                        class="w-16 h-16 bg-[#D4F1BE] rounded-2xl flex items-center justify-center text-3xl mb-6 brutal-border brutal-shadow-sm">
                        📸
                    </div>
                    <h3 class="text-2xl font-bold mb-3">Deteksi AI Kamera</h3>
                    <p class="font-medium text-lg leading-relaxed">Praktikkan gerakan bahasamu langsung dikoreksi oleh
                        AI cerdas kami.</p>
                </div>

                <!-- Card 4 -->
                <div class="bg-[#FFFEFA] p-8 rounded-3xl brutal-border brutal-shadow brutal-hover transition-all">
                    <div
                        class="w-16 h-16 bg-[#E0BBE4] rounded-2xl flex items-center justify-center text-3xl mb-6 brutal-border brutal-shadow-sm">
                        📈
                    </div>
                    <h3 class="text-2xl font-bold mb-3">Pantau Progres</h3>
                    <p class="font-medium text-lg leading-relaxed">Sistem otomatis menyimpan nilai dan progres
                        belajarmu.</p>
                </div>

                <!-- Card 5 -->
                <div
                    class="bg-[#FFFEFA] p-8 rounded-3xl brutal-border brutal-shadow brutal-hover transition-all lg:col-span-1">
                    <div
                        class="w-16 h-16 bg-[#BEE9E8] rounded-2xl flex items-center justify-center text-3xl mb-6 brutal-border brutal-shadow-sm">
                        🤝
                    </div>
                    <h3 class="text-2xl font-bold mb-3">Komunitas Inklusif</h3>
                    <p class="font-medium text-lg leading-relaxed">Bangun kesetaraan komunikasi bersama HonuSign.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Tentang Kami Section -->
    <section id="tentang" class="py-32 px-6 overflow-hidden bg-[#FFFEFA]">
        <div class="max-w-7xl mx-auto flex flex-col lg:flex-row items-center gap-16">
            <div class="flex-1 w-full">
                <div
                    class="w-full bg-[#FFD1E3] brutal-border brutal-shadow rounded-[3rem] p-8 relative flex items-center justify-center aspect-video lg:aspect-square">
                    <div class="bg-[#FFFEFA] brutal-border brutal-shadow-sm rounded-2xl p-6 text-center">
                        <img src="{{ asset('images/logo.png') }}" alt="HonuSign logo"
                            onerror="this.src='https://via.placeholder.com/600x600?text=About+Us'" />
                    </div>
                </div>
            </div>
            <div class="flex-1">
                <span
                    class="inline-block px-4 py-2 bg-[#FFF5B8] brutal-border brutal-shadow-sm font-bold rounded-xl mb-6 transform rotate-2">Tentang
                    Kami</span>
                <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-8 leading-tight">
                    Membangun Komunikasi Tanpa Batas
                </h2>
                <p class="text-xl font-medium mb-10 leading-relaxed">
                    HonuSign berdedikasi untuk menciptakan lingkungan belajar yang ramah bagi anak tunarungu. Melalui
                    pendekatan visual interaktif, kami berharap dapat menjembatani komunikasi yang lebih baik di
                    masyarakat.
                </p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-[#BEE9E8] py-16 px-6 brutal-border border-b-0 border-l-0 border-r-0">
        <div
            class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-8 text-center md:text-left">
            <div class="text-4xl font-bold tracking-tighter">
                Honu<span class="text-[#FFD1E3] text-outline">Sign</span>
            </div>
            <!-- <div class="flex flex-wrap justify-center gap-6 font-bold text-lg">
                <a href="#" class="hover:text-pink-600 transition-colors">Instagram</a>
                <a href="#" class="hover:text-blue-600 transition-colors">GitHub</a>
                <a href="#" class="hover:text-green-600 transition-colors">Email</a>
            </div> -->
            <p class="font-bold text-lg">
                &copy; {{ date('Y') }} HonuSign.
            </p>
        </div>
    </footer>

</body>

</html>