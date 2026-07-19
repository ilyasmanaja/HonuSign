<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Panel Guru - HonuSign</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <!-- Warna background lebih netral/cerah agar form menonjol -->
    <body class="antialiased bg-slate-100 text-black">
        
        <!-- Navbar Sederhana untuk Guru -->
        <nav class="bg-white border-b-4 border-black p-4">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <span class="font-black uppercase tracking-widest text-lg">Panel Guru</span>
                <a href="{{ route('teacher.dashboard') }}" class="font-bold underline">Kembali ke Dashboard</a>
            </div>
        </nav>

        <main class="py-10">
            {{ $slot }}
        </main>
    </body>
</html>