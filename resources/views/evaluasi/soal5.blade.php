<x-student-layout>
    <!-- Import Font Fredoka -->
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;600;700;900&display=swap" rel="stylesheet">
    <style>
        .font-fredoka {
            font-family: 'Fredoka', sans-serif;
        }

        .brutal-border {
            border: 4px solid #000000 !important;
        }

        .brutal-shadow {
            box-shadow: 6px 6px 0px 0px #000000 !important;
        }

        .brutal-shadow-sm {
            box-shadow: 3px 3px 0px 0px #000000 !important;
        }

        .brutal-hover {
            transition: all 0.2s ease-in-out !important;
        }

        .brutal-hover:hover {
            transform: translate(-3px, -3px) !important;
            box-shadow: 9px 9px 0px 0px #000000 !important;
        }

        .brutal-hover:active {
            transform: translate(2px, 2px) !important;
            box-shadow: 2px 2px 0px 0px #000000 !important;
        }

        .connection-node {
            cursor: pointer;
            transition: transform 0.2s;
        }

        .connection-node:hover {
            transform: scale(1.2);
        }
    </style>

    <div class="max-w-4xl w-full px-4 py-8 flex flex-col items-center font-fredoka text-black">

        <!-- Back to Dashboard / Header -->
        <div class="w-full flex justify-between items-center mb-6">
            <div class="relative group/tooltip inline-block">
                <a href="{{ route('dashboard') }}"
                    class="bg-[#FFB3B3] text-black px-4 py-2.5 rounded-2xl font-black brutal-border brutal-shadow-sm brutal-hover flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        class="w-5 h-5 text-black fill-none stroke-current" stroke-width="3.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                </a>
                <div class="pointer-events-none absolute top-full left-1/2 -translate-x-1/2 mt-3 bg-[#FFD1E3] brutal-border brutal-shadow-sm px-3 py-1.5 rounded-lg text-sm font-bold opacity-0 scale-95 group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-150 whitespace-nowrap z-50 text-black">
                    Kembali
                </div>
            </div>
        </div>

        <!-- Progress Bar -->
        <div class="w-full mb-8 max-w-3xl">
            <div class="flex justify-between mb-3 items-end">
                <span class="font-black text-lg tracking-widest uppercase">Soal {{ $soal }} dari 10</span>
                <span class="text-sm font-bold text-slate-600">Progres: {{ ($soal - 1) * 10 }}%</span>
            </div>
            <div class="w-full h-7 bg-white brutal-border brutal-shadow-sm rounded-2xl overflow-hidden p-1">
                <div class="h-full bg-[#E0BBE4] rounded-xl transition-all duration-500 border-r-4 border-black"
                    style="width: {{ ($soal / 10) * 100 }}%"></div>
            </div>
        </div>

        <!-- Question Container -->
        <div
            class="w-full bg-[#FFFEFA] brutal-border brutal-shadow rounded-[2.5rem] p-6 md:p-10 mb-8 transition-all duration-300 relative">
            <div class="text-center mb-10">
                <span
                    class="inline-block px-4 py-1.5 bg-[#E0BBE4] brutal-border brutal-shadow-sm rounded-xl text-xs font-black uppercase tracking-wider mb-3">Literasi</span>
                <h2 class="text-2xl md:text-3xl font-black text-black leading-snug">
                    Hubungkan setiap gambar dengan makna yang sesuai!
                </h2>
                <p class="text-sm text-slate-500 mt-2 font-bold uppercase tracking-widest">💡 Klik sebuah titik di kiri,
                    lalu klik titik pasangannya di kanan!</p>
            </div>

            <!-- Matching Game Arena -->
            <div class="relative grid grid-cols-1 md:grid-cols-2 gap-16 md:gap-32 max-w-3xl mx-auto"
                id="arena-container">
                <!-- SVG Canvas for Drawing Lines -->
                <svg class="absolute inset-0 w-full h-full pointer-events-none" id="svg-canvas" style="z-index: 10;">
                    <!-- Lines will be drawn dynamically -->
                </svg>

                <!-- Left Column (Images) -->
                <div class="flex flex-col gap-6 relative" style="z-index: 20;">
                    <!-- Item A -->
                    <div onclick="selectNode('left', 'A')" id="node-left-A"
                        class="w-full aspect-[4/3] max-w-[200px] bg-white brutal-border brutal-shadow-sm rounded-2xl overflow-hidden relative cursor-pointer connection-node transition-all hover:translate-y-[-2px] hover:shadow-[5px_5px_0px_0px_#000000] active:translate-y-[1px] active:shadow-[1px_1px_0px_0px_#000000]">
                        @php
                            $imageName = 'menghargai_agama.png';
                            $imagePath = 'images/evaluasi/' . $imageName;
                            $fileExists = file_exists(public_path($imagePath));
                        @endphp
                        @if ($fileExists)
                            <img src="{{ asset($imagePath) }}" alt="Selamat Hari Besar"
                                class="w-full h-full object-cover pointer-events-none">
                        @else
                            <div
                                class="w-full h-full flex flex-col items-center justify-center p-2 bg-[#BEE9E8] text-center text-black pointer-events-none">
                                <span class="text-2xl mb-1">⛪🕌</span>
                                <span class="font-black text-[9px] uppercase tracking-wider text-slate-700">Aset:</span>
                                <span
                                    class="font-bold text-[10px] bg-white px-1 py-0.5 brutal-border mt-1 font-mono text-slate-800 break-all select-all">{{ $imageName }}</span>
                            </div>
                        @endif
                        <div
                            class="absolute top-2 left-2 w-7 h-7 rounded-xl flex items-center justify-center font-black text-black border-2 border-black text-xs bg-[#BEE9E8]">
                            A
                        </div>
                    </div>

                    <!-- Item B -->
                    <div onclick="selectNode('left', 'B')" id="node-left-B"
                        class="w-full aspect-[4/3] max-w-[200px] bg-white brutal-border brutal-shadow-sm rounded-2xl overflow-hidden relative cursor-pointer connection-node transition-all hover:translate-y-[-2px] hover:shadow-[5px_5px_0px_0px_#000000] active:translate-y-[1px] active:shadow-[1px_1px_0px_0px_#000000]">
                        @php
                            $imageName = 'anak_bercerita_komik.png';
                            $imagePath = 'images/evaluasi/' . $imageName;
                            $fileExists = file_exists(public_path($imagePath));
                        @endphp
                        @if ($fileExists)
                            <img src="{{ asset($imagePath) }}" alt="Pakaian Adat"
                                class="w-full h-full object-cover pointer-events-none">
                        @else
                            <div
                                class="w-full h-full flex flex-col items-center justify-center p-2 bg-[#FFD1E3] text-center text-black pointer-events-none">
                                <span class="text-2xl mb-1">🥋</span>
                                <span class="font-black text-[9px] uppercase tracking-wider text-slate-700">Aset:</span>
                                <span
                                    class="font-bold text-[10px] bg-white px-1 py-0.5 brutal-border mt-1 font-mono text-slate-800 break-all select-all">{{ $imageName }}</span>
                            </div>
                        @endif
                        <div
                            class="absolute top-2 left-2 w-7 h-7 rounded-xl flex items-center justify-center font-black text-black border-2 border-black text-xs bg-[#FFD1E3]">
                            B
                        </div>
                    </div>

                    <!-- Item C -->
                    <div onclick="selectNode('left', 'C')" id="node-left-C"
                        class="w-full aspect-[4/3] max-w-[200px] bg-white brutal-border brutal-shadow-sm rounded-2xl overflow-hidden relative cursor-pointer connection-node transition-all hover:translate-y-[-2px] hover:shadow-[5px_5px_0px_0px_#000000] active:translate-y-[1px] active:shadow-[1px_1px_0px_0px_#000000]">
                        @php
                            $imageName = 'tari_daerah_nonton.png';
                            $imagePath = 'images/evaluasi/' . $imageName;
                            $fileExists = file_exists(public_path($imagePath));
                        @endphp
                        @if ($fileExists)
                            <img src="{{ asset($imagePath) }}" alt="Nonton Tari"
                                class="w-full h-full object-cover pointer-events-none">
                        @else
                            <div
                                class="w-full h-full flex flex-col items-center justify-center p-2 bg-[#FFF5B8] text-center text-black pointer-events-none">
                                <span class="text-2xl mb-1">💃</span>
                                <span class="font-black text-[9px] uppercase tracking-wider text-slate-700">Aset:</span>
                                <span
                                    class="font-bold text-[10px] bg-white px-1 py-0.5 brutal-border mt-1 font-mono text-slate-800 break-all select-all">{{ $imageName }}</span>
                            </div>
                        @endif
                        <div
                            class="absolute top-2 left-2 w-7 h-7 rounded-xl flex items-center justify-center font-black text-black border-2 border-black text-xs bg-[#FFF5B8]">
                            C
                        </div>
                    </div>
                </div>

                <!-- Right Column (Text Meanings) -->
                <div class="flex flex-col gap-6 relative" style="z-index: 20;">
                    <!-- Meaning 1 -->
                    <div class="h-[150px] flex items-center w-full">
                        <div onclick="selectNode('right', '1')" id="node-right-1"
                            class="w-full p-4 bg-white brutal-border brutal-shadow-sm rounded-2xl text-center md:text-left font-black text-sm md:text-base select-none cursor-pointer connection-node transition-all hover:translate-y-[-2px] hover:shadow-[5px_5px_0px_0px_#000000] active:translate-y-[1px] active:shadow-[1px_1px_0px_0px_#000000]">
                            Melestarikan budaya daerah
                        </div>
                    </div>

                    <!-- Meaning 2 -->
                    <div class="h-[150px] flex items-center w-full">
                        <div onclick="selectNode('right', '2')" id="node-right-2"
                            class="w-full p-4 bg-white brutal-border brutal-shadow-sm rounded-2xl text-center md:text-left font-black text-sm md:text-base select-none cursor-pointer connection-node transition-all hover:translate-y-[-2px] hover:shadow-[5px_5px_0px_0px_#000000] active:translate-y-[1px] active:shadow-[1px_1px_0px_0px_#000000]">
                            Menghargai perbedaan agama
                        </div>
                    </div>

                    <!-- Meaning 3 -->
                    <div class="h-[150px] flex items-center w-full">
                        <div onclick="selectNode('right', '3')" id="node-right-3"
                            class="w-full p-4 bg-white brutal-border brutal-shadow-sm rounded-2xl text-center md:text-left font-black text-sm md:text-base select-none cursor-pointer connection-node transition-all hover:translate-y-[-2px] hover:shadow-[5px_5px_0px_0px_#000000] active:translate-y-[1px] active:shadow-[1px_1px_0px_0px_#000000]">
                            Menghargai keberagaman budaya di Indonesia
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Buttons -->
        <div class="flex gap-4 items-center">
            <div class="relative group/tooltip inline-block">
                <a href="{{ route('evaluasi.soal', ['soal' => $soal - 1]) }}"
                    class="bg-white hover:bg-slate-50 brutal-border brutal-shadow-sm brutal-hover text-black px-6 py-4 rounded-2xl font-black uppercase text-base flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        class="w-5 h-5 text-black fill-none stroke-current" stroke-width="3.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                    Kembali
                </a>
                <div class="pointer-events-none absolute bottom-full left-1/2 -translate-x-1/2 mb-3 bg-[#FFD1E3] brutal-border brutal-shadow-sm px-3 py-1.5 rounded-lg text-sm font-bold opacity-0 scale-95 group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-150 whitespace-nowrap z-50 text-black">
                    Sebelumnya
                </div>
            </div>

            <div class="relative group/tooltip inline-block">
                <button id="btn-next" onclick="goNext()"
                    class="bg-[#D4F1BE] brutal-border brutal-shadow-sm brutal-hover text-black px-8 py-4 rounded-2xl font-black uppercase text-base flex items-center gap-2">
                    Lanjut
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        class="w-5 h-5 text-black fill-none stroke-current" stroke-width="3.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </button>
                <div class="pointer-events-none absolute bottom-full left-1/2 -translate-x-1/2 mb-3 bg-[#FFD1E3] brutal-border brutal-shadow-sm px-3 py-1.5 rounded-lg text-sm font-bold opacity-0 scale-95 group-hover/tooltip:opacity-100 group-hover/tooltip:scale-100 transition-all duration-150 whitespace-nowrap z-50 text-black">
                    Selanjutnya
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Modal for Selection -->
    <div id="alert-modal"
        class="fixed inset-0 z-[9999] bg-slate-900/60 backdrop-blur-sm hidden flex-col items-center justify-center opacity-0 transition-all duration-300">
        <div class="bg-white brutal-border brutal-shadow rounded-[2.5rem] p-8 max-w-sm w-full mx-4 text-center transform scale-90 transition-transform duration-300"
            id="alert-content">
            <span class="text-6xl mb-4 block">⚠️</span>
            <h3 class="text-2xl font-black text-black mb-3 uppercase">Hubungkan Semua!</h3>
            <p class="text-slate-600 font-bold mb-6">Silakan hubungkan seluruh pasangan gambar dan makna terlebih
                dahulu.</p>
            <button onclick="closeAlert()"
                class="w-full bg-[#FFF5B8] brutal-border brutal-shadow-sm brutal-hover py-3 rounded-xl font-black uppercase text-sm">
                Mengerti 👍
            </button>
        </div>
    </div>

    <script>
        // Store connections, e.g., { 'A': '2', 'B': '3' }
        let connections = {};
        let activeLeftNode = null;
        let activeRightNode = null;
        let currentMouseX = 0;
        let currentMouseY = 0;
        let isTracking = false;

        window.onload = function() {
            // Restore state if available
            const stored = sessionStorage.getItem('evaluasi_answers');
            if (stored) {
                const answers = JSON.parse(stored);
                if (answers.soal5) {
                    connections = answers.soal5;
                }
            }

            // Draw lines after layout rendered
            setTimeout(drawLines, 100);
            window.addEventListener('resize', drawLines);

            // Listen to mousemove for dynamic rope drawing
            document.addEventListener('mousemove', function(e) {
                if (!isTracking) return;
                const arena = document.getElementById('arena-container').getBoundingClientRect();
                currentMouseX = e.clientX - arena.left;
                currentMouseY = e.clientY - arena.top;
                drawLines();
            });
        };

        function selectNode(side, val) {
            if (side === 'left') {
                if (activeLeftNode === val) {
                    resetVisuals();
                    activeLeftNode = null;
                    isTracking = false;
                    drawLines();
                    return;
                }
                resetVisuals();
                activeLeftNode = val;
                isTracking = true;

                // Highlight left node
                const el = document.getElementById('node-left-' + val);
                if (el) {
                    el.classList.remove('brutal-shadow-sm', 'bg-white');
                    el.classList.add('bg-[#FFF5B8]');
                    el.style.boxShadow = '0 0 0 4px #000000, 6px 6px 0px 0px #000000';
                }
            } else {
                if (activeRightNode === val) {
                    resetVisuals();
                    activeRightNode = null;
                    isTracking = false;
                    drawLines();
                    return;
                }
                resetVisuals();
                activeRightNode = val;
                isTracking = true;

                // Highlight right node
                const el = document.getElementById('node-right-' + val);
                if (el) {
                    el.classList.remove('brutal-shadow-sm', 'bg-white');
                    el.classList.add('bg-[#FFF5B8]');
                    el.style.boxShadow = '0 0 0 4px #000000, 6px 6px 0px 0px #000000';
                }
            }

            // If both sides are selected, connect them!
            if (activeLeftNode && activeRightNode) {
                // Remove existing connection pointing to this right node if any
                for (let k in connections) {
                    if (connections[k] === activeRightNode) {
                        delete connections[k];
                    }
                }

                // Set connection
                connections[activeLeftNode] = activeRightNode;

                resetVisuals();
                activeLeftNode = null;
                activeRightNode = null;
                isTracking = false;

                saveState();
                drawLines();
            } else {
                drawLines();
            }
        }

        function resetVisuals() {
            ['A', 'B', 'C'].forEach(id => {
                const el = document.getElementById('node-left-' + id);
                if (el) {
                    el.classList.add('brutal-shadow-sm', 'bg-white');
                    el.classList.remove('bg-[#FFF5B8]');
                    el.style.boxShadow = '';
                }
            });
            ['1', '2', '3'].forEach(id => {
                const el = document.getElementById('node-right-' + id);
                if (el) {
                    el.classList.add('brutal-shadow-sm', 'bg-white');
                    el.classList.remove('bg-[#FFF5B8]');
                    el.style.boxShadow = '';
                }
            });
        }

        function drawLines() {
            const svg = document.getElementById('svg-canvas');
            const arena = document.getElementById('arena-container').getBoundingClientRect();

            // Clear current lines
            svg.innerHTML = '';

            // Draw existing connections as thick ropes
            for (let leftVal in connections) {
                const rightVal = connections[leftVal];

                const leftEl = document.getElementById('node-left-' + leftVal);
                const rightEl = document.getElementById('node-right-' + rightVal);

                if (leftEl && rightEl) {
                    const leftRect = leftEl.getBoundingClientRect();
                    const rightRect = rightEl.getBoundingClientRect();

                    const x1 = leftRect.left + leftRect.width / 2 - arena.left;
                    const y1 = leftRect.top + leftRect.height / 2 - arena.top;
                    const x2 = rightRect.left + rightRect.width / 2 - arena.left;
                    const y2 = rightRect.top + rightRect.height / 2 - arena.top;

                    const colorsRope = {
                        'A': '#BEE9E8',
                        'B': '#FFD1E3',
                        'C': '#E0BBE4'
                    };
                    const ropeColor = colorsRope[leftVal] || '#FFF5B8';

                    // Black background line (border)
                    const lineBorder = document.createElementNS('http://www.w3.org/2000/svg', 'line');
                    lineBorder.setAttribute('x1', x1);
                    lineBorder.setAttribute('y1', y1);
                    lineBorder.setAttribute('x2', x2);
                    lineBorder.setAttribute('y2', y2);
                    lineBorder.setAttribute('stroke', '#000000');
                    lineBorder.setAttribute('stroke-width', '10');
                    lineBorder.setAttribute('stroke-linecap', 'round');
                    svg.appendChild(lineBorder);

                    // Colored core line
                    const lineCore = document.createElementNS('http://www.w3.org/2000/svg', 'line');
                    lineCore.setAttribute('x1', x1);
                    lineCore.setAttribute('y1', y1);
                    lineCore.setAttribute('x2', x2);
                    lineCore.setAttribute('y2', y2);
                    lineCore.setAttribute('stroke', ropeColor);
                    lineCore.setAttribute('stroke-width', '6');
                    lineCore.setAttribute('stroke-linecap', 'round');
                    svg.appendChild(lineCore);
                }
            }

            // Draw active tracking line if user is dragging a rope
            if (isTracking) {
                let startX = 0;
                let startY = 0;
                let trackingColor = '#FFF5B8';

                if (activeLeftNode) {
                    const leftEl = document.getElementById('node-left-' + activeLeftNode);
                    if (leftEl) {
                        const leftRect = leftEl.getBoundingClientRect();
                        const colorsRope = {
                            'A': '#BEE9E8',
                            'B': '#FFD1E3',
                            'C': '#E0BBE4'
                        };
                        trackingColor = colorsRope[activeLeftNode] || '#FFF5B8';

                        startX = leftRect.left + leftRect.width / 2 - arena.left;
                        startY = leftRect.top + leftRect.height / 2 - arena.top;
                    }
                } else if (activeRightNode) {
                    const rightEl = document.getElementById('node-right-' + activeRightNode);
                    if (rightEl) {
                        const rightRect = rightEl.getBoundingClientRect();
                        trackingColor = '#E0BBE4';

                        startX = rightRect.left + rightRect.width / 2 - arena.left;
                        startY = rightRect.top + rightRect.height / 2 - arena.top;
                    }
                }

                // Dotted rope border
                const lineBorder = document.createElementNS('http://www.w3.org/2000/svg', 'line');
                lineBorder.setAttribute('x1', startX);
                lineBorder.setAttribute('y1', startY);
                lineBorder.setAttribute('x2', currentMouseX);
                lineBorder.setAttribute('y2', currentMouseY);
                lineBorder.setAttribute('stroke', '#000000');
                lineBorder.setAttribute('stroke-width', '10');
                lineBorder.setAttribute('stroke-linecap', 'round');
                lineBorder.setAttribute('stroke-dasharray', '8, 8');
                svg.appendChild(lineBorder);

                // Dotted rope core
                const lineCore = document.createElementNS('http://www.w3.org/2000/svg', 'line');
                lineCore.setAttribute('x1', startX);
                lineCore.setAttribute('y1', startY);
                lineCore.setAttribute('x2', currentMouseX);
                lineCore.setAttribute('y2', currentMouseY);
                lineCore.setAttribute('stroke', trackingColor);
                lineCore.setAttribute('stroke-width', '6');
                lineCore.setAttribute('stroke-linecap', 'round');
                lineCore.setAttribute('stroke-dasharray', '8, 8');
                svg.appendChild(lineCore);
            }
        }

        function saveState() {
            const stored = sessionStorage.getItem('evaluasi_answers') || '{}';
            const answers = JSON.parse(stored);
            answers.soal5 = connections;
            sessionStorage.setItem('evaluasi_answers', JSON.stringify(answers));
        }

        function goNext() {
            const connectedKeys = Object.keys(connections);
            if (connectedKeys.length < 3) {
                showAlert();
                return;
            }
            window.location.href = "{{ route('evaluasi.soal', ['soal' => $soal + 1]) }}";
        }

        function showAlert() {
            const modal = document.getElementById('alert-modal');
            const content = document.getElementById('alert-content');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            void modal.offsetWidth;
            modal.classList.remove('opacity-0');
            content.classList.remove('scale-90');
            content.classList.add('scale-100');
        }

        function closeAlert() {
            const modal = document.getElementById('alert-modal');
            const content = document.getElementById('alert-content');
            content.classList.remove('scale-100');
            content.classList.add('scale-90');
            modal.classList.add('opacity-0');
            setTimeout(() => {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
            }, 300);
        }
    </script>
</x-student-layout>
