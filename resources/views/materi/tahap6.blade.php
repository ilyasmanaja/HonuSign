<x-student-layout>
    <div class="max-w-8xl w-full px-10 py-12 flex flex-col items-center">

        <!-- Progress Bar -->
        <div class="w-full max-w-3xl mb-10">
            <div class="flex justify-between mb-4 items-end">
                <span class="font-black text-xl tracking-widest uppercase text-black">Ekspresi &amp; Mewarnai</span>
            </div>
            <div class="w-full h-8 bg-white brutal-border brutal-shadow-sm rounded-2xl overflow-hidden p-1">
                <div class="h-full bg-[#D4F1BE] rounded-xl transition-all duration-1000 border-r-4 border-black"
                    style="width: 100%"></div>
            </div>
        </div>

        <h1 id="main-title"
            class="text-4xl md:text-5xl font-black text-black uppercase tracking-tighter mb-4 text-center transform -rotate-1 flex justify-center items-center gap-3">
            Warnai Gambarmu!
            <span class="inline-block w-12 h-12">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="w-full h-full text-black">
                    <path opacity="0.2"
                        d="M12 2C6.49 2 2 6.49 2 12s4.49 10 10 10c1.38 0 2.5-1.12 2.5-2.5 0-.61-.23-1.2-.64-1.67-.08-.09-.13-.21-.13-.33 0-.28.22-.5.5-.5H16c3.31 0 6-2.69 6-6 0-4.96-4.49-9-10-9zM6.5 11.5c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3-4c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm5 0c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3 4c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z" />
                    <path
                        d="M12 2C6.49 2 2 6.49 2 12s4.49 10 10 10c1.38 0 2.5-1.12 2.5-2.5 0-.61-.23-1.2-.64-1.67a.49.49 0 0 1-.13-.33c0-.28.22-.5.5-.5H16c3.31 0 6-2.69 6-6 0-4.96-4.49-9-10-9zm4 13h-1.77c-1.38 0-2.5 1.12-2.5 2.5 0 .61.22 1.19.63 1.65.06.07.14.19.14.35 0 .28-.22.5-.5.5-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.14 8 7c0 2.21-1.79 4-4 4z" />
                    <circle cx="6.5" cy="11.5" r="1.5" />
                    <circle cx="9.5" cy="7.5" r="1.5" />
                    <circle cx="14.5" cy="7.5" r="1.5" />
                    <circle cx="17.5" cy="11.5" r="1.5" />
                </svg>
            </span>
        </h1>
        <p id="sub-title"
            class="text-lg font-bold text-slate-500 bg-[#FFFEFA] brutal-border brutal-shadow-sm px-6 py-2 rounded-2xl mb-10 text-center">
            Gunakan kuas di bawah untuk memberi warna pada gambar ini.</p>

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
                class="px-8 py-4 rounded-[3rem] font-bold text-black bg-[#FFFEFA] brutal-border brutal-shadow-sm brutal-hover uppercase text-sm tracking-wider cursor-pointer">
                Hapus Semua
            </button>

            <button id="show-result-btn" onclick="enablePresentationMode()"
                class="bg-[#D4F1BE] brutal-border brutal-shadow brutal-hover cursor-pointer text-black px-12 py-4 rounded-[3rem] font-black uppercase text-lg flex items-center gap-3">
                Tampilkan Hasil!
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="w-6 h-6 text-black">
                        <path opacity="0.2"
                            d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                        <path
                            d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"
                            stroke="black" stroke-width="2" stroke-linejoin="round" />
                    </svg>
                </span>
            </button>

            <button id="back-edit-btn" onclick="disablePresentationMode()"
                class="hidden px-8 py-4 cursor-pointer rounded-[3rem] font-bold text-black bg-[#FFF5B8] brutal-border brutal-shadow-sm brutal-hover uppercase text-sm tracking-wider">
                Kembali Edit
            </button>

            <a href="{{ route('dashboard') }}" id="final-dashboard-btn" onclick="finishGame(event, this.href)"
                class="hidden bg-[#FFD1E3] brutal-border brutal-shadow brutal-hover text-black px-12 py-4 rounded-[3rem] font-black uppercase text-lg flex items-center gap-3">
                Selesai &amp; Ke Dashboard
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="w-6 h-6 text-black">
                        <path opacity="0.2"
                            d="M19 5h-2V3H7v2H5c-1.1 0-2 .9-2 2v1c0 2.55 1.92 4.63 4.39 4.94A5.01 5.01 0 0 0 11 15.9V19H7v2h10v-2h-4v-3.1a5.01 5.01 0 0 0 3.61-2.96C19.08 12.63 21 10.55 21 8V7c0-1.1-.9-2-2-2zM5 8V7h2v3.82C5.84 10.4 5 9.3 5 8zm14 0c0 1.3-.84 2.4-2 2.82V7h2v1z" />
                        <path
                            d="M19 5h-2V3H7v2H5c-1.1 0-2 .9-2 2v1c0 2.55 1.92 4.63 4.39 4.94A5.01 5.01 0 0 0 11 15.9V19H7v2h10v-2h-4v-3.1a5.01 5.01 0 0 0 3.61-2.96C19.08 12.63 21 10.55 21 8V7c0-1.1-.9-2-2-2zm-2 5.82A2.99 2.99 0 0 1 12 14a2.99 2.99 0 0 1-5-3.18V7h10v3.82zM5 8V7h2v3.82C5.84 10.4 5 9.3 5 8zm14 0c0 1.3-.84 2.4-2 2.82V7h2v1z" />
                    </svg>
                </span>
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
            document.getElementById('main-title').innerHTML = `Karya Indahku! 
            <span class="inline-block w-12 h-12">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-full h-full text-black">
                    <path opacity="0.2" d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" stroke="black" stroke-width="2" stroke-linejoin="round" />
                </svg>
            </span>`;
            canvas.style.pointerEvents = 'none';
            container.classList.remove('border-white');
            // PERUBAHAN 2: Scale dinaikkan jadi 110% agar lebih nge-zoom saat presentasi
            container.classList.add('border-emerald-400');
            alert("Mode Presentasi Aktif! Ayo ceritakan gambarmu!");
        }

        function disablePresentationMode() {
            document.getElementById('toolbar').classList.remove('hidden');
            document.getElementById('clear-btn').classList.remove('hidden');
            document.getElementById('show-result-btn').classList.remove('hidden');
            document.getElementById('sub-title').classList.remove('hidden');
            document.getElementById('back-edit-btn').classList.add('hidden');
            document.getElementById('final-dashboard-btn').classList.add('hidden');
            document.getElementById('main-title').innerHTML = `Warnai Gambarmu!
            <span class="inline-block w-12 h-12">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-full h-full text-black">
                    <path opacity="0.2" d="M12 2C6.49 2 2 6.49 2 12s4.49 10 10 10c1.38 0 2.5-1.12 2.5-2.5 0-.61-.23-1.2-.64-1.67-.08-.09-.13-.21-.13-.33 0-.28.22-.5.5-.5H16c3.31 0 6-2.69 6-6 0-4.96-4.49-9-10-9zM6.5 11.5c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3-4c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm5 0c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3 4c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z" />
                    <path d="M12 2C6.49 2 2 6.49 2 12s4.49 10 10 10c1.38 0 2.5-1.12 2.5-2.5 0-.61-.23-1.2-.64-1.67a.49.49 0 0 1-.13-.33c0-.28.22-.5.5-.5H16c3.31 0 6-2.69 6-6 0-4.96-4.49-9-10-9zm4 13h-1.77c-1.38 0-2.5 1.12-2.5 2.5 0 .61.22 1.19.63 1.65.06.07.14.19.14.35 0 .28-.22.5-.5.5-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.14 8 7c0 2.21-1.79 4-4 4z" />
                    <circle cx="6.5" cy="11.5" r="1.5" />
                    <circle cx="9.5" cy="7.5" r="1.5" />
                    <circle cx="14.5" cy="7.5" r="1.5" />
                    <circle cx="17.5" cy="11.5" r="1.5" />
                </svg>
            </span>`;
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