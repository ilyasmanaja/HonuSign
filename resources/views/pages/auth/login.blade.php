<x-layouts::auth :title="__('Masuk')">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Fredoka:wght@400;500;600;700&display=swap');

        * {
            font-family: 'Fredoka', sans-serif !important;
        }

        body {
            background-color: #BEE9E8 !important;
            min-height: 100vh;
            background-image:
                radial-gradient(circle at 15% 20%, #FFD1E399 0px, transparent 200px),
                radial-gradient(circle at 85% 75%, #FFF5B899 0px, transparent 200px),
                radial-gradient(circle at 50% 90%, #D4F1BE88 0px, transparent 150px);
        }

        /* ── Brutalism helpers ── */
        .bb {
            border: 4px solid #000 !important;
        }

        .bs {
            box-shadow: 6px 6px 0 #000 !important;
        }

        .bs-sm {
            box-shadow: 3px 3px 0 #000 !important;
        }

        .bh {
            transition: all 0.15s ease-in-out !important;
        }

        .bh:hover {
            transform: translate(-3px, -3px) !important;
            box-shadow: 9px 9px 0 #000 !important;
        }

        .bh:active {
            transform: translate(2px, 2px) !important;
            box-shadow: 2px 2px 0 #000 !important;
        }

        /* Card */
        .brutal-card {
            background: #FFFEFA;
            border: 4px solid #000;
            box-shadow: 8px 8px 0 #000;
            border-radius: 2rem;
            padding: 2.5rem;
        }

        /* Inputs */
        input[type="email"],
        input[type="password"],
        input[type="text"] {
            border: 3px solid #000 !important;
            box-shadow: 3px 3px 0 #000 !important;
            border-radius: 0.75rem !important;
            background-color: #FFFEFA !important;
            color: #000 !important;
            font-size: 1.05rem !important;
            padding: 0.75rem 1rem !important;
            transition: all 0.15s ease-in-out !important;
            outline: none !important;
        }

        input[type="email"]:focus,
        input[type="password"]:focus,
        input[type="text"]:focus {
            transform: translate(-2px, -2px) !important;
            box-shadow: 5px 5px 0 #000 !important;
        }

        input::placeholder {
            color: #94a3b8 !important;
            opacity: 1 !important;
        }

        /* Submit button */
        .btn-submit {
            background-color: #D4F1BE;
            color: #000;
            border: 4px solid #000 !important;
            box-shadow: 4px 4px 0 #000;
            border-radius: 1rem !important;
            font-weight: 700 !important;
            font-size: 1.125rem !important;
            padding: 0.8rem 1.5rem !important;
            transition: all 0.15s ease-in-out !important;
            width: 100%;
            cursor: pointer;
        }

        .btn-submit:hover {
            transform: translate(-3px, -3px) !important;
            box-shadow: 7px 7px 0 #000 !important;
            background-color: #FFF5B8 !important;
        }

        .btn-submit:active {
            transform: translate(2px, 2px) !important;
            box-shadow: 2px 2px 0 #000 !important;
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
            border: 3px solid #000 !important;
            border-radius: 6px !important;
            box-shadow: 2px 2px 0 #000 !important;
            background-color: #FFFEFA !important;
            cursor: pointer;
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

    <!-- Floating deco shapes -->
    <div class="pointer-events-none fixed top-16 left-8 w-20 h-20 rounded-full bg-[#FFD1E3] bb opacity-50 float"
        style="--r:-10deg;animation-delay:0s;"></div>
    <div class="pointer-events-none fixed bottom-20 right-8 w-14 h-14 rounded-full bg-[#FFF5B8] bb opacity-60 float"
        style="--r:8deg;animation-delay:1.2s;"></div>
    <div class="pointer-events-none fixed top-1/2 right-16 w-10 h-10 rounded-full bg-[#D4F1BE] bb opacity-50 float"
        style="--r:-5deg;animation-delay:0.6s;"></div>

    <!-- Card -->
    <div class="brutal-card flex flex-col gap-6 w-full max-w-md mx-auto -rotate-1 mt-6 md:mt-0">

        <!-- Header -->
        <div class="text-center rotate-1">
            <div class="text-5xl mb-3 animate-bounce inline-block">👋</div>
            <h1 class="text-4xl font-bold tracking-tight mb-2 text-black">
                Masuk ke <span class="text-[#FFD1E3] text-stamp">HonuSign</span>
            </h1>
            <p class="text-lg font-medium text-slate-500">Selamat datang kembali! Yuk lanjut belajar.</p>
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
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    autocomplete="email" placeholder="email@contoh.com" class="w-full">
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
                <input type="checkbox" name="remember" class="accent-[#D4F1BE]">
                <span class="text-lg font-bold text-black">Ingat saya</span>
            </label>

            <!-- Submit -->
            <button type="submit" class="btn-submit mt-2" data-test="login-button">
                Masuk Sekarang!
            </button>
        </form>

        <!-- Divider -->
        <div class="flex items-center gap-3">
            <div class="flex-1 border-t-2 border-black/20"></div>
            <span class="text-sm font-medium text-slate-400">atau</span>
            <div class="flex-1 border-t-2 border-black/20"></div>
        </div>

        <!-- Register link -->
        <div class="text-center rotate-1">
            <span class="text-lg font-medium text-slate-500">Belum punya akun?</span>
            <a href="{{ route('register') }}"
                class="text-lg font-bold text-black underline decoration-2 underline-offset-4 hover:text-[#E0BBE4] transition-colors ml-1"
                wire:navigate>
                Daftar Gratis
            </a>
        </div>
    </div>
</x-layouts::auth>