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
            <div class="flex justify-center w-full px-4">
                <img src="{{ asset('images/page/hero.png') }}" alt="HonuSign — Belajar Bahasa Isyarat"
                    class="w-full max-w-md hero-float object-contain"
                    onerror="this.src='https://via.placeholder.com/480x480?text=HonuSign'" />
            </div>
        </div>
    </section>

    <section id="fitur" class="py-28 px-6 bg-[#BEE9E8] divider">
        <div class="max-w-7xl mx-auto">

            <div class="text-center mb-16">
                <span
                    class="inline-block px-4 py-2 bg-[#FFFEFA] bb bs-sm rounded-2xl text-sm font-bold mb-4 tilt-r transition-all">
                    Mengapa HonuSign?
                </span>
                <h2 class="text-4xl md:text-5xl font-bold">
                    <span class="inline-block bg-[#FFFEFA] bb bs px-8 py-3 rounded-3xl -rotate-1">
                        Fitur Unggulan Kami
                    </span>
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <div class="bg-[#FFFCE3] p-8 rounded-3xl bb bs bh tilt-l transition-all group cursor-default">
                    <div
                        class="w-16 h-16 bg-[#FFF5B8] rounded-2xl flex items-center justify-center mb-6 bb bs-sm group-hover:rotate-6 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="w-9 h-9 text-[#B39200]">
                            <path
                                d="M21 4H3a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1ZM5 18H4V6h1v12Zm15 0h-1V6h1v12Zm-3-6H7V10h10v2Zm0-4H7V6h10v2Z"
                                opacity="0.2" />
                            <path
                                d="M19 2H5a3 3 0 0 0-3 3v14a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V5a3 3 0 0 0-3-3Zm1 17a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v14Zm-4-8H8a1 1 0 0 0 0 2h8a1 1 0 0 0 0-2Zm0-4H8a1 1 0 0 0 0 2h8a1 1 0 1 0 0-2Z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-3 text-slate-800">Materi Terstruktur</h3>
                    <p class="font-medium text-lg leading-relaxed text-slate-600">Dari teori dasar SIBI hingga
                        perbendaharaan kata visual. Disusun rapi, mudah dipahami pemula.</p>
                </div>

                <div
                    class="bg-[#FFF0F5] p-8 rounded-3xl bb bs bh tilt-r transition-all group cursor-default lg:col-span-2">
                    <div class="flex items-start gap-6">
                        <div
                            class="w-16 h-16 bg-[#FFD1E3] rounded-2xl flex items-center justify-center bb bs-sm shrink-0 group-hover:rotate-6 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-9 h-9 text-[#C24173]">
                                <rect x="3" y="5" width="18" height="14" rx="3" opacity="0.2" />
                                <path
                                    d="M19 3H5a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V6a3 3 0 0 0-3-3Zm1 15a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v12Zm-9-7H9V9a1 1 0 0 0-2 0v2H5a1 1 0 0 0 0 2h2v2a1 1 0 0 0 2 0v-2h2a1 1 0 0 0 0-2Zm6.5.5a1.25 1.25 0 1 1-1.25-1.25 1.25 1.25 0 0 1 1.25 1.25Zm-2.5 2a1.25 1.25 0 1 1-1.25-1.25A1.25 1.25 0 0 1 15 13Z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold mb-3 text-slate-800">Kuis &amp; Gamifikasi</h3>
                            <p class="font-medium text-lg leading-relaxed text-slate-600">Kumpulkan poin dengan menjawab
                                kuis menebak isyarat. Belajar serasa bermain game yang seru dan menantang!</p>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-[#F0F9EB] p-8 rounded-3xl bb bs bh tilt-r transition-all group cursor-default lg:col-span-2">
                    <div class="flex items-start gap-6">
                        <div
                            class="w-16 h-16 bg-[#D4F1BE] rounded-2xl flex items-center justify-center bb bs-sm shrink-0 group-hover:rotate-6 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-9 h-9 text-[#527A37]">
                                <circle cx="12" cy="12" r="4" opacity="0.2" />
                                <path
                                    d="M4 5a1 1 0 0 1 1-1h2a1 1 0 0 0 0-2H5a3 3 0 0 0-3 3v2a1 1 0 0 0 2 0V5Zm15-3h-2a1 1 0 0 0 0 2h2a1 1 0 0 1 1 1v2a1 1 0 0 0 2 0V5a3 3 0 0 0-3-3ZM4 17a1 1 0 0 0-2 0v2a3 3 0 0 0 3 3h2a1 1 0 0 0 0-2H5a1 1 0 0 1-1-1v-2Zm16 2a1 1 0 0 1-1 1h-2a1 1 0 0 0 0 2h2a3 3 0 0 0 3-3v-2a1 1 0 0 0-2 0v2Zm-8-11a4 4 0 1 0 4 4 4 4 0 0 0-4-4Zm0 6a2 2 0 1 1 2-2 2 2 0 0 1-2 2Z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold mb-3 text-slate-800">Deteksi AI Kamera</h3>
                            <p class="font-medium text-lg leading-relaxed text-slate-600">Praktikkan gerakan bahasa
                                isyaratmu langsung, dan AI cerdas kami akan menilai gerakanmu secara real-time.</p>
                        </div>
                    </div>
                </div>

                <div class="bg-[#F6EBF7] p-8 rounded-3xl bb bs bh tilt-l transition-all group cursor-default">
                    <div
                        class="w-16 h-16 bg-[#E0BBE4] rounded-2xl flex items-center justify-center mb-6 bb bs-sm group-hover:rotate-6 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="w-9 h-9 text-[#7E4A85]">
                            <path
                                d="M12 2L9.12 8.12L2.34 8.71L7.5 13.22L5.91 19.88L12 16.3L18.09 19.88L16.5 13.22L21.66 8.71L14.88 8.12L12 2Z"
                                opacity="0.2" />
                            <path
                                d="M12 2a1 1 0 0 0-.89.55L8.51 7.82l-5.83.5a1 1 0 0 0-.56 1.74l4.37 3.79-1.3 5.67a1 1 0 0 0 1.5 1.08l5.11-3 5.11 3a1 1 0 0 0 1.5-1.08l-1.3-5.67 4.37-3.79a1 1 0 0 0-.56-1.74l-5.83-.5-2.6-5.27A1 1 0 0 0 12 2Zm3.55 11.85a1 1 0 0 0-.31.95l.89 3.89-3.41-2a1 1 0 0 0-.94 0l-3.41 2 .89-3.89a1 1 0 0 0-.31-.95L6.32 11.2l3.94-.34a1 1 0 0 0 .82-.6L12 6.69l.92 1.86a1 1 0 0 0 .82.6l3.94.34Z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-3 text-slate-800">Pantau Progres</h3>
                    <p class="font-medium text-lg leading-relaxed text-slate-600">Sistem otomatis menyimpan nilai dan
                        progres belajarmu di setiap tahap.</p>
                </div>

                <div class="bg-[#EBF7F7] p-8 rounded-3xl bb bs bh tilt-r transition-all group cursor-default">
                    <div
                        class="w-16 h-16 bg-[#BEE9E8] rounded-2xl flex items-center justify-center mb-6 bb bs-sm group-hover:rotate-6 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="w-9 h-9 text-[#3A7573]">
                            <path
                                d="M12 2a10 10 0 0 0-10 10 9.87 9.87 0 0 0 2.26 6.4L3 21a1 1 0 0 0 1.26.94l2.76-.88A9.87 9.87 0 0 0 12 22a10 10 0 0 0 10-10A10 10 0 0 0 12 2Z"
                                opacity="0.2" />
                            <path
                                d="M12 2a10 10 0 0 0-7.74 16.33l-.93 2.93a1 1 0 0 0 1.27 1.27l2.93-.93A10 10 0 1 0 12 2Zm0 18a8 8 0 0 1-4.17-1.17 1 1 0 0 0-.82-.07l-1.64.52.52-1.64a1 1 0 0 0-.07-.82A8 8 0 1 1 12 20Zm-3-9a1.5 1.5 0 1 0 1.5 1.5A1.5 1.5 0 0 0 9 11Zm6 0a1.5 1.5 0 1 0 1.5 1.5A1.5 1.5 0 0 0 15 11Zm-6 4a3 3 0 0 0 6 0Z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-3 text-slate-800">Komunikasi Inklusif</h3>
                    <p class="font-medium text-lg leading-relaxed text-slate-600">Bangun kesetaraan komunikasi antara
                        anak tunarungu dan lingkungan sekitarnya.</p>
                </div>

                <div
                    class="bg-[#FFF9DE] p-8 rounded-3xl bb bs bh tilt-l transition-all group cursor-default lg:col-span-2">
                    <div class="flex flex-col md:flex-row md:items-center gap-6">
                        <div
                            class="w-16 h-16 bg-[#FFFEFA] rounded-2xl flex items-center justify-center bb bs-sm shrink-0 group-hover:rotate-6 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-9 h-9 text-[#B39200]">
                                <path
                                    d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5ZM12 17a5 5 0 1 1 5-5 5 5 0 0 1-5 5Z"
                                    opacity="0.2" />
                                <path
                                    d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5Zm0 13a5 5 0 1 1 5-5 5 5 0 0 1-5 5Zm0-8a3 3 0 1 0 3 3 3 3 0 0 0-3-3Z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold mb-3 text-slate-800">Deaf-Friendly UI</h3>
                            <p class="font-medium text-lg leading-relaxed text-slate-600">Semua feedback berbasis
                                visual. Tidak bergantung suara sama sekali.</p>
                        </div>
                    </div>
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
                Siap Mulai Petualangan
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

<style>
    @keyframes float {
        0% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-18px);
        }

        100% {
            transform: translateY(0px);
        }
    }

    .hero-float {
        animation: float 3.5s ease-in-out infinite;
    }
</style>

</html>