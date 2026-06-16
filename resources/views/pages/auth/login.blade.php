<x-layouts::auth :title="__('Masuk')">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Fredoka:wght@400;500;600;700&display=swap');

        .auth-container {
            font-family: 'Fredoka', sans-serif;
        }

        .auth-container * {
            font-family: 'Fredoka', sans-serif;
        }

        body {
            background-color: #BEE9E8;
            min-height: 100vh;
        }

        /* ── Brutalism helpers ── */
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

        /* Card */
        .brutal-card {
            background: #FFFEFA;
            border: 4px solid #000;
            box-shadow: 8px 8px 0 #000;
            border-radius: 1.5rem;
            padding: 2.5rem;
        }

        /* Inputs */
        input[type="email"],
        input[type="password"],
        input[type="text"] {
            border: 3px solid #000;
            box-shadow: 3px 3px 0 #000;
            border-radius: 0.75rem;
            background-color: #FFFEFA;
            color: #000;
            font-size: 1.05rem;
            padding: 0.75rem 1rem;
            transition: all 0.15s ease-in-out;
            outline: none;
        }

        input[type="email"]:focus,
        input[type="password"]:focus,
        input[type="text"]:focus {
            transform: translate(-2px, -2px);
            box-shadow: 5px 5px 0 #000;
        }

        input::placeholder {
            color: #475569;
            opacity: 1;
        }

        /* Submit button */
        .btn-submit {
            background-color: #D4F1BE;
            color: #000;
            border: 4px solid #000;
            box-shadow: 4px 4px 0 #000;
            border-radius: 1rem;
            font-weight: 700;
            font-size: 1.125rem;
            padding: 0.8rem 1.5rem;
            transition: all 0.15s ease-in-out;
            width: 100%;
            cursor: pointer;
        }

        .btn-submit:hover {
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0 #000;
            background-color: #FFF5B8;
        }

        .btn-submit:active {
            transform: translate(2px, 2px);
            box-shadow: 2px 2px 0 #000;
        }

        /* text-outline stamp */
        .text-stamp {
            text-shadow: -2px -2px 0 #000, 2px -2px 0 #000,
                -2px 2px 0 #000, 2px 2px 0 #000,
                3px 3px 0 #000;
        }

        /* checkbox */
        input[type="checkbox"] {
            width: 1.2rem;
            height: 1.2rem;
            border: 3px solid #000;
            border-radius: 6px;
            box-shadow: 2px 2px 0 #000;
            background-color: #FFFEFA;
            cursor: pointer;
            transition: all 0.15s ease-in-out;
            appearance: none;
            display: inline-grid;
            place-content: center;
        }

        input[type="checkbox"]:checked {
            background-color: #D4F1BE;
        }

        input[type="checkbox"]:checked::before {
            content: "";
            width: 0.6em;
            height: 0.6em;
            transform: scale(1);
            background-color: #000;
            clip-path: polygon(14% 44%, 0 58%, 38% 96%, 100% 17%, 86% 3%, 38% 70%);
        }

        /* Floating deco */
        @keyframes float-y {

            0%,
            100% {
                transform: translateY(0) rotate(var(--r, 0deg));
            }

            50% {
                transform: translateY(-12px) rotate(var(--r, 0deg));
            }
        }

        .float {
            animation: float-y 5s ease-in-out infinite;
        }
    </style>

    <div class="auth-container">
        <!-- Floating deco shapes -->
        <div class="pointer-events-none fixed top-16 left-8 w-20 h-20 rounded-full bg-[#FFD1E3] bb opacity-50 float"
            style="--r:-10deg;animation-delay:0s;"></div>
        <div class="pointer-events-none fixed bottom-20 right-8 w-14 h-14 rounded-full bg-[#FFF5B8] bb opacity-60 float"
            style="--r:8deg;animation-delay:1.2s;"></div>
        <div class="pointer-events-none fixed top-1/2 right-16 w-10 h-10 rounded-full bg-[#D4F1BE] bb opacity-50 float"
            style="--r:-5deg;animation-delay:0.6s;"></div>

        <!-- Card Wrapper -->
        <div class="relative w-full max-w-md mx-auto mt-12 md:mt-16">
            <!-- Back Button with Tooltip -->
            <div class="fixed top-6 left-6 z-50 group/tooltip">
                <a href="{{ url('/') }}"
                    class="w-12 h-12 bg-[#FFF5B8] bb bs-sm bh rounded-xl flex items-center justify-center group"
                    aria-label="Kembali ke Beranda">
                    <svg class="w-6 h-6 text-black group-hover:-translate-x-1 transition-transform" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="3" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M19 12H5M12 19l-7-7 7-7" />
                    </svg>
                </a>
                <!-- Neobrutalist Tooltip -->
                <div class="pointer-events-none absolute left-14 top-1/2 -translate-y-1/2 bg-[#FFD1E3] bb bs-sm px-3 py-1.5 rounded-lg text-sm font-bold opacity-0 scale-95 group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-150 whitespace-nowrap z-50 text-black">
                    Kembali
                </div>
            </div>

            <!-- Card -->
            <div class="brutal-card flex flex-col gap-6 w-full -rotate-1">

                <!-- Header -->
                <div class="text-center rotate-1">
                    <h1 class="text-4xl font-bold tracking-tight mb-2 text-black">
                        Masuk ke <span class="text-[#FFD1E3] text-stamp" title="Masuk ke HonuSign">HonuSign</span>
                    </h1>
                    <p class="text-lg font-medium text-slate-900">Selamat datang kembali! Yuk lanjut belajar.</p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="text-center" :status="session('status')" />

                <!-- Validation Errors -->
                @if ($errors->any())
                    <div class="bg-[#FFB3B3] bb bs-sm rounded-2xl px-5 py-4">
                        <p class="font-bold text-black text-sm mb-1">Oops, ada yang salah:</p>
                        <ul class="list-disc list-inside text-sm font-medium text-black space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Form -->
                <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-5 rotate-1">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-lg font-bold text-black mb-2">
                            Email
                        </label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            autofocus autocomplete="email" placeholder="email@contoh.com" class="w-full">
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-lg font-bold text-black mb-2">
                            Password
                        </label>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            placeholder="Masukkan password" class="w-full">
                    </div>

                    <!-- Remember Me -->
                    <label class="flex items-center gap-3 cursor-pointer select-none">
                        <input type="checkbox" name="remember">
                        <span class="text-lg font-bold text-black">Ingat saya</span>
                    </label>

                    <!-- Submit -->
                    <button type="submit" class="btn-submit mt-2" data-test="login-button">
                        Masuk Sekarang!
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-layouts::auth>
