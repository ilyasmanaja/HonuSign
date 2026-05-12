<x-layouts::auth :title="__('Register')">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Fredoka:wght@400;500;600;700&display=swap');

        body {
            font-family: 'Fredoka', sans-serif !important;
            background-color: #FFD1E3 !important;
            /* Pink Lembut Pastel */
        }

        /* Override dark mode bg from layout */
        .dark body {
            background-color: #FFD1E3 !important;
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
            background-color: #FFF5B8 !important;
            /* Kuning Cerah */
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
            background-color: #D4F1BE !important;
            /* Hijau Mint */
        }

        button[type="submit"]:active {
            transform: translate(2px, 2px) !important;
            box-shadow: 2px 2px 0px 0px #000 !important;
        }

        .text-outline {
            text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000, 2px 2px 0 #000;
        }
    </style>

    <div class="brutal-card flex flex-col gap-6 w-full max-w-md mx-auto transform rotate-1 mt-6 md:mt-0">
        <div class="text-center mb-2 transform -rotate-1">
            <h1 class="text-4xl font-bold tracking-tighter mb-2 text-black">
                Daftar <span class="text-[#BEE9E8] text-outline">HonuSign</span>
            </h1>
            <p class="text-lg font-medium text-slate-600">Buat akun barumu dan mulai petualangan belajar!</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('register.store') }}" class="flex flex-col gap-4 transform -rotate-1">
            @csrf

            <!-- Name -->
            <div>
                <label class="block text-lg font-bold text-black mb-1">Nama Lengkap</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                    autocomplete="name" placeholder="Nama Lengkapmu" class="w-full px-4 py-3">
            </div>

            <!-- Email Address -->
            <div>
                <label class="block text-lg font-bold text-black mb-1">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                    placeholder="email@contoh.com" class="w-full px-4 py-3">
            </div>

            <!-- Password -->
            <div>
                <label class="block text-lg font-bold text-black mb-1">Password</label>
                <input id="password" type="password" name="password" required autocomplete="new-password"
                    placeholder="Buat password" class="w-full px-4 py-3">
            </div>

            <!-- Confirm Password -->
            <div>
                <label class="block text-lg font-bold text-black mb-1">Konfirmasi Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                    autocomplete="new-password" placeholder="Ulangi password" class="w-full px-4 py-3">
            </div>

            <div class="flex items-center justify-end mt-4">
                <button type="submit" class="w-full" data-test="register-user-button">
                    Buat Akun Sekarang!
                </button>
            </div>
        </form>

        <div class="mt-4 text-center transform -rotate-1">
            <span class="text-lg font-medium text-slate-600">Sudah punya akun?</span>
            <a href="{{ route('login') }}"
                class="text-lg font-bold text-[#E0BBE4] text-outline hover:text-[#FFF5B8] transition-colors ml-1"
                wire:navigate>Masuk Disini</a>
        </div>
    </div>
</x-layouts::auth>