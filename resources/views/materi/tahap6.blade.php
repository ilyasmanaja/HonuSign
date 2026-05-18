<x-student-layout>
    <div class="max-w-8xl w-full px-10 py-12 flex flex-col items-center">

        <!-- Progress Bar (Tahap 6) -->
        <div class="w-full max-w-3xl mb-10">
            <div class="flex justify-between mb-4 items-end">
                <span class="font-black text-xl tracking-widest uppercase text-black">Tahap 6: Ekspresi &amp; Mewarnai</span>
                <span
                    class="text-xl font-black text-black bg-[#D4F1BE] brutal-border px-4 py-1 rounded-2xl transform rotate-2 shadow-[2px_2px_0_#000]">Misi
                    Terakhir! 🏆</span>
            </div>
            <div class="w-full h-8 bg-white brutal-border brutal-shadow-sm rounded-2xl overflow-hidden p-1">
                <div class="h-full bg-[#D4F1BE] rounded-xl transition-all duration-1000 border-r-4 border-black"
                    style="width: 100%"></div>
            </div>
        </div>

        <h1 id="main-title" class="text-4xl md:text-5xl font-black text-black uppercase tracking-tighter mb-4 text-center transform -rotate-1">
            Warnai Gambarmu! 🎨
        </h1>
        <p id="sub-title" class="text-lg font-bold text-slate-500 bg-[#FFFEFA] brutal-border brutal-shadow-sm px-6 py-2 rounded-2xl mb-10 text-center">Gunakan kuas di bawah untuk memberi warna pada gambar ini.</p>

        <div class="flex flex-col lg:flex-row gap-8 w-full items-start justify-center">
            <div id="toolbar"
                class="bg-[#FFFEFA] brutal-border brutal-shadow-sm p-6 rounded-[2.5rem] flex lg:flex-col gap-4 w-full lg:w-auto overflow-x-auto">
                @php
                    $colors = [
                        ['bg-red-400', '#ef4444'],
                        ['bg-blue-400', '#3b82f6'],
                        ['bg-green-400', '#22c55e'],
                        ['bg-yellow-400', '#facc15'],
                        ['bg-purple-400', '#a855f7'],
                        ['bg-pink-400', '#ec4899'],
                        ['bg-orange-400', '#f97316'],
                        ['bg-black', '#000000']
                    ];
                @endphp

                @foreach($colors as $color)
                    <button onclick="changeColor('{{ $color[1] }}')" title="Warna"
                        class="w-10 h-10 flex-shrink-0 rounded-full {{ $color[0] }} brutal-border hover:scale-125 transition-all"></button>
                @endforeach

                <hr class="hidden lg:block border-black/20 my-2">

                <button onclick="useEraser()"
                    class="bg-[#FFF5B8] brutal-border brutal-shadow-sm p-3 rounded-2xl hover:scale-110 transition-all"
                    title="Hapus">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-black" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </button>
            </div>

            <div class="relative bg-[#FFFEFA] brutal-border brutal-shadow rounded-[2.5rem] overflow-hidden cursor-crosshair w-full flex justify-center items-center transition-all duration-500 ease-in-out"
                id="canvas-container">
                <img id="coloring-image" src="{{ asset('images/mewarnai.png') }}"
                    class="absolute inset-0 w-full h-full object-contain pointer-events-none p-6 z-0" alt="Mewarnai">
                <canvas id="coloringCanvas" class="relative z-10 w-full h-full"></canvas>
            </div>
        </div>

        <div class="mt-10 flex flex-wrap justify-center gap-4 w-full max-w-7xl">
            <button id="clear-btn" onclick="clearCanvas()"
                class="px-8 py-4 rounded-2xl font-bold text-black bg-[#FFFEFA] brutal-border brutal-shadow-sm brutal-hover uppercase text-sm tracking-wider cursor-pointer">
                Hapus Semua
            </button>

            <button id="show-result-btn" onclick="enablePresentationMode()"
                class="bg-[#D4F1BE] brutal-border brutal-shadow brutal-hover cursor-pointer text-black px-12 py-4 rounded-3xl font-black uppercase text-lg flex items-center gap-2">
                Tampilkan Hasil! ✨
            </button>

            <button id="back-edit-btn" onclick="disablePresentationMode()"
                class="hidden px-8 py-4 cursor-pointer rounded-2xl font-bold text-black bg-[#FFF5B8] brutal-border brutal-shadow-sm brutal-hover uppercase text-sm tracking-wider">
                Kembali Edit
            </button>

            <a href="{{ route('dashboard') }}" id="final-dashboard-btn" onclick="finishGame(event, this.href)"
                class="hidden bg-[#FFD1E3] brutal-border brutal-shadow brutal-hover text-black px-12 py-4 rounded-3xl font-black uppercase text-lg flex items-center gap-2">
                Selesai &amp; Ke Dashboard 🏆
            </a>
        </div>
    </div>

    <script>
        const canvas = document.getElementById('coloringCanvas');
        const ctx = canvas.getContext('2d');
        const container = document.getElementById('canvas-container');
        
        let painting = false;
        let color = '#ef4444';
        let brushSize = 12; // Ukuran kuas sedikit diperbesar menyesuaikan canvas besar

        function initCanvas() {
            // Biarkan CSS menangani lebar, JS menangani tinggi berdasarkan aspect ratio
            canvas.width = container.offsetWidth;
            canvas.height = container.offsetWidth * 0.50; // Sedikit lebih ceper agar tidak terlalu panjang ke bawah
            ctx.lineCap = 'round';
            ctx.lineJoin = 'round';
            ctx.globalCompositeOperation = 'multiply';
        }

        // Paksa reload canvas saat window di resize agar ukuran tetap sinkron
        window.addEventListener('load', initCanvas);
        window.addEventListener('resize', initCanvas);

        function startPosition(e) { painting = true; draw(e); }
        function finishedPosition() { painting = false; ctx.beginPath(); }

        function draw(e) {
            if (!painting) return;
            const rect = canvas.getBoundingClientRect();
            // Penyesuaian koordinat touch/mouse yang lebih akurat untuk canvas besar
            const x = ((e.clientX || (e.touches && e.touches[0].clientX)) - rect.left) * (canvas.width / rect.width);
            const y = ((e.clientY || (e.touches && e.touches[0].clientY)) - rect.top) * (canvas.height / rect.height);

            ctx.lineWidth = brushSize;
            ctx.strokeStyle = color;
            ctx.lineTo(x, y);
            ctx.stroke();
            ctx.beginPath();
            ctx.moveTo(x, y);
        }

        canvas.addEventListener('mousedown', startPosition);
        canvas.addEventListener('mouseup', finishedPosition);
        canvas.addEventListener('mousemove', draw);
        canvas.addEventListener('touchstart', (e) => { e.preventDefault(); startPosition(e); });
        canvas.addEventListener('touchend', finishedPosition);
        canvas.addEventListener('touchmove', (e) => { e.preventDefault(); draw(e); });

        function changeColor(newColor) {
            color = newColor;
            ctx.globalCompositeOperation = 'multiply';
            brushSize = 12; // Ukuran kuas normal
        }

        function useEraser() {
            ctx.globalCompositeOperation = 'destination-out';
            brushSize = 40; // Penghapus lebih besar
        }

        function clearCanvas() { ctx.clearRect(0, 0, canvas.width, canvas.height); }

        function enablePresentationMode() {
            document.getElementById('toolbar').classList.add('hidden');
            document.getElementById('clear-btn').classList.add('hidden');
            document.getElementById('show-result-btn').classList.add('hidden');
            document.getElementById('sub-title').classList.add('hidden');
            document.getElementById('back-edit-btn').classList.remove('hidden');
            document.getElementById('final-dashboard-btn').classList.remove('hidden');
            document.getElementById('main-title').innerText = "Karya Indahku! ✨";
            canvas.style.pointerEvents = 'none';
            container.classList.remove('border-white');
            // PERUBAHAN 2: Scale dinaikkan jadi 110% agar lebih nge-zoom saat presentasi
            container.classList.add('border-emerald-400'); 
            alert("Mode Presentasi Aktif! Ayo ceritakan gambarmu! 🎤");
        }

        function disablePresentationMode() {
            document.getElementById('toolbar').classList.remove('hidden');
            document.getElementById('clear-btn').classList.remove('hidden');
            document.getElementById('show-result-btn').classList.remove('hidden');
            document.getElementById('sub-title').classList.remove('hidden');
            document.getElementById('back-edit-btn').classList.add('hidden');
            document.getElementById('final-dashboard-btn').classList.add('hidden');
            document.getElementById('main-title').innerText = "Warnai Gambarmu! 🎨";
            canvas.style.pointerEvents = 'auto';
            container.classList.add('border-white');
            container.classList.remove('border-emerald-400', 'scale-110');
        }

        function finishGame(event, nextUrl) {
            event.preventDefault();
            fetch('{{ route('materi.save_progress') }}', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: JSON.stringify({ materi_id: {{ $materi->id ?? 1 }}, tahap: 6, score: 0 })
            }).then(() => { window.location.href = nextUrl; });
        }
    </script>
</x-student-layout>