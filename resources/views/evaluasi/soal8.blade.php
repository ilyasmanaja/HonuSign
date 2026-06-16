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
                    class="inline-block px-4 py-1.5 bg-[#D4F1BE] brutal-border brutal-shadow-sm rounded-xl text-xs font-black uppercase tracking-wider mb-3">Spasial</span>
                <h2 class="text-2xl md:text-3xl font-black text-black leading-snug">
                    Tentukan gambar berwarna dengan pasangan bayangannya (siluet) yang tepat!
                </h2>
                <p class="text-sm text-slate-500 mt-2 font-bold uppercase tracking-widest">💡 Tarik gambar berwarna di
                    kiri, lalu letakkan di atas siluet yang cocok di kanan!</p>
            </div>

            <!-- Drag & Drop Arena -->
            <div class="relative grid grid-cols-2 gap-10 md:gap-24 max-w-2xl mx-auto" id="arena-container">
                <!-- Left Column (Draggable Colored Images) -->
                <div id="left-column" class="flex flex-col gap-6 relative w-full items-center" style="z-index: 20;">
                    <!-- Rendered by JavaScript -->
                </div>

                <!-- Right Column (Silhouette Drop Zones) -->
                <div id="right-column" class="flex flex-col gap-6 relative w-full items-center" style="z-index: 20;">
                    <!-- Rendered by JavaScript -->
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
            <p class="text-slate-600 font-bold mb-6">Silakan hubungkan seluruh pasangan gambar dan bayangan terlebih
                dahulu.</p>
            <button onclick="closeAlert()"
                class="w-full bg-[#FFF5B8] brutal-border brutal-shadow-sm brutal-hover py-3 rounded-xl font-black uppercase text-sm">
                Mengerti 👍
            </button>
        </div>
    </div>

    <script>
        // Store connections, e.g. { 'gambus': 'gambus' } (we match left key to right key)
        let connections = {};

        // Items and Silhouettes Data mapping
        const itemsData = {
            'gambus': {
                key: 'gambus',
                name: 'Gambus',
                colorImg: '{{ asset("images/evaluasi/gambus.png") }}',
                siluetImg: '{{ asset("images/evaluasi/gambus_siluet.png") }}'
            },
            'pacu_jalur': {
                key: 'pacu_jalur',
                name: 'Pacu Jalur',
                colorImg: '{{ asset("images/evaluasi/pacu_jalur.png") }}',
                siluetImg: '{{ asset("images/evaluasi/pacu_jalur_siluet.png") }}'
            },
            'selaso_jatuh': {
                key: 'selaso_jatuh',
                name: 'Rumah Selaso Jatuh Kembar',
                colorImg: '{{ asset("images/evaluasi/selaso_jatuh.png") }}',
                siluetImg: '{{ asset("images/evaluasi/selaso_jatuh_siluet.png") }}'
            }
        };

        const leftOrder = ['gambus', 'pacu_jalur', 'selaso_jatuh'];
        const rightOrder = ['selaso_jatuh', 'gambus', 'pacu_jalur'];

        window.onload = function() {
            // Restore state if available
            const stored = sessionStorage.getItem('evaluasi_answers');
            if (stored) {
                const answers = JSON.parse(stored);
                if (answers.soal8) {
                    connections = answers.soal8;
                }
            }
            renderBoard();
        };

        function saveState() {
            const stored = sessionStorage.getItem('evaluasi_answers') || '{}';
            const answers = JSON.parse(stored);
            answers.soal8 = connections;
            sessionStorage.setItem('evaluasi_answers', JSON.stringify(answers));
        }

        // Render functions to draw the board state
        function renderBoard() {
            const leftCol = document.getElementById('left-column');
            const rightCol = document.getElementById('right-column');

            // 1. Render Left Column (Draggable Colored Images)
            leftCol.innerHTML = '';
            leftOrder.forEach(itemKey => {
                const item = itemsData[itemKey];
                const isPlaced = Object.prototype.hasOwnProperty.call(connections, itemKey);

                const slotEl = document.createElement('div');
                slotEl.className = 'w-full max-w-[150px] md:max-w-[180px] aspect-square flex items-center justify-center border-4 border-transparent';

                if (!isPlaced) {
                    slotEl.innerHTML = `
                        <div 
                            id="card-left-${itemKey}"
                            draggable="true"
                            ondragstart="dragStart(event, '${itemKey}')"
                            ondragend="dragEnd(event)"
                            ontouchstart="handleTouchStart(event, '${itemKey}')"
                            ontouchmove="handleTouchMove(event)"
                            ontouchend="handleTouchEnd(event)"
                            class="w-full h-full flex items-center justify-center cursor-grab active:cursor-grabbing hover:scale-105 transition-transform"
                        >
                            <img 
                                src="${item.colorImg}" 
                                alt="${item.name}" 
                                class="max-w-full max-h-full object-contain pointer-events-none"
                            />
                        </div>
                    `;
                } else {
                    slotEl.innerHTML = `
                        <div class="w-full h-full border-4 border-dashed border-slate-200 rounded-2xl flex items-center justify-center text-slate-300 font-bold text-xs uppercase select-none p-4 text-center">
                            Diletakkan
                        </div>
                    `;
                }
                leftCol.appendChild(slotEl);
            });

            // 2. Render Right Column (Silhouette Drop Zones / Occupied Slots)
            rightCol.innerHTML = '';
            rightOrder.forEach(slotKey => {
                const slotEl = document.createElement('div');
                slotEl.className = 'w-full max-w-[150px] md:max-w-[180px] aspect-square flex items-center justify-center relative transition-all duration-200';
                slotEl.setAttribute('id', `slot-right-${slotKey}`);
                
                // Find if any left item is placed on this slotKey
                let placedItemKey = null;
                for (let leftKey in connections) {
                    if (connections[leftKey] === slotKey) {
                        placedItemKey = leftKey;
                        break;
                    }
                }

                if (placedItemKey) {
                    const item = itemsData[placedItemKey];
                    slotEl.innerHTML = `
                        <div 
                            onclick="returnToLeft('${placedItemKey}')"
                            class="w-full h-full flex items-center justify-center cursor-pointer relative hover:scale-105 transition-transform"
                        >
                            <img 
                                src="${item.colorImg}" 
                                alt="${item.name}" 
                                class="max-w-full max-h-full object-contain pointer-events-none"
                            />
                        </div>
                    `;
                } else {
                    const silhouetteItem = itemsData[slotKey];
                    // Display silhouette directly (without brightness filter)
                    slotEl.innerHTML = `
                        <div 
                            ondragover="allowDrop(event)"
                            ondragenter="dragEnter(event, '${slotKey}')"
                            ondragleave="dragLeave(event, '${slotKey}')"
                            ondrop="handleDrop(event, '${slotKey}')"
                            class="slot-dropzone w-full h-full flex items-center justify-center border-4 border-transparent rounded-2xl transition-all duration-200"
                        >
                            <img 
                                src="${silhouetteItem.siluetImg}" 
                                alt="Siluet ${silhouetteItem.name}" 
                                class="max-w-full max-h-full object-contain pointer-events-none opacity-80"
                            />
                        </div>
                    `;
                }
                rightCol.appendChild(slotEl);
            });
        }

        // HTML5 Desktop Drag and Drop handlers
        function dragStart(ev, itemKey) {
            ev.dataTransfer.setData("text/plain", itemKey);
            const card = document.getElementById(`card-left-${itemKey}`);
            if (card) {
                setTimeout(() => {
                    card.classList.add('opacity-40');
                }, 0);
            }
        }

        function dragEnd(ev) {
            renderBoard();
        }

        function allowDrop(ev) {
            ev.preventDefault();
        }

        function dragEnter(ev, slotKey) {
            ev.preventDefault();
            const slot = document.getElementById(`slot-right-${slotKey}`);
            if (slot) {
                const innerDiv = slot.querySelector('.slot-dropzone');
                if (innerDiv) {
                    innerDiv.classList.remove('border-transparent');
                    innerDiv.classList.add('bg-[#FFF5B8]', 'border-4', 'border-dashed', 'border-black');
                }
            }
        }

        function dragLeave(ev, slotKey) {
            const slot = document.getElementById(`slot-right-${slotKey}`);
            if (slot) {
                const innerDiv = slot.querySelector('.slot-dropzone');
                if (innerDiv) {
                    innerDiv.classList.add('border-transparent');
                    innerDiv.classList.remove('bg-[#FFF5B8]', 'border-4', 'border-dashed', 'border-black');
                }
            }
        }

        function handleDrop(ev, slotKey) {
            ev.preventDefault();
            const itemKey = ev.dataTransfer.getData("text/plain");
            if (itemsData[itemKey]) {
                delete connections[itemKey];
                for (let key in connections) {
                    if (connections[key] === slotKey) {
                        delete connections[key];
                    }
                }
                connections[itemKey] = slotKey;
                saveState();
            }
            renderBoard();
        }

        // Touch Drag & Drop logic for Mobile
        let touchDragItem = null;
        let touchDragClone = null;
        let touchOffsetX = 0;
        let touchOffsetY = 0;

        function handleTouchStart(e, itemKey) {
            e.preventDefault();
            touchDragItem = itemKey;
            
            const originalEl = e.currentTarget;
            const rect = originalEl.getBoundingClientRect();
            const touch = e.touches[0];
            
            touchOffsetX = touch.clientX - rect.left;
            touchOffsetY = touch.clientY - rect.top;
            
            // Create clone to drag around
            touchDragClone = originalEl.cloneNode(true);
            touchDragClone.style.position = 'fixed';
            touchDragClone.style.left = rect.left + 'px';
            touchDragClone.style.top = rect.top + 'px';
            touchDragClone.style.width = rect.width + 'px';
            touchDragClone.style.height = rect.height + 'px';
            touchDragClone.style.opacity = '0.9';
            touchDragClone.style.zIndex = '9999';
            touchDragClone.style.pointerEvents = 'none';
            
            document.body.appendChild(touchDragClone);
            
            // Make original element semi-transparent
            originalEl.classList.add('opacity-40');
        }

        function handleTouchMove(e) {
            if (!touchDragClone) return;
            e.preventDefault();
            
            const touch = e.touches[0];
            const x = touch.clientX - touchOffsetX;
            const y = touch.clientY - touchOffsetY;
            
            touchDragClone.style.left = x + 'px';
            touchDragClone.style.top = y + 'px';
            
            highlightSlotUnderTouch(touch.clientX, touch.clientY);
        }

        function handleTouchEnd(e) {
            if (!touchDragItem) return;
            e.preventDefault();
            
            const touch = e.changedTouches[0];
            const x = touch.clientX;
            const y = touch.clientY;
            
            if (touchDragClone) {
                touchDragClone.remove();
                touchDragClone = null;
            }
            
            clearAllSlotHighlights();
            
            const element = document.elementFromPoint(x, y);
            let targetSlot = null;
            
            if (element) {
                targetSlot = element.closest('[id^="slot-right-"]');
            }
            
            if (targetSlot) {
                const slotKey = targetSlot.id.replace('slot-right-', '');
                
                // Clear any existing connection for this item or slot
                delete connections[touchDragItem];
                for (let key in connections) {
                    if (connections[key] === slotKey) {
                        delete connections[key];
                    }
                }
                
                connections[touchDragItem] = slotKey;
                saveState();
            }
            
            touchDragItem = null;
            renderBoard();
        }

        function highlightSlotUnderTouch(x, y) {
            clearAllSlotHighlights();
            const element = document.elementFromPoint(x, y);
            if (element) {
                const slot = element.closest('[id^="slot-right-"]');
                if (slot) {
                    const innerDiv = slot.querySelector('.slot-dropzone');
                    if (innerDiv) {
                        innerDiv.classList.remove('border-transparent');
                        innerDiv.classList.add('bg-[#FFF5B8]', 'border-4', 'border-dashed', 'border-black');
                    }
                }
            }
        }

        function clearAllSlotHighlights() {
            rightOrder.forEach(slotKey => {
                const slot = document.getElementById(`slot-right-${slotKey}`);
                if (slot) {
                    const innerDiv = slot.querySelector('.slot-dropzone');
                    if (innerDiv) {
                        innerDiv.classList.add('border-transparent');
                        innerDiv.classList.remove('bg-[#FFF5B8]', 'border-4', 'border-dashed', 'border-black');
                    }
                }
            });
        }

        function returnToLeft(itemKey) {
            if (connections[itemKey]) {
                delete connections[itemKey];
                saveState();
                renderBoard();
            }
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
