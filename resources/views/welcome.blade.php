<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HonuSign - Belajar SIBI Interaktif</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased bg-slate-50 text-slate-800 font-sans">

    <!-- Navbar -->
    <nav class="fixed w-full z-50 bg-white/80 backdrop-blur-md border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <div class="text-2xl font-black text-teal-600 tracking-tighter">
                HONU<span class="text-blue-500">SIGN.</span>
            </div>
            <div class="hidden md:flex gap-8 font-semibold text-slate-600">
                <a href="#beranda" class="hover:text-teal-500 transition-colors">Beranda</a>
                <a href="#fitur" class="hover:text-teal-500 transition-colors">Fitur</a>
                <a href="#tentang" class="hover:text-teal-500 transition-colors">Tentang Kami</a>
            </div>
            <div class="flex items-center gap-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-full shadow-lg shadow-blue-600/30 transition-all">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="font-bold text-teal-600 hover:text-teal-700 px-4 py-2">Masuk</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="px-6 py-2.5 bg-teal-500 hover:bg-teal-600 text-white font-bold rounded-full shadow-lg shadow-teal-500/30 transition-all">Daftar
                                Akun</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="beranda" class="pt-32 pb-20 md:pt-48 md:pb-32 px-6">
        <div class="max-w-7xl mx-auto grid gap-12 items-center lg:grid-cols-[1.05fr_0.95fr]">
            <div class="max-w-2xl">
                <span
                    class="inline-flex px-5 py-2 mb-6 text-xs font-black tracking-widest text-slate-700 uppercase bg-slate-100 rounded-full border border-slate-200 shadow-sm">
                    🚀 LIDM 2026 - Universitas Riau
                </span>
                <h1 class="text-4xl md:text-6xl lg:text-7xl font-black text-slate-900 leading-tight tracking-tight mb-8">
                    Yuk Belajar SIBI dengan Cara yang <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-teal-500 to-blue-600">Mudah,</span>
                    <span class="text-teal-600">Seru</span>, dan <span
                        class="text-blue-600">Interaktif.</span>
                </h1>
                <p class="text-lg md:text-xl text-slate-600 mb-10 leading-relaxed">
                    HonuSign hadir untuk anak-anak dan keluarga yang ingin belajar bahasa isyarat dengan cara
                    menyenangkan. Materi yang ramah anak, kuis interaktif, dan dukungan AI membuat belajar jadi
                    lebh percaya diri.
                </p>
                <div class="flex flex-col sm:flex-row items-center sm:items-start gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="inline-flex items-center justify-center px-11 py-4 bg-teal-500 hover:bg-teal-600 text-white font-black text-base rounded-full shadow-[0_10px_0_0_#0f766e] hover:shadow-[0_6px_0_0_#0f766e] transition-all">
                            Lanjut Belajar
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="inline-flex items-center justify-center px-11 py-4 bg-teal-500 hover:bg-teal-600 text-white font-black text-base rounded-full shadow-[0_10px_0_0_#0f766e] hover:shadow-[0_6px_0_0_#0f766e] transition-all">
                            Mulai Belajar
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="inline-flex items-center justify-center px-11 py-4 bg-white text-slate-700 font-black text-base rounded-full border-2 border-slate-200 shadow-[0_10px_0_0_#cbd5e1] hover:bg-slate-50 transition-all">
                                Daftar Gratis
                            </a>
                        @endif
                    @endauth
                </div>
                <div class="mt-12 grid gap-4 sm:grid-cols-2">
                    <div class="rounded-3xl border border-teal-100 bg-teal-50/80 p-5 shadow-sm">
                        <p class="font-black text-slate-900">Materi yang mudah dipahami</p>
                        <p class="text-sm text-slate-600 mt-2">Dari dasar sampai latihan praktis.</p>
                    </div>
                    <div class="rounded-3xl border border-blue-100 bg-blue-50/80 p-5 shadow-sm">
                        <p class="font-black text-slate-900">Latihan interaktif</p>
                        <p class="text-sm text-slate-600 mt-2">Kuis, kamera, dan game yang seru.</p>
                    </div>
                </div>
            </div>

            <div class="relative flex justify-center">
                <img src="{{ asset('images/page/hero.png') }}" alt="HonuSign Hero"
                    class="w-full max-w-xl rounded-[3rem] object-cover" />
            </div>
        </div>
    </section>

    <!-- Fitur Section -->
    <section id="fitur" class="py-24 bg-slate-100 px-6 border-y border-slate-200">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-20">
                <h2 class="text-4xl md:text-5xl font-black text-slate-800 tracking-tight mb-6">Kenapa Belajar di
                    HonuSign?</h2>
                <p class="text-xl text-slate-500 max-w-2xl mx-auto">Kami menggabungkan metode pembelajaran terstruktur
                    dengan gamifikasi dan teknologi AI terkini.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div
                    class="bg-white p-10 rounded-[2rem] shadow-xl border-b-8 border-teal-200 transform hover:-translate-y-2 transition-transform duration-300">
                    <div
                        class="w-20 h-20 bg-teal-50 rounded-3xl flex items-center justify-center text-teal-500 mb-8 border-2 border-teal-100">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-black text-slate-800 mb-4">Materi Terstruktur</h3>
                    <p class="text-slate-500 text-lg leading-relaxed">Dari teori dasar hingga perbendaharaan kata
                        visual. Didesain agar mudah dipahami oleh pemula sekalipun.</p>
                </div>

                <!-- Card 2 -->
                <div
                    class="bg-white p-10 rounded-[2rem] shadow-xl border-b-8 border-blue-200 transform hover:-translate-y-2 transition-transform duration-300">
                    <div
                        class="w-20 h-20 bg-blue-50 rounded-3xl flex items-center justify-center text-blue-500 mb-8 border-2 border-blue-100">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-black text-slate-800 mb-4">Kuis & Gamifikasi</h3>
                    <p class="text-slate-500 text-lg leading-relaxed">Kumpulkan poin dengan menjawab kuis menebak
                        isyarat. Belajar serasa sedang bermain game!</p>
                </div>

                <!-- Card 3 -->
                <div
                    class="bg-white p-10 rounded-[2rem] shadow-xl border-b-8 border-purple-200 transform hover:-translate-y-2 transition-transform duration-300">
                    <div
                        class="w-20 h-20 bg-purple-50 rounded-3xl flex items-center justify-center text-purple-500 mb-8 border-2 border-purple-100">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-black text-slate-800 mb-4">Deteksi AI Kamera</h3>
                    <p class="text-slate-500 text-lg leading-relaxed">Praktikkan gerakan bahasamu langsung. Teknologi AI
                        kami akan mengoreksi apakah gerakanmu sudah tepat.</p>
                </div>

                <!-- Card 4 -->
                <div class="bg-white p-10 rounded-[2rem] shadow-xl border-b-8 border-orange-200 transform hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-20 h-20 bg-orange-50 rounded-3xl flex items-center justify-center text-orange-500 mb-8 border-2 border-orange-100">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-black text-slate-800 mb-4">Pantau Progres</h3>
                    <p class="text-slate-500 text-lg leading-relaxed">Sistem secara otomatis menyimpan nilai dan progres belajarmu, sehingga kamu bisa melanjutkan kapan saja.</p>
                </div>

                <!-- Card 5 -->
                <div class="bg-white p-10 rounded-[2rem] shadow-xl border-b-8 border-pink-200 transform hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-20 h-20 bg-pink-50 rounded-3xl flex items-center justify-center text-pink-500 mb-8 border-2 border-pink-100">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-black text-slate-800 mb-4">Akses Fleksibel</h3>
                    <p class="text-slate-500 text-lg leading-relaxed">Belajar di mana pun menggunakan perangkat apa pun. Tampilan kami menyesuaikan dengan layar HP maupun Laptop.</p>
                </div>

                <!-- Card 6 -->
                <div class="bg-white p-10 rounded-[2rem] shadow-xl border-b-8 border-emerald-200 transform hover:-translate-y-2 transition-transform duration-300">
                    <div class="w-20 h-20 bg-emerald-50 rounded-3xl flex items-center justify-center text-emerald-500 mb-8 border-2 border-emerald-100">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-black text-slate-800 mb-4">Komunitas Inklusif</h3>
                    <p class="text-slate-500 text-lg leading-relaxed">Jadilah bagian dari masyarakat yang lebih inklusif dengan membangun kesetaraan komunikasi bersama HonuSign.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Tentang Kami / Info Section -->
    <section id="tentang" class="py-32 px-6 overflow-hidden relative">
        <div class="max-w-7xl mx-auto flex flex-col lg:flex-row items-center gap-16">
            <div class="flex-1 w-full">
                <div
                    class="w-full h-[500px] bg-gradient-to-br from-teal-200 to-blue-200 rounded-[3rem] shadow-2xl relative flex items-center justify-center border-8 border-white">
                    <!-- Placeholder untuk gambar 3D atau ilustrasi UI -->
                    <div class="text-center px-6">
                        <svg class="w-24 h-24 mx-auto text-teal-700/40 mb-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        <p class="text-teal-800/60 font-bold text-xl">Ilustrasi App Placeholder</p>
                    </div>
                </div>
            </div>
            <div class="flex-1">
                <span class="text-teal-600 font-bold tracking-widest uppercase text-sm mb-4 block">Tentang Kami</span>
                <h2
                    class="text-4xl md:text-5xl lg:text-6xl font-black text-slate-800 tracking-tight mb-8 leading-tight">
                    Membangun Komunikasi<br />Tanpa Batas</h2>
                <p class="text-xl text-slate-500 mb-6 leading-relaxed">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip ex ea commodo consequat.
                </p>
                <p class="text-xl text-slate-500 mb-10 leading-relaxed">
                    Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                    pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui.
                </p>

                <!-- List benefits -->
                <ul class="space-y-6 text-lg font-bold text-slate-700">
                    <li class="flex items-center gap-5">
                        <div
                            class="w-12 h-12 rounded-full bg-teal-100 flex items-center justify-center text-teal-600 shadow-sm shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M5 13l4 4L19 7"></path>
                            </svg></div>
                        Akses materi dari mana saja secara gratis
                    </li>
                    <li class="flex items-center gap-5">
                        <div
                            class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 shadow-sm shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M5 13l4 4L19 7"></path>
                            </svg></div>
                        Kurikulum standar SIBI yang mudah dipahami
                    </li>
                    <li class="flex items-center gap-5">
                        <div
                            class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 shadow-sm shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M5 13l4 4L19 7"></path>
                            </svg></div>
                        Evaluasi langsung dengan teknologi kecerdasan buatan
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-400 py-16 px-6 border-t-[16px] border-teal-500">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-8">
            <div class="text-3xl font-black text-white tracking-tighter">
                HONU<span class="text-teal-400">SIGN.</span>
            </div>
            <div class="flex gap-6">
                <a href="#" class="hover:text-white transition-colors">Instagram</a>
                <a href="#" class="hover:text-white transition-colors">GitHub</a>
                <a href="#" class="hover:text-white transition-colors">Email</a>
            </div>
            <p class="font-medium text-sm text-slate-500">
                &copy; {{ date('Y') }} HonuSign - Universitas Riau.<br />All rights reserved.
            </p>
        </div>
    </footer>

</body>

</html>