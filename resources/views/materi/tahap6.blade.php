<x-student-layout>
    <div class="max-w-8xl w-full px-10 py-12 flex flex-col items-center">
        
        <div class="w-full max-w-7xl mb-10">
            <div class="flex justify-between mb-2">
                <span class="text-xs font-black text-pink-600 uppercase tracking-widest">Tahap 6: Ekspresi & Mewarnai</span>
                <span class="text-xs font-black text-slate-400 uppercase tracking-widest">Misi Terakhir! 🏆</span>
            </div>
            <div class="w-full bg-slate-200 dark:bg-slate-800 h-3 rounded-full overflow-hidden border-2 border-white">
                <div class="bg-pink-500 h-full w-full transition-all duration-1000"></div>
            </div>
        </div>

        <h1 id="main-title" class="text-4xl font-black text-slate-800 dark:text-white uppercase mb-4 text-center tracking-tighter">Warnai Gambarmu! 🎨</h1>
        <p id="sub-title" class="text-lg text-slate-500 mb-10 text-center">Gunakan kuas di bawah untuk memberi warna pada gambar ini.</p>

        <div class="flex flex-col lg:flex-row gap-8 w-full items-start justify-center">
            <div id="toolbar" class="bg-white dark:bg-slate-900 p-8 rounded-[2.5rem] border-4 border-slate-200 flex lg:flex-col gap-5 w-full lg:w-auto overflow-x-auto shadow-lg">
                @php
                    $colors = [['bg-red-500', '#ef4444'], ['bg-blue-500', '#3b82f6'], ['bg-green-500', '#22c55e'], ['bg-yellow-400', '#facc15'], ['bg-purple-500', '#a855f7'], ['bg-pink-500', '#ec4899'], ['bg-orange-500', '#f97316'], ['bg-black', '#000000']];
                @endphp

                @foreach($colors as $color)
                    <button onclick="changeColor('{{ $color[1] }}')" class="w-12 h-12 flex-shrink-0 rounded-full {{ $color[0] }} border-4 border-white shadow-lg hover:scale-110 transition-all"></button>
                @endforeach

                <hr class="hidden lg:block border-slate-200 my-3">

                <button onclick="useEraser()" class="bg-slate-100 p-3 rounded-2xl border-2 border-slate-300 hover:bg-white transition-all shadow" title="Hapus">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </button>
            </div>

            <div class="relative bg-white rounded-[3rem] border-8 border-white shadow-2xl overflow-hidden cursor-crosshair w-full flex justify-center items-center transition-all duration-500 ease-in-out" id="canvas-container">
                <img id="coloring-image" src="{{ asset('images/mewarnai.png') }}" class="absolute inset-0 w-full h-full object-contain pointer-events-none p-6 z-0" alt="Mewarnai">
                <canvas id="coloringCanvas" class="relative z-10 w-full h-full"></canvas>
            </div>
        </div>

        <div class="mt-14 flex flex-wrap justify-center gap-5 w-full max-w-7xl">
            <button id="clear-btn" onclick="clearCanvas()" class="px-10 py-5 rounded-2xl font-bold text-slate-500 bg-slate-100 hover:bg-slate-200 transition-all uppercase text-sm tracking-wider">Hapus Semua</button>
            
            <button id="show-result-btn" onclick="enablePresentationMode()" class="bg-emerald-600 text-white px-14 py-5 rounded-3xl font-black uppercase shadow-[0_10px_0_0_#059669] hover:translate-y-1 active:shadow-none transition-all text-lg flex items-center gap-2">
                Tampilkan Hasil! ✨
            </button>

            <button id="back-edit-btn" onclick="disablePresentationMode()" class="hidden px-10 py-5 rounded-2xl font-bold text-slate-500 bg-slate-100 hover:bg-slate-200 transition-all uppercase text-sm tracking-wider">
                Kembali Edit
            </button>
            
            <a href="{{ route('dashboard') }}" id="final-dashboard-btn" onclick="finishGame(event, this.href)" class="hidden bg-pink-600 text-white px-14 py-5 rounded-3xl font-black uppercase shadow-[0_10px_0_0_#be185d] hover:translate-y-1 active:shadow-none transition-all text-lg flex items-center gap-2">
                Selesai & Ke Dashboard 🏆
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
                body: JSON.stringify({ materi_id: {{ $materi->id ?? 1 }}, tahap: 6, score: 100 })
            }).then(() => { window.location.href = nextUrl; });
        }
    </script>
</x-student-layout>