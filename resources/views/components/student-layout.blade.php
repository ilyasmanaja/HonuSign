<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>HonuSign</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-teal-50 text-white">
        <main class="min-h-screen flex items-center justify-center p-6">
            {{ $slot }}
        </main>
    </body>
</html>