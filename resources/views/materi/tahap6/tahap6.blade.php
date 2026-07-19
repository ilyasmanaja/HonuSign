<x-student-layout>
    <style>
        /* Custom range slider styling */
        #brush-size-slider {
            -webkit-appearance: none;
            appearance: none;
            background: transparent;
        }
        #brush-size-slider::-webkit-slider-runnable-track {
            background: #f1f5f9;
            height: 12px;
            border-radius: 6px;
            border: 2px solid #000;
        }
        #brush-size-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            background: #FFF5B8;
            border: 3px solid #000;
            width: 24px;
            height: 24px;
            border-radius: 12px;
            cursor: pointer;
            margin-top: -6px; /* Center the thumb vertically */
            box-shadow: 2px 2px 0px #000;
            transition: transform 0.1s ease;
        }
        #brush-size-slider::-webkit-slider-thumb:hover {
            transform: scale(1.1);
        }
        #brush-size-slider::-moz-range-track {
            background: #f1f5f9;
            height: 12px;
            border-radius: 6px;
            border: 2px solid #000;
        }
        #brush-size-slider::-moz-range-thumb {
            background: #FFF5B8;
            border: 3px solid #000;
            width: 24px;
            height: 24px;
            border-radius: 12px;
            cursor: pointer;
            box-shadow: 2px 2px 0px #000;
            transition: transform 0.1s ease;
        }
        #brush-size-slider::-moz-range-thumb:hover {
            transform: scale(1.1);
        }
        #toolbar {
            max-height: 90vh;
            overflow-y: auto;
            scrollbar-width: none; /* Firefox */
        }
        #toolbar::-webkit-scrollbar {
            display: none; /* Chrome, Safari and Opera */
        }
    </style>

    @php
        // Ambil sketsa gambar mewarnai dari tabel materi_images (tipe => 'sketsa_mewarnai')
        $sketsa = $materi->images->where('tipe', 'sketsa_mewarnai')->first();
        $namaFileSketsa = $sketsa ? $sketsa->path : 'mewarnai.png';

        // Definisikan path asset dinamis lengkap
        $imageAssetPath = asset('images/' . $namaFileSketsa);
    @endphp

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
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-full h-full text-black">
                    <path opacity="0.2" d="M12 2C6.49 2 2 6.49 2 12s4.49 10 10 10c1.38 0 2.5-1.12 2.5-2.5 0-.61-.23-1.2-.64-1.67-.08-.09-.13-.21-.13-.33 0-.28.22-.5.5-.5H16c3.31 0 6-2.69 6-6 0-4.96-4.49-9-10-9zM6.5 11.5c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3-4c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm5 0c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3 4c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z" />
                    <path d="M12 2C6.49 2 2 6.49 2 12s4.49 10 10 10c1.38 0 2.5-1.12 2.5-2.5 0-.61-.23-1.2-.64-1.67a.49.49 0 0 1-.13-.33c0-.28.22-.5.5-.5H16c3.31 0 6-2.69 6-6 0-4.96-4.49-9-10-9zm4 13h-1.77c-1.38 0-2.5 1.12-2.5 2.5 0 .61.22 1.19.63 1.65.06.07.14.19.14.35 0 .28-.22.5-.5.5-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.14 8 7c0 2.21-1.79 4-4 4z" />
                    <circle cx="6.5" cy="11.5" r="1.5" />
                    <circle cx="9.5" cy="7.5" r="1.5" />
                    <circle cx="14.5" cy="7.5" r="1.5" />
                    <circle cx="17.5" cy="11.5" r="1.5" />
                </svg>
            </span>
        </h1>

        <!-- Sidebar Toolbar -->
        <div id="toolbar"
            class="fixed left-0 top-20 bottom-20 bg-[#FFFEFA] brutal-border brutal-shadow p-6 rounded-r-[2.5rem] flex flex-col gap-6 w-72 z-50 transition-all duration-300 ease-in-out"
            style="transform: translateX(0);">
            
            <div class="absolute -right-12 top-1/2 -translate-y-1/2 group/tooltip inline-block z-50">
                <button id="toolbar-toggle" onclick="toggleToolbar()"
                    class="bg-[#FFF5B8] brutal-border brutal-shadow w-12 h-20 rounded-r-2xl flex items-center justify-center cursor-pointer hover:scale-105 transition-all">
                    <svg id="toggle-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 text-black transition-transform duration-300">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </button>
                <div class="pointer-events-none absolute bottom-full left-1/2 -translate-x-1/2 mb-3 bg-[#FFD1E3] brutal-border brutal-shadow-sm px-3 py-1.5 rounded-lg text-sm font-bold opacity-0 scale-95 group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-150 whitespace-nowrap z-50 text-black">
                    Buka/Tutup Alat
                </div>
            </div>
            
            <!-- Section 1: Alat Mewarnai -->
            <div>
                <h3 class="font-black text-black uppercase text-sm tracking-wider mb-3">Pilih Alat:</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div class="relative group/tooltip inline-block w-full">
                        <button onclick="selectTool('pencil')" id="btn-tool-pencil"
                            class="bg-[#FFF5B8] brutal-border brutal-shadow-sm p-3 rounded-2xl flex items-center justify-center cursor-pointer transition-all hover:scale-105 active:translate-y-1 w-full">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-8 h-8 text-black fill-none stroke-current" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 20h9"></path>
                                <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                            </svg>
                        </button>
                        <div class="pointer-events-none absolute bottom-full left-1/2 -translate-x-1/2 mb-3 bg-[#FFD1E3] brutal-border brutal-shadow-sm px-3 py-1.5 rounded-lg text-sm font-bold opacity-0 scale-95 group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-150 whitespace-nowrap z-50 text-black">
                            Pensil
                        </div>
                    </div>
                    <div class="relative group/tooltip inline-block w-full">
                        <button onclick="selectTool('eraser')" id="btn-tool-eraser"
                            class="bg-[#FFFEFA] brutal-border brutal-shadow-sm p-3 rounded-2xl flex items-center justify-center cursor-pointer transition-all hover:scale-105 active:translate-y-1 w-full">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-8 h-8 text-black fill-none stroke-current" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 20H7L3 16c-1.5-1.5-1.5-3.5 0-5l8.5-8.5c1.5-1.5 3.5-1.5 5 0l4 4c1.5 1.5 1.5 3.5 0 5L12 20"></path>
                                <path d="M6 11h10"></path>
                            </svg>
                        </button>
                        <div class="pointer-events-none absolute bottom-full left-1/2 -translate-x-1/2 mb-3 bg-[#FFD1E3] brutal-border brutal-shadow-sm px-3 py-1.5 rounded-lg text-sm font-bold opacity-0 scale-95 group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-150 whitespace-nowrap z-50 text-black">
                            Penghapus
                        </div>
                    </div>
                </div>
            </div>

            <hr class="border-black/20">

            <!-- Section 1.5: Ukuran Kuas -->
            <div>
                <div class="flex justify-between items-center mb-2">
                    <h3 class="font-black text-black uppercase text-sm tracking-wider">Ukuran Kuas:</h3>
                    <div class="w-14 h-14 bg-white brutal-border rounded-xl flex items-center justify-center overflow-hidden shrink-0" title="Pratinjau Ukuran">
                        <div id="brush-size-preview" class="rounded-full transition-all duration-75 border border-black/30" style="width: 12px; height: 12px; background-color: #ef4444;"></div>
                    </div>
                </div>
                <input type="range" id="brush-size-slider" min="4" max="50" value="12" oninput="updateBrushSize(this.value)" class="w-full h-8 cursor-pointer outline-none">
            </div>

            <hr class="border-black/20">

            <!-- Section 2: Pilihan Warna -->
            <div>
                <div class="flex justify-between items-center mb-3">
                    <h3 class="font-black text-black uppercase text-sm tracking-wider">Pilihan Warna:</h3>
                    <div id="selected-color-indicator" class="w-6 h-6 rounded-full brutal-border bg-[#ef4444]"></div>
                </div>
                <div class="grid grid-cols-4 gap-3">
                    @php
                        $colors = [
                            ['bg-[#ef4444]', '#ef4444', 'Merah'], ['bg-[#FFB3B3]', '#FFB3B3', 'Merah Muda Pucat'],
                            ['bg-[#f97316]', '#f97316', 'Jingga'], ['bg-[#FFD8A8]', '#FFD8A8', 'Krem Jingga'],
                            ['bg-[#facc15]', '#facc15', 'Kuning'], ['bg-[#FFF5B8]', '#FFF5B8', 'Kuning Lembut'],
                            ['bg-[#22c55e]', '#22c55e', 'Hijau'], ['bg-[#D4F1BE]', '#D4F1BE', 'Hijau Mint'],
                            ['bg-[#3b82f6]', '#3b82f6', 'Biru'], ['bg-[#BEE9E8]', '#BEE9E8', 'Biru Lembut'],
                            ['bg-[#8b5cf6]', '#8b5cf6', 'Ungu'], ['bg-[#E0BBE4]', '#E0BBE4', 'Ungu Muda'],
                            ['bg-[#ec4899]', '#ec4899', 'Merah Muda'], ['bg-[#FFD1E3]', '#FFD1E3', 'Pink Lembut'],
                            ['bg-[#000000]', '#000000', 'Hitam'], ['bg-[#ffffff]', '#ffffff', 'Putih']
                        ];
                    @endphp
                    @foreach($colors as $color)
                        <button onclick="changeColor('{{ $color[1] }}')" title="{{ $color[2] }}" class="w-10 h-10 flex-shrink-0 rounded-full {{ $color[0] }} brutal-border cursor-pointer hover:scale-110 active:scale-95 transition-all"></button>
                    @endforeach
                </div>
            </div>

        </div>

        <!-- Canvas Container Wrapper (Dinamis) -->
        <div class="w-full flex justify-center items-center">
            <div class="relative bg-white brutal-border brutal-shadow rounded-[2.5rem] overflow-hidden transition-all duration-500 ease-in-out"
                id="canvas-container" style="width: 1000px; max-width: 100%; aspect-ratio: 1000 / 564; height: auto; max-height: 65vh; margin: 0 auto;">
                <canvas id="coloringCanvas" class="absolute inset-0 w-full h-full z-10 cursor-crosshair"></canvas>
                <img id="coloring-image" src="{{ $imageAssetPath }}" class="absolute inset-0 w-full h-full pointer-events-none z-20 mix-blend-multiply block" alt="Mewarnai">
            </div>
        </div>

        <div class="mt-10 flex flex-wrap justify-center gap-6 w-full max-w-7xl">
            <!-- Hapus Semua -->
            <div class="relative group/tooltip inline-block">
                <button id="clear-btn" onclick="clearCanvas()" class="w-20 h-20 flex items-center justify-center rounded-full font-bold text-black bg-[#FFFEFA] brutal-border brutal-shadow-sm brutal-hover cursor-pointer transform hover:-translate-y-2 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-10 h-10 text-black fill-none stroke-current" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="3 6 5 6 21 6"></polyline>
                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                        <line x1="10" y1="11" x2="10" y2="17"></line>
                        <line x1="14" y1="11" x2="14" y2="17"></line>
                    </svg>
                </button>
                <div class="pointer-events-none absolute bottom-full left-1/2 -translate-x-1/2 mb-3 bg-[#FFD1E3] brutal-border brutal-shadow-sm px-3 py-1.5 rounded-lg text-sm font-bold opacity-0 scale-95 group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-150 whitespace-nowrap z-50 text-black">
                    Hapus Semua
                </div>
            </div>

            <!-- Tampilkan Hasil! -->
            <div class="relative group/tooltip inline-block">
                <button id="show-result-btn" onclick="enablePresentationMode()" class="bg-[#D4F1BE] brutal-border brutal-shadow brutal-hover cursor-pointer text-black w-20 h-20 flex items-center justify-center rounded-full transform hover:-translate-y-2 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-10 h-10 text-black fill-none stroke-current" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                    </svg>
                </button>
                <div class="pointer-events-none absolute bottom-full left-1/2 -translate-x-1/2 mb-3 bg-[#FFD1E3] brutal-border brutal-shadow-sm px-3 py-1.5 rounded-lg text-sm font-bold opacity-0 scale-95 group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-150 whitespace-nowrap z-50 text-black">
                    Tampilkan Hasil
                </div>
            </div>

            <!-- Kembali Edit -->
            <div class="relative group/tooltip inline-block">
                <button id="back-edit-btn" onclick="disablePresentationMode()" class="hidden w-20 h-20 flex items-center justify-center rounded-full cursor-pointer font-bold text-black bg-[#FFF5B8] brutal-border brutal-shadow-sm brutal-hover transform hover:-translate-y-2 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-10 h-10 text-black fill-none stroke-current" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                    </svg>
                </button>
                <div class="pointer-events-none absolute bottom-full left-1/2 -translate-x-1/2 mb-3 bg-[#FFD1E3] brutal-border brutal-shadow-sm px-3 py-1.5 rounded-lg text-sm font-bold opacity-0 scale-95 group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-150 whitespace-nowrap z-50 text-black">
                    Kembali Edit
                </div>
            </div>

            <!-- Selesai & Ke Dashboard Mapel -->
            <div class="relative group/tooltip inline-block">
                <!-- Navigasi disinkronkan kembali ke index kelompok materi -->
                <a href="{{ route('materi.index', ['mapel_slug' => $mapel->slug]) }}" id="final-dashboard-btn" onclick="finishGame(event, this.href)"
                    class="hidden bg-[#FFD1E3] brutal-border brutal-shadow brutal-hover text-black w-20 h-20 flex items-center justify-center rounded-full transform hover:-translate-y-2 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-10 h-10 text-black fill-none stroke-current" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"></path>
                        <path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"></path>
                        <path d="M4 22h16"></path>
                        <path d="M10 14.66V17c0 .55-.45 1-1 1H4v2h16v-2h-5c-.55 0-1-.45-1-1v-2.34"></path>
                        <path d="M12 2a6 6 0 0 0-6 6v1c0 2.2 1.8 4 4 4h4c2.2 0 4-1.8 4-4V8a6 6 0 0 0-6-6z"></path>
                    </svg>
                </a>
                <div class="pointer-events-none absolute bottom-full left-1/2 -translate-x-1/2 mb-3 bg-[#FFD1E3] brutal-border brutal-shadow-sm px-3 py-1.5 rounded-lg text-sm font-bold opacity-0 scale-95 group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-150 whitespace-nowrap z-50 text-black">
                    Selesai &amp; Kembali
                </div>
            </div>
        </div>
    </div>

    <!-- Victory Success Modal -->
    <div id="success-modal" class="fixed inset-0 z-[9999] bg-slate-900/80 backdrop-blur-md hidden flex-col items-center justify-center opacity-0 transition-all duration-300">
        <div class="relative w-full max-w-[480px] aspect-square transform scale-90 transition-transform duration-500 select-none mx-4" id="success-modal-content">
            <img src="{{ asset('images/selamat.png') }}" alt="Selamat!" class="w-full h-full object-contain rounded-[3rem] brutal-border brutal-shadow">

            <div class="absolute bottom-[9%] left-0 right-0 flex justify-center">
                <div class="relative group/tooltip inline-block">
                    <button onclick="closeSuccessModal()" aria-label="Tampilkan" class="bg-[#D4F1BE] text-black px-8 py-3 rounded-2xl brutal-border brutal-shadow-sm brutal-hover flex items-center justify-center cursor-pointer font-black uppercase text-sm">
                        Tampilkan
                    </button>
                    <div class="pointer-events-none absolute bottom-full left-1/2 -translate-x-1/2 mb-3 bg-[#FFD1E3] brutal-border brutal-shadow-sm px-3 py-1.5 rounded-lg text-sm font-bold opacity-0 scale-95 group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-150 whitespace-nowrap z-50 text-black">
                        Lihat Hasil
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const canvas = document.getElementById('coloringCanvas');
        const ctx = canvas.getContext('2d');
        const container = document.getElementById('canvas-container');

        let painting = false;
        let color = '#ef4444';
        
        let pencilSize = 12;
        let eraserSize = 24;
        let brushSize = pencilSize;
        let currentTool = 'pencil';

        canvas.width = 1000;
        canvas.height = 564;

        const offscreenCanvas = document.createElement('canvas');
        const offscreenCtx = offscreenCanvas.getContext('2d');
        let outlineLoaded = false;
        const outlineImg = new Image();
        outlineImg.onload = () => {
            outlineLoaded = true;
            setupCanvasDimensions();
        };
        // Menangkap variabel URL dinamis dari PHP
        outlineImg.src = "{{ $imageAssetPath }}";

        function setupCanvasDimensions() {
            const tempCanvas = document.createElement('canvas');
            tempCanvas.width = canvas.width || 1000;
            tempCanvas.height = canvas.height || 564;
            const tempCtx = tempCanvas.getContext('2d');
            tempCtx.drawImage(canvas, 0, 0);

            const targetWidth = outlineImg.naturalWidth || 1000;
            const targetHeight = outlineImg.naturalHeight || 564;

            canvas.width = targetWidth;
            canvas.height = targetHeight;

            if (container) {
                container.style.aspectRatio = `${targetWidth} / ${targetHeight}`;
            }

            ctx.lineCap = 'round';
            ctx.lineJoin = 'round';
            
            ctx.drawImage(tempCanvas, 0, 0, canvas.width, canvas.height);

            offscreenCanvas.width = targetWidth;
            offscreenCanvas.height = targetHeight;
            if (outlineLoaded) {
                offscreenCtx.drawImage(outlineImg, 0, 0, targetWidth, targetHeight);
            }

            selectTool(currentTool);
        }

        window.addEventListener('load', setupCanvasDimensions);

        let toolbarOpen = true;
        function toggleToolbar() {
            const tb = document.getElementById('toolbar');
            const icon = document.getElementById('toggle-icon');
            if (toolbarOpen) {
                tb.style.transform = 'translateX(-100%)';
                icon.style.transform = 'rotate(180deg)';
                toolbarOpen = false;
            } else {
                tb.style.transform = 'translateX(0)';
                icon.style.transform = 'rotate(0deg)';
                toolbarOpen = true;
            }
        }

        function startPosition(e) {
            painting = true;
            draw(e);
        }

        function finishedPosition() {
            painting = false;
            ctx.beginPath();
        }

        function draw(e) {
            if (!painting) return;
            const rect = canvas.getBoundingClientRect();
            const x = ((e.clientX || (e.touches && e.touches[0].clientX)) - rect.left) * (canvas.width / rect.width);
            const y = ((e.clientY || (e.touches && e.touches[0].clientY)) - rect.top) * (canvas.height / rect.height);

            ctx.lineWidth = brushSize;
            ctx.strokeStyle = currentTool === 'eraser' ? 'rgba(0,0,0,1)' : color;
            ctx.lineTo(x, y);
            ctx.stroke();
            ctx.beginPath();
            ctx.moveTo(x, y);
        }

        canvas.addEventListener('mousedown', startPosition);
        canvas.addEventListener('mouseup', finishedPosition);
        canvas.addEventListener('mousemove', draw);
        canvas.addEventListener('touchstart', (e) => { e.preventDefault(); startPosition(e); }, { passive: false });
        canvas.addEventListener('touchend', finishedPosition);
        canvas.addEventListener('touchmove', (e) => { e.preventDefault(); draw(e); }, { passive: false });

        function clearCanvas() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
        }

        function updateBrushPreviewColor() {
            const preview = document.getElementById('brush-size-preview');
            if (preview) {
                if (currentTool === 'pencil') {
                    preview.style.backgroundColor = color;
                } else if (currentTool === 'eraser') {
                    preview.style.backgroundColor = '#f472b6';
                }
            }
        }

        function changeColor(newColor) {
            color = newColor;
            document.getElementById('selected-color-indicator').style.backgroundColor = newColor;

            if (currentTool === 'eraser') {
                selectTool('pencil');
            } else {
                updateBrushPreviewColor();
            }
        }

        function updateBrushSize(val) {
            const num = parseInt(val, 10);
            brushSize = num;
            if (currentTool === 'pencil') {
                pencilSize = num;
            } else if (currentTool === 'eraser') {
                eraserSize = num;
            }
            
            const preview = document.getElementById('brush-size-preview');
            if (preview) {
                preview.style.width = num + 'px';
                preview.style.height = num + 'px';
            }
        }

        function selectTool(tool) {
            currentTool = tool;

            document.getElementById('btn-tool-pencil').classList.remove('bg-[#FFF5B8]');
            document.getElementById('btn-tool-pencil').classList.add('bg-[#FFFEFA]');
            document.getElementById('btn-tool-eraser').classList.remove('bg-[#FFF5B8]');
            document.getElementById('btn-tool-eraser').classList.add('bg-[#FFFEFA]');

            document.getElementById(`btn-tool-${tool}`).classList.remove('bg-[#FFFEFA]');
            document.getElementById(`btn-tool-${tool}`).classList.add('bg-[#FFF5B8]');

            const activeSize = tool === 'pencil' ? pencilSize : eraserSize;
            brushSize = activeSize;
            
            const slider = document.getElementById('brush-size-slider');
            if (slider) {
                slider.value = activeSize;
            }
            
            const preview = document.getElementById('brush-size-preview');
            if (preview) {
                preview.style.width = activeSize + 'px';
                preview.style.height = activeSize + 'px';
            }
            
            updateBrushPreviewColor();

            if (tool === 'pencil') {
                ctx.globalCompositeOperation = 'source-over';
            } else if (tool === 'eraser') {
                ctx.globalCompositeOperation = 'destination-out';
            }
        }

        function showSuccessModal() {
            const modal = document.getElementById('success-modal');
            const content = document.getElementById('success-modal-content');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
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
            container.classList.add('scale-105');
            showSuccessModal();
        }

        function disablePresentationMode() {
            document.getElementById('toolbar').classList.remove('hidden');
            document.getElementById('clear-btn').classList.remove('hidden');
            document.getElementById('show-result-btn').classList.remove('hidden');
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
            container.classList.remove('scale-105');
        }

        function finishGame(event, nextUrl) {
            event.preventDefault();
            fetch('{{ route('materi.save_progress') }}', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: JSON.stringify({ materi_id: {{ $materi->id ?? 1 }}, tahap: 6, score: 100 }) // Skor disesuaikan kelulusan 100
            }).then(() => { window.location.href = nextUrl; });
        }
    </script>
</x-student-layout>