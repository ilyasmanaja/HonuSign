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

        <div class="mt-10 flex flex-wrap justify-center gap-6 w-full max-w-7xl">
            <!-- Hapus Semua -->
            <button id="clear-btn" onclick="clearCanvas()"
                class="w-20 h-20 flex items-center justify-center rounded-full font-bold text-black bg-[#FFFEFA] brutal-border brutal-shadow-sm brutal-hover cursor-pointer transform hover:-translate-y-2 transition-transform"
                title="Hapus Semua">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10">
                    <path opacity="0.2" d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12z" fill="currentColor" />
                    <path d="M19 4h-3.5l-1-1h-5l-1 1H5v2h14V4zM6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zm2-9h8v9H8v-9z" fill="currentColor" />
                </svg>
            </button>

            <!-- Tampilkan Hasil! -->
            <button id="show-result-btn" onclick="enablePresentationMode()"
                class="bg-[#D4F1BE] brutal-border brutal-shadow brutal-hover cursor-pointer text-black w-20 h-20 flex items-center justify-center rounded-full transform hover:-translate-y-2 transition-transform"
                title="Tampilkan Hasil">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-12 h-12 text-black">
                    <circle cx="12" cy="12" r="10" opacity="0.2" fill="currentColor" />
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" fill="currentColor" />
                </svg>
            </button>

            <!-- Kembali Edit -->
            <button id="back-edit-btn" onclick="disablePresentationMode()"
                class="hidden w-20 h-20 flex items-center justify-center rounded-full cursor-pointer font-bold text-black bg-[#FFF5B8] brutal-border brutal-shadow-sm brutal-hover transform hover:-translate-y-2 transition-transform"
                title="Kembali Edit">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10">
                    <path opacity="0.2" d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25z" fill="currentColor" />
                    <path d="M20.71 7.04a1 1 0 0 0 0-1.41l-2.34-2.34a1 1 0 0 0-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83zM3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM5.92 19H5v-.92l9.06-9.06.92.92L5.92 19z" fill="currentColor" />
                </svg>
            </button>

            <!-- Selesai & Ke Dashboard -->
            <a href="{{ route('dashboard') }}" id="final-dashboard-btn" onclick="finishGame(event, this.href)"
                class="hidden bg-[#FFD1E3] brutal-border brutal-shadow brutal-hover text-black w-20 h-20 flex items-center justify-center rounded-full transform hover:-translate-y-2 transition-transform"
                title="Selesai &amp; Ke Dashboard">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-12 h-12">
                    <path opacity="0.2" d="M19 5h-2V3H7v2H5c-1.1 0-2 .9-2 2v1c0 2.55 1.92 4.63 4.39 4.94A5.01 5.01 0 0 0 11 15.9V19H7v2h10v-2h-4v-3.1a5.01 5.01 0 0 0 3.61-2.96C19.08 12.63 21 10.55 21 8V7c0-1.1-.9-2-2-2zM5 8V7h2v3.82C5.84 10.4 5 9.3 5 8zm14 0c0 1.3-.84 2.4-2 2.82V7h2v1z" fill="currentColor" />
                    <path d="M19 5h-2V3H7v2H5c-1.1 0-2 .9-2 2v1c0 2.55 1.92 4.63 4.39 4.94A5.01 5.01 0 0 0 11 15.9V19H7v2h10v-2h-4v-3.1a5.01 5.01 0 0 0 3.61-2.96C19.08 12.63 21 10.55 21 8V7c0-1.1-.9-2-2-2zm-2 5.82A2.99 2.99 0 0 1 12 14a2.99 2.99 0 0 1-5-3.18V7h10v3.82zM5 8V7h2v3.82C5.84 10.4 5 9.3 5 8zm14 0c0 1.3-.84 2.4-2 2.82V7h2v1z" fill="currentColor" />
                </svg>
            </a>
        </div>
    </div>

    <!-- Modal Sukses Kustom -->
    <div id="success-modal"
        class="fixed inset-0 z-[9999] bg-slate-900/60 backdrop-blur-sm hidden flex-col items-center justify-center opacity-0 transition-all duration-300">
        <div class="bg-[#BEE9E8] p-8 md:p-12 rounded-[3rem] brutal-border brutal-shadow flex flex-col items-center max-w-lg mx-4 transform scale-90 transition-transform duration-500 relative"
            id="success-modal-content">
            <button onclick="closeSuccessModal()"
                class="absolute top-4 right-4 bg-white brutal-border brutal-shadow-sm w-12 h-12 rounded-full flex items-center justify-center hover:bg-[#FFB3B3] hover:text-black transition-all transform hover:rotate-90 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z" fill="currentColor" />
                </svg>
            </button>

            <!-- Standardized Indonesian congrats + Smiling Face and Thumbs Up Duotone Icons -->
            <div class="flex items-center justify-center gap-6 mb-6">
                <!-- Smiling Face Icon -->
                <div class="p-4 bg-[#FFF5B8] brutal-border brutal-shadow-sm rounded-2xl animate-bounce" style="animation-delay: 0.1s">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-16 h-16 text-black">
                        <circle cx="12" cy="12" r="10" opacity="0.2" fill="currentColor" />
                        <circle cx="9" cy="9.5" r="1.5" fill="currentColor" />
                        <circle cx="15" cy="9.5" r="1.5" fill="currentColor" />
                        <path d="M12 18c2.28 0 4.22-1.24 5-3H7c.78 1.76 2.72 3 5 3z" fill="currentColor" />
                    </svg>
                </div>
                <!-- Thumbs Up Icon -->
                <div class="p-4 bg-[#D4F1BE] brutal-border brutal-shadow-sm rounded-2xl animate-bounce" style="animation-delay: 0.3s">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-16 h-16 text-black">
                        <path opacity="0.2" d="M21 10a2 2 0 0 0-2-2h-5.07l.76-3.65c.18-.89-.17-1.81-.9-2.35L13 2H9v11h4l1.63 5.48c.32 1.07 1.3 1.8 2.42 1.8h.07a2 2 0 0 0 1.94-1.51L21 10z" />
                        <path d="M4 11h3v10H4a1 1 0 0 1-1-1v-8a1 1 0 0 1 1-1zm15-3h-5.07l.76-3.65A2.39 2.39 0 0 0 13.8 2H9v11h4l1.63 5.48A2.5 2.5 0 0 0 17 20h.07a2 2 0 0 0 1.94-1.51L21 10a2 2 0 0 0-2-2zM9 11v8h8.07l-1.63-5.48L13.8 8H19l-2 10H9v-7z" fill="currentColor" />
                    </svg>
                </div>
            </div>

            <h2 class="text-4xl md:text-5xl font-black text-white text-outline uppercase tracking-tighter text-center mb-2 transform -rotate-2 drop-shadow-[0_4px_0_#000]"
                id="modal-title">
                SELAMAT!
            </h2>
            <p class="text-xl md:text-2xl font-bold text-slate-800 text-center mb-10 bg-[#FFF5B8] px-4 py-2 rounded-xl brutal-border"
                id="modal-desc">
                Hasil karyamu sangat indah!
            </p>

            <!-- Visual-only close/check button in success modal -->
            <button onclick="closeSuccessModal()"
                class="bg-[#D4F1BE] text-black w-24 h-24 flex items-center justify-center rounded-full brutal-border brutal-shadow-sm brutal-hover transform hover:-translate-y-2 transition-all cursor-pointer"
                title="Lanjut">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-14 h-14">
                    <circle cx="12" cy="12" r="10" opacity="0.2" fill="currentColor" />
                    <path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z" fill="currentColor" />
                </svg>
            </button>
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

        function showSuccessModal() {
            const modal = document.getElementById('success-modal');
            const content = document.getElementById('success-modal-content');

            modal.classList.remove('hidden');
            modal.classList.add('flex');

            // Trigger reflow untuk animasi transisi
            void modal.offsetWidth;

            modal.classList.remove('opacity-0');
            content.classList.remove('scale-90');
            content.classList.add('scale-100');
        }

        function closeSuccessModal() {
            const modal = document.getElementById('success-modal');
            const content = document.getElementById('success-modal-content');

            modal.classList.add('opacity-0');
            content.classList.remove('scale-100');
            content.classList.add('scale-90');

            setTimeout(() => {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
            }, 300);
        }

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
            container.classList.add('border-emerald-400', 'scale-110');
            showSuccessModal();
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