<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HonuSign - Belajar SIBI Interaktif</title>
    <meta name="description"
        content="HonuSign adalah platform belajar bahasa isyarat SIBI interaktif untuk anak tunarungu. Belajar mudah, seru, dan menyenangkan!">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * {
            font-family: 'Fredoka', sans-serif;
        }

        body {
            background-color: #FFFEFA;
        }

        /* ── Brutalism Core ── */
        .bb {
            border: 4px solid #000;
        }

        .bs {
            box-shadow: 6px 6px 0 #000;
        }

        .bs-sm {
            box-shadow: 3px 3px 0 #000;
        }

        .bh {
            transition: all 0.15s ease-in-out;
        }

        .bh:hover {
            transform: translate(-3px, -3px);
            box-shadow: 9px 9px 0 #000;
        }

        .bh:active {
            transform: translate(2px, 2px);
            box-shadow: 2px 2px 0 #000;
        }

        /* Text outline */
        .text-stamp {
            text-shadow: -2px -2px 0 #000, 2px -2px 0 #000,
                -2px 2px 0 #000, 2px 2px 0 #000,
                3px 3px 0 #000;
        }

        /* Floating shapes decoration */
        @keyframes float-y {

            0%,
            100% {
                transform: translateY(0) rotate(var(--r, 0deg));
            }

            50% {
                transform: translateY(-14px) rotate(var(--r, 0deg));
            }
        }

        .float {
            animation: float-y 4s ease-in-out infinite;
        }

        /* Navbar underline hover */
        .nav-link {
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 3px;
            background: #000;
            transition: width 0.2s;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        /* Section divider */
        .divider {
            border-top: 4px solid #000;
        }

        /* Card tilt helpers */
        .tilt-l {
            transform: rotate(-1.5deg);
        }

        .tilt-r {
            transform: rotate(1.5deg);
        }

        .tilt-l:hover,
        .tilt-r:hover {
            transform: rotate(0) translate(-3px, -3px);
        }
    </style>
</head>

<body class="antialiased text-black">

    <!-- ══════════════════════════════ NAVBAR ══════════════════════════════ -->
    <nav class="fixed w-full z-50 bg-[#FFFEFA] bb border-t-0 border-l-0 border-r-0">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">

            <!-- Logo -->
            <a href="{{ url('/') }}" class="text-3xl font-bold tracking-tight select-none">
                Honu<span class="text-[#FFD1E3] text-stamp">Sign</span>
            </a>

            <!-- Nav Links (desktop) -->
            <div class="hidden md:flex gap-8 font-bold text-lg">
                <a href="#beranda" class="nav-link hover:text-pink-500 transition-colors">Beranda</a>
                <a href="#fitur" class="nav-link hover:text-blue-500 transition-colors">Fitur</a>
                <a href="#tentang" class="nav-link hover:text-green-500 transition-colors">Tentang Kami</a>
            </div>

            <!-- CTA Buttons -->
            <div class="flex items-center gap-3 font-bold">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="px-6 py-2 bg-[#D4F1BE] bb bs-sm bh rounded-2xl transition-all text-sm">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="px-6 py-2 bg-[#FFF5B8] bb bs-sm bh rounded-2xl transition-all text-sm">
                            Masuk
                        </a>
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- ══════════════════════════════ HERO ══════════════════════════════ -->
    <section id="beranda" class="pt-36 pb-24 md:pt-52 md:pb-36 px-6 relative overflow-hidden">

        <!-- Decorative floating blobs -->
        <div class="pointer-events-none absolute top-24 right-10 w-48 h-48 rounded-full bg-[#FFD1E3] bb opacity-40 float"
            style="--r:-8deg; animation-delay:0s;"></div>
        <div class="pointer-events-none absolute bottom-16 left-6  w-32 h-32 rounded-full bg-[#FFF5B8] bb opacity-50 float"
            style="--r:5deg;  animation-delay:1.5s;"></div>
        <div class="pointer-events-none absolute top-40 left-1/3  w-20 h-20 rounded-full bg-[#BEE9E8] bb opacity-40 float"
            style="--r:12deg; animation-delay:0.8s;"></div>

        <div class="max-w-7xl mx-auto grid gap-12 items-center lg:grid-cols-2">

            <!-- Left: Text -->
            <div>
                <!-- Badge -->
                <div
                    class="inline-flex items-center gap-2 px-4 py-2 mb-8 bg-[#E0BBE4] bb bs-sm rounded-2xl text-sm font-bold tilt-l transition-all">
                    HonuSign — Lidm 2026
                </div>

                <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold leading-tight mb-6">
                    Belajar<br>
                    <span class="inline-block bg-[#FFF5B8] bb bs-sm px-4 py-1 rounded-3xl -rotate-2 mr-2">Mudah</span>
                    &amp;
                    <span class="inline-block bg-[#FFD1E3] bb bs-sm px-4 py-1 rounded-3xl rotate-2 mt-2">Seru!</span>
                </h1>

                <p class="text-xl font-medium mb-10 leading-relaxed text-slate-700 max-w-lg">
                    HonuSign hadir untuk anak-anak dan keluarga yang ingin si kecil belajar bahasa isyarat dengan cara
                    yang <strong>menyenangkan</strong> dan <strong>interaktif</strong>.
                </p>

                <div class="flex flex-col sm:flex-row gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="inline-flex items-center justify-center gap-2 px-10 py-4 bg-[#D4F1BE] font-bold text-xl bb bs bh rounded-3xl transition-all text-center">
                            Lanjut Belajar
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="inline-flex items-center justify-center gap-2 px-10 py-4 bg-[#BEE9E8] font-bold text-xl bb bs bh rounded-3xl transition-all text-center">
                            Mulai Belajar
                        </a>
                    @endauth
                </div>

                <!-- Stats row -->
                <div class="flex gap-6 mt-10 flex-wrap">
                    <div class="flex flex-col items-center bg-[#FFFEFA] bb bs-sm rounded-2xl px-5 py-3">
                        <span class="text-2xl font-bold">100%</span>
                        <span class="text-xs font-medium text-slate-500">Visual Learning</span>
                    </div>
                    <div class="flex flex-col items-center bg-[#FFFEFA] bb bs-sm rounded-2xl px-5 py-3">
                        <span class="text-2xl font-bold">6</span>
                        <span class="text-xs font-medium text-slate-500">Tahap Materi</span>
                    </div>
                    <div class="flex flex-col items-center bg-[#FFFEFA] bb bs-sm rounded-2xl px-5 py-3">
                        <span class="text-2xl font-bold">AI</span>
                        <span class="text-xs font-medium text-slate-500">Deteksi Isyarat</span>
                    </div>
                </div>
            </div>

            <!-- Right: Hero illustration -->
            <div class="relative flex justify-center">
                <div class="relative">
                    <!-- Shadow card behind image -->
                    <div class="absolute inset-0 translate-x-4 translate-y-4 bg-[#FFD1E3] bb rounded-[3rem]"></div>
                    <div class="relative bg-[#BEE9E8] bb rounded-[3rem] p-6 flex items-center justify-center">
                        <img src="{{ asset('images/page/hero.png') }}" alt="HonuSign — Belajar Bahasa Isyarat"
                            class="w-full max-w-sm rounded-2xl"
                            onerror="this.src='https://via.placeholder.com/480x480?text=HonuSign'" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ══════════════════════════════ FITUR ══════════════════════════════ -->
    <section id="fitur" class="py-28 px-6 bg-[#BEE9E8] divider">
        <div class="max-w-7xl mx-auto">

            <!-- Section header -->
            <div class="text-center mb-16">
                <span
                    class="inline-block px-4 py-2 bg-[#FFFEFA] bb bs-sm rounded-2xl text-sm font-bold mb-4 tilt-r transition-all">
                    Mengapa HonuSign?
                </span>
                <h2 class="text-4xl md:text-5xl font-bold">
                    <span class="inline-block bg-[#FFFEFA] bb bs px-8 py-3 rounded-3xl -rotate-1">
                        Fitur Unggulan Kami 🎯
                    </span>
                </h2>
            </div>

            <!-- Bento Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- Card 1 — Materi Terstruktur -->
                <div class="bg-[#FFFEFA] p-8 rounded-3xl bb bs bh tilt-l transition-all group cursor-default">
                    <div
                        class="w-16 h-16 bg-[#FFF5B8] rounded-2xl flex items-center justify-center text-3xl mb-6 bb bs-sm group-hover:rotate-6 transition-transform">
                        📚
                    </div>
                    <h3 class="text-2xl font-bold mb-3">Materi Terstruktur</h3>
                    <p class="font-medium text-lg leading-relaxed text-slate-600">Dari teori dasar SIBI hingga
                        perbendaharaan kata visual. Disusun rapi, mudah dipahami pemula.</p>
                </div>

                <!-- Card 2 — Kuis & Gamifikasi (wide) -->
                <div
                    class="bg-[#FFFEFA] p-8 rounded-3xl bb bs bh tilt-r transition-all group cursor-default lg:col-span-2">
                    <div class="flex items-start gap-6">
                        <div
                            class="w-16 h-16 bg-[#FFD1E3] rounded-2xl flex items-center justify-center text-3xl bb bs-sm shrink-0 group-hover:rotate-6 transition-transform">
                            🎮
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold mb-3">Kuis &amp; Gamifikasi</h3>
                            <p class="font-medium text-lg leading-relaxed text-slate-600">Kumpulkan poin dengan menjawab
                                kuis menebak isyarat. Belajar serasa bermain game yang seru dan menantang!</p>
                        </div>
                    </div>
                </div>

                <!-- Card 3 — Deteksi AI -->
                <div
                    class="bg-[#FFFEFA] p-8 rounded-3xl bb bs bh tilt-r transition-all group cursor-default lg:col-span-2">
                    <div class="flex items-start gap-6">
                        <div
                            class="w-16 h-16 bg-[#D4F1BE] rounded-2xl flex items-center justify-center text-3xl bb bs-sm shrink-0 group-hover:rotate-6 transition-transform">
                            📸
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold mb-3">Deteksi AI Kamera</h3>
                            <p class="font-medium text-lg leading-relaxed text-slate-600">Praktikkan gerakan bahasa
                                isyaratmu langsung, dan AI cerdas kami akan menilai gerakanmu secara real-time.</p>
                        </div>
                    </div>
                </div>

                <!-- Card 4 — Pantau Progres -->
                <div class="bg-[#FFFEFA] p-8 rounded-3xl bb bs bh tilt-l transition-all group cursor-default">
                    <div
                        class="w-16 h-16 bg-[#E0BBE4] rounded-2xl flex items-center justify-center text-3xl mb-6 bb bs-sm group-hover:rotate-6 transition-transform">
                        📈
                    </div>
                    <h3 class="text-2xl font-bold mb-3">Pantau Progres</h3>
                    <p class="font-medium text-lg leading-relaxed text-slate-600">Sistem otomatis menyimpan nilai dan
                        progres belajarmu di setiap tahap.</p>
                </div>

                <!-- Card 5 — Komunitas -->
                <div class="bg-[#FFFEFA] p-8 rounded-3xl bb bs bh tilt-r transition-all group cursor-default">
                    <div
                        class="w-16 h-16 bg-[#BEE9E8] rounded-2xl flex items-center justify-center text-3xl mb-6 bb bs-sm group-hover:rotate-6 transition-transform">
                        🤝
                    </div>
                    <h3 class="text-2xl font-bold mb-3">Komunikasi Inklusif</h3>
                    <p class="font-medium text-lg leading-relaxed text-slate-600">Bangun kesetaraan komunikasi antara
                        anak tunarungu dan lingkungan sekitarnya.</p>
                </div>

                <!-- Card 6 — Aksesibilitas -->
                <div class="bg-[#FFF5B8] p-8 rounded-3xl bb bs bh tilt-l transition-all group cursor-default">
                    <div
                        class="w-16 h-16 bg-[#FFFEFA] rounded-2xl flex items-center justify-center text-3xl mb-6 bb bs-sm group-hover:rotate-6 transition-transform">
                        ♿
                    </div>
                    <h3 class="text-2xl font-bold mb-3">Deaf-Friendly UI</h3>
                    <p class="font-medium text-lg leading-relaxed text-slate-600">Semua feedback berbasis visual. Tidak
                        bergantung suara sama sekali.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ══════════════════════════════ TENTANG ══════════════════════════════ -->
    <section id="tentang" class="py-32 px-6 bg-[#FFFEFA]">
        <div class="max-w-7xl mx-auto flex flex-col lg:flex-row items-center gap-16">

            <!-- Image side -->
            <div class="flex-1 w-full">
                <div class="relative max-w-md mx-auto">
                    <div class="absolute inset-0 translate-x-5 translate-y-5 bg-[#D4F1BE] bb rounded-[3rem]"></div>
                    <div class="relative bg-[#FFD1E3] bb bs rounded-[3rem] p-8 flex items-center justify-center">
                        <div class="bg-[#FFFEFA] bb bs-sm rounded-2xl p-6">
                            <img src="{{ asset('images/logo.png') }}" alt="HonuSign logo" class="w-full max-w-xs"
                                onerror="this.src='https://via.placeholder.com/320x320?text=Logo'" />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Text side -->
            <div class="flex-1">
                <span
                    class="inline-block px-4 py-2 bg-[#FFF5B8] bb bs-sm font-bold rounded-2xl mb-6 tilt-r transition-all">
                    Tentang Kami
                </span>
                <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-8 leading-tight">
                    Membangun Komunikasi<br>Tanpa Batas
                </h2>
                <p class="text-xl font-medium mb-8 leading-relaxed text-slate-600">
                    HonuSign berdedikasi menciptakan lingkungan belajar yang ramah bagi anak tunarungu. Melalui
                    pendekatan <strong>visual-first</strong>, kami menjembatani komunikasi yang lebih baik di
                    masyarakat.
                </p>

                <!-- Feature pills -->
                <div class="flex flex-wrap gap-3">
                    <span class="px-4 py-2 bg-[#D4F1BE] bb rounded-2xl font-bold text-sm">Gratis</span>
                    <span class="px-4 py-2 bg-[#BEE9E8] bb rounded-2xl font-bold text-sm">Berbasis AI</span>
                    <span class="px-4 py-2 bg-[#E0BBE4] bb rounded-2xl font-bold text-sm">Tablet-Friendly</span>
                    <!-- <span class="px-4 py-2 bg-[#FFF5B8] bb rounded-2xl font-bold text-sm">🏆 LIDM 2026</span> -->
                </div>
            </div>
        </div>
    </section>

    <!-- ══════════════════════════════ CTA BANNER ══════════════════════════════ -->
    <section class="py-20 px-6 bg-[#FFF5B8] divider border-b-4 border-black">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-4xl md:text-5xl font-bold mb-6">
                Siap Mulai Petualangan<br>Belajar? <span class="inline-block animate-bounce">🚀</span>
            </h2>
            <p class="text-xl font-medium text-slate-600 mb-10">Bergabung dengan HonuSign dan bantu si kecil belajar
                bahasa isyarat hari ini.</p>
            @auth
                <a href="{{ url('/dashboard') }}"
                    class="inline-flex items-center gap-3 px-12 py-5 bg-[#D4F1BE] font-bold text-2xl bb bs bh rounded-3xl transition-all">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}"
                    class="inline-flex items-center gap-3 px-12 py-5 bg-[#BEE9E8] font-bold text-2xl bb bs bh rounded-3xl transition-all">
                    Mulai Sekarang
                </a>
            @endauth
        </div>
    </section>

    <!-- ══════════════════════════════ FOOTER ══════════════════════════════ -->
    <footer class="bg-[#BEE9E8] py-14 px-6 bb border-b-0 border-l-0 border-r-0">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="text-4xl font-bold tracking-tighter">
                Honu<span class="text-[#FFD1E3] text-stamp">Sign</span>
            </div>
            <p class="font-medium text-slate-600 text-center">
                Platform Edukasi Bahasa Isyarat SIBI untuk Anak Tunarungu
            </p>
            <p class="font-bold text-lg">
                &copy; {{ date('Y') }} HonuSign.
            </p>
        </div>
    </footer>

</body>

</html>