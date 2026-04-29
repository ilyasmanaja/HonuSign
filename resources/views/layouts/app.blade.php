<x-layouts::app.sidebar :title="$title ?? null">
    <flux:main class="bg-white min-h-screen">
        {{ $slot }}
    </flux:main>
</x-layouts::app.sidebar>
