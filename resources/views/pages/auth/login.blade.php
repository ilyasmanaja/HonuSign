<x-layouts::auth :title="__('Log in')">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Fredoka:wght@400;500;600;700&display=swap');

        body {
            font-family: 'Fredoka', sans-serif !important;
            background-color: #BEE9E8 !important;
            /* Biru Muda Pastel */
        }

        /* Override dark mode bg from layout */
        .dark body {
            background-color: #BEE9E8 !important;
        }

        .brutal-card {
            background-color: #FFFEFA;
            border: 3px solid #000;
            box-shadow: 8px 8px 0px 0px #000;
            border-radius: 2rem;
            padding: 2.5rem;
        }

        /* Style untuk input agar terlihat brutalism */
        input[type="email"],
        input[type="password"],
        input[type="text"] {
            border: 3px solid #000 !important;
            box-shadow: 3px 3px 0px 0px #000 !important;
            border-radius: 0.75rem !important;
            font-family: 'Fredoka', sans-serif !important;
            transition: all 0.2s ease-in-out;
            background-color: #FFFEFA !important;
        }

        input[type="email"]:focus,
        input[type="password"]:focus,
        input[type="text"]:focus {
            transform: translate(-2px, -2px) !important;
            box-shadow: 5px 5px 0px 0px #000 !important;
            outline: none !important;
            ring: 0 !important;
        }

        /* Tombol brutalism */
        button[type="submit"] {
            background-color: #D4F1BE !important;
            /* Hijau Mint */
            color: #000 !important;
            border: 3px solid #000 !important;
            box-shadow: 4px 4px 0px 0px #000 !important;
            border-radius: 1rem !important;
            font-weight: 700 !important;
            font-size: 1.125rem !important;
            padding: 0.75rem 1.5rem !important;
            transition: all 0.2s ease-in-out !important;
        }

        button[type="submit"]:hover {
            transform: translate(-2px, -2px) !important;
            box-shadow: 6px 6px 0px 0px #000 !important;
            background-color: #FFF5B8 !important;
            /* Kuning Cerah */
        }

        button[type="submit"]:active {
            transform: translate(2px, 2px) !important;
            box-shadow: 2px 2px 0px 0px #000 !important;
        }

        .text-outline {
            text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000, 2px 2px 0 #000;
        }
    </style>

    <div class="brutal-card flex flex-col gap-6 w-full max-w-md mx-auto transform -rotate-1 mt-6 md:mt-0">
        <div class="text-center mb-2 transform rotate-1">
            <h1 class="text-4xl font-bold tracking-tighter mb-2 text-black">
                Masuk <span class="text-[#FFD1E3] text-outline">HonuSign</span>
            </h1>
            <p class="text-lg font-medium text-slate-600">Selamat datang kembali! Yuk lanjut belajar.</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-4 transform rotate-1">
            @csrf

            <!-- Email Address -->
            <div>
                <label class="block text-lg font-bold text-black mb-1">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    autocomplete="email" placeholder="email@contoh.com" class="w-full px-4 py-3">
            </div>

            <!-- Password -->
            <div class="relative">
                <div class="flex justify-between items-center mb-1">
                    <label class="block text-lg font-bold text-black">Password</label>
                    <!-- @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                            class="text-sm font-bold text-blue-600 hover:text-blue-800 hover:underline decoration-2 underline-offset-2"
                            wire:navigate>
                            Lupa password?
                        </a>
                    @endif -->
                </div>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                    placeholder="Masukkan password" class="w-full px-4 py-3">
            </div>

            <!-- Remember Me -->
            <label class="flex items-center gap-2 cursor-pointer mt-2">
                <input type="checkbox" name="remember"
                    class="w-5 h-5 border-[3px] border-black rounded shadow-[2px_2px_0px_0px_#000] checked:bg-[#FFD1E3] focus:ring-0 cursor-pointer text-[#FFD1E3]">
                <span class="text-lg font-bold text-black">Ingat saya</span>
            </label>

            <div class="flex items-center justify-end mt-4">
                <button type="submit" class="w-full" data-test="login-button">
                    Masuk Sekarang!
                </button>
            </div>
        </form>

        @if (Route::has('register'))
            <div class="mt-4 text-center transform rotate-1">
                <span class="text-lg font-medium text-slate-600">Belum punya akun?</span>
                <a href="{{ route('register') }}"
                    class="text-lg font-bold text-[#E0BBE4] text-outline hover:text-[#FFF5B8] transition-colors ml-1"
                    wire:navigate>Daftar Disini</a>
            </div>
        @endif
    </div>
</x-layouts::auth>