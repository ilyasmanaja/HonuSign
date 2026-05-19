<x-student-layout>
    <style>
        /* Gaya Khusus untuk Lintasan */
        .road-path {
            background-image: linear-gradient(90deg, #000 50%, transparent 50%);
            background-size: 40px 4px;
            background-repeat: repeat-x;
            background-position: bottom;
        }

        .bounce-active {
            animation: character-bounce 0.4s ease;
        }

        @keyframes character-bounce {

            0%,
            100% {
                transform: translateY(0) scale(1);
            }

            50% {
                transform: translateY(-30px) scale(1.1);
            }
        }

        .cloud-anim {
            animation: cloud-float 10s linear infinite;
        }

        @keyframes cloud-float {
            from {
                transform: translateX(-100px);
            }

            to {
                transform: translateX(100vw);
            }
        }

        /* Full Screen Glow */
        .step-glow {
            box-shadow: inset 0 0 50px #D4F1BE !important;
            transition: box-shadow 0.3s ease;
        }

        .glow-yellow {
            filter: drop-shadow(0 0 25px #facc15);
            transform: scale(1.05);
        }
    </style>

    <!-- Intro Overlay -->
    <div id="intro-overlay"
        class="fixed inset-0 z-[9999] bg-[#FFFEFA] flex flex-col items-center justify-center transition-opacity duration-1000 ease-in-out">
        <div class="text-center px-6">
            <div
                class="inline-block px-6 py-2 bg-[#FFF5B8] brutal-border brutal-shadow-sm rounded-2xl text-black text-sm font-bold mb-6 -rotate-2">
                Perjalanan Belajar
            </div>
            <h1
                class="text-6xl md:text-8xl font-black text-black text-outline transform -rotate-2 animate-bounce text-center drop-shadow-[0_10px_0_rgba(0,0,0,0.15)]">
                Perjalanan Samsul
            </h1>
            <p
                class="mt-6 text-2xl font-bold text-slate-500 bg-[#BEE9E8] brutal-border brutal-shadow-sm px-6 py-2 rounded-2xl inline-block rotate-1">
                Ayo ke Sekolah!</p>
        </div>
    </div>

    <div id="game-container"
        class="min-h-[calc(100vh-6rem)] max-h-[calc(100vh-4rem)] w-full flex flex-col items-center justify-between p-4 md:p-6 max-w-5xl mx-auto overflow-hidden transition-all duration-300">

        <!-- Header Judul Visual -->
        <div class="text-center mb-3 md:mb-4">
            <h1 class="text-3xl md:text-5xl font-black text-black tracking-tighter mb-2 leading-tight uppercase">
                Ayo <span class="text-[#FFD1E3] text-outline drop-shadow-[0_4px_0_#000]">Bantu Samsul</span> <br /> Ke
                Sekolah!
            </h1>
        </div>

        <!-- Area Perjalanan (Environment) -->
        <div
            class="relative w-full max-w-5xl h-48 md:h-64 bg-[#BEE9E8] brutal-border brutal-shadow rounded-[2rem] md:rounded-[3rem] my-auto">

            <!-- Wrapper Latar Belakang (Awan & Pohon) agar terpotong rapi -->
            <div class="absolute inset-0 overflow-hidden rounded-[2rem] md:rounded-[3rem] z-0">

            <!-- Langit: Awan & Burung Terbang -->
            <div class="absolute text-4xl md:text-5xl cloud-anim opacity-50 flex items-center gap-4 z-0"
                style="top: 10%; left: 5%;">
                ☁️ <span class="text-2xl mt-4" style="transform: scaleX(-1); display: inline-block;">🐦</span>
            </div>
            <div class="absolute text-2xl cloud-anim opacity-60 z-0"
                style="top: 25%; left: 25%; animation-delay: -3s; animation-duration: 12s;">
                <span style="transform: scaleX(-1); display: inline-block;">🦅</span>
            </div>
            <div class="absolute text-3xl md:text-4xl cloud-anim opacity-40 flex items-center gap-8 z-0"
                style="top: 15%; left: 50%; animation-delay: -5s;">
                ☁️ <span class="text-xl mt-2" style="transform: scaleX(-1); display: inline-block;">🕊️</span>
            </div>
            <div class="absolute text-4xl cloud-anim opacity-50 z-0"
                style="top: 5%; left: 80%; animation-delay: -8s; animation-duration: 18s;">
                ☁️
            </div>

            <!-- Darat: Pohon, Semak & Bunga (Terkunci di tanah agar tidak terbang) -->
            <!-- Sisi Kiri -->
            <div class="absolute text-5xl md:text-6xl opacity-90 z-0" style="bottom: 35px; left: 2%;">🌳</div>
            <div class="absolute text-4xl md:text-5xl opacity-80 z-0" style="bottom: 30px; left: 8%;">🌲</div>
            <div class="absolute text-2xl opacity-90 z-0" style="bottom: 35px; left: 15%;">🌻</div>

            <!-- Tengah Kiri -->
            <div class="absolute text-3xl opacity-80 z-0" style="bottom: 35px; left: 25%;">🌿</div>
            <div class="absolute text-5xl opacity-90 z-0" style="bottom: 35px; left: 35%;">🌳</div>
            <div class="absolute text-2xl opacity-90 z-0" style="bottom: 35px; left: 42%;">🍄</div>

            <!-- Tengah Kanan -->
            <div class="absolute text-4xl opacity-80 z-0" style="bottom: 30px; left: 55%;">🌲</div>
            <div class="absolute text-2xl opacity-90 z-0" style="bottom: 35px; left: 62%;">🌷</div>
            <div class="absolute text-5xl md:text-6xl opacity-90 z-0" style="bottom: 35px; left: 75%;">🌳</div>
            <div class="absolute text-3xl opacity-80 z-0" style="bottom: 35px; left: 82%;">🌿</div>

            <!-- Jalanan -->
            <div class="absolute w-full h-10 md:h-12 bg-slate-400/30 road-path z-0" style="bottom: 0;"></div>

            </div> <!-- Tutup Wrapper Latar Belakang -->

            <!-- Sekolah (Tujuan) -->
            <div id="school-container" class="absolute flex flex-col items-center transition-all duration-500 z-10"
                style="bottom: 15px; right: 2rem;">
                <div class="transform hover:scale-110 transition-transform">
                    <img src="{{ asset('images/keSekolah/SLB.png') }}" class="w-32 md:w-48 h-auto filter drop-shadow-xl"
                        alt="Sekolah SLB" />
                </div>
            </div>

            <!-- Karakter Samsul -->
            <div id="character-container"
                class="absolute flex flex-col items-center transition-all duration-500 ease-out z-20"
                style="bottom: 15px; left: 5%;">
                <div id="character" class="relative select-none">
                    <img src="{{ asset('images/keSekolah/samsul.png') }}" class="w-20 md:w-32 h-auto mix-blend-multiply"
                        alt="Samsul" />
                </div>
                <!-- Efek Debu saat Jalan -->
                <div id="dust"
                    class="absolute -bottom-2 -left-6 text-2xl md:text-3xl opacity-0 transition-all duration-300"
                    style="transform: scaleX(-1);">💨</div>
            </div>

        </div>

        <!-- Tombol Aksi Jalan -->
        <div class="mt-4 md:mt-6 flex flex-col items-center w-full z-30">
            <p class="text-xs md:text-sm font-black text-slate-500 mb-1 md:mb-2 uppercase tracking-widest">TAP CEPAT
                UNTUK ISI TENAGA!</p>
            <button onclick="chargeEnergy()" id="move-btn"
                class="relative bg-white text-black px-10 py-4 md:py-6 rounded-[2.5rem] md:rounded-[3rem] brutal-border brutal-shadow brutal-hover font-black uppercase tracking-widest text-xl md:text-4xl flex items-center justify-center gap-3 md:gap-4 transition-all overflow-hidden w-full max-w-sm">

                <!-- Bar Pengisi Tenaga -->
                <div id="energy-fill"
                    class="absolute top-0 left-0 h-full bg-[#FFF5B8] w-0 transition-all duration-150 ease-out z-0 border-r-4 border-transparent">
                </div>

                <span
                    class="relative z-10 flex items-center gap-3 md:gap-4 transform transition-transform active:scale-95">
                    Isi Tenaga! <span class="text-3xl md:text-4xl" id="btn-icon">⚡</span>
                </span>
            </button>
        </div>

        <!-- Progress Bar ala Semi-Brutalism -->
        <div class="mt-6 md:mt-8 w-full max-w-2xl mb-2">
            <div class="flex justify-between mb-2 md:mb-4 items-end">
                <span class="font-black text-lg md:text-xl tracking-widest uppercase text-black">Perjalanan:</span>
                <span id="progressText"
                    class="text-3xl md:text-4xl font-black text-black bg-[#D4F1BE] brutal-border px-4 py-1 rounded-2xl transform rotate-2">0%</span>
            </div>
            <div class="w-full h-6 md:h-8 bg-white brutal-border brutal-shadow-sm rounded-2xl overflow-hidden p-1">
                <div id="progressBar"
                    class="h-full w-0 bg-[#FFD1E3] rounded-xl transition-all duration-500 border-r-4 border-black">
                </div>
            </div>
        </div>

    </div>

    <!-- Interactive Visual Tutorial Overlay -->
    <div id="tutorial-overlay"
        class="fixed inset-0 bg-slate-900/80 backdrop-blur-md z-[5000] flex items-center justify-center p-4 transition-opacity duration-500 opacity-0 pointer-events-none">
        <div class="bg-[#FFFEFA] brutal-border brutal-shadow p-8 md:p-12 rounded-[3rem] max-w-xl w-full flex flex-col items-center text-center relative transform scale-90 transition-transform duration-500"
            id="tutorial-modal-content">

            <div
                class="bg-[#FFF5B8] px-6 py-2 rounded-2xl brutal-border brutal-shadow-sm font-black text-sm mb-6 -rotate-2 text-black">
                TUTORIAL SINGKAT
            </div>

            <h2 class="text-3xl md:text-5xl font-black text-black tracking-tight mb-6">
                Cara Membantu Samsul!
            </h2>

            <!-- Animasi Simulasi Tap & Jalan -->
            <div
                class="relative w-64 h-48 bg-[#E2E8F0] brutal-border rounded-2xl p-4 flex flex-col items-center justify-between mb-8 mx-auto overflow-hidden shadow-inner">
                <!-- Area Jalan & Karakter -->
                <div
                    class="w-full h-20 bg-[#BEE9E8] brutal-border rounded-xl flex items-center justify-between px-3 relative overflow-hidden">
                    <div id="sim-samsul"
                        class="text-3xl transition-all duration-500 z-10 relative transform scale-x-[-1] rotate-1"
                        style="left: 0%;">
                        🚶‍♂️</div>
                    <div class="text-3xl z-10">🏫</div>
                    <!-- Garis Jalan -->
                    <div class="absolute bottom-2 left-0 right-0 h-2 bg-slate-400/40"></div>
                </div>

                <!-- Tombol Tap Simulasi -->
                <div id="sim-btn"
                    class="w-full h-14 bg-white brutal-border rounded-xl flex items-center justify-center font-black text-base shadow-sm relative overflow-hidden transition-all duration-150 border-black text-black">
                    <div id="sim-energy"
                        class="absolute top-0 left-0 h-full bg-[#FFF5B8] w-0 transition-all duration-200 z-0 border-r-4 border-transparent">
                    </div>
                    <span class="relative z-10 flex items-center gap-2 text-black font-black">TAP TOMBOL!</span>
                </div>

                <!-- Tangan Animasi Cursor -->
                <div id="sim-cursor"
                    class="absolute w-10 h-10 transition-all duration-300 pointer-events-none z-50 flex items-center justify-center text-3xl"
                    style="top: 75%; left: 50%; transform: translate(-50%, -50%);">
                    👆
                </div>
            </div>

            <!-- Penjelasan Teks -->
            <div class="flex flex-col gap-4 text-left w-full bg-[#F8FAFC] brutal-border p-6 rounded-2xl mb-8 shadow-sm">
                <div class="flex items-start gap-3">
                    <span
                        class="bg-[#FFF5B8] w-8 h-8 rounded-xl brutal-border flex items-center justify-center font-black text-black text-sm shrink-0 mt-0.5">1</span>
                    <p class="font-bold text-slate-700 text-sm md:text-base"><b>Tap (Klik) tombol "Isi Tenaga!"</b>
                        berulang kali dengan cepat.</p>
                </div>
                <div class="flex items-start gap-3">
                    <span
                        class="bg-[#D4F1BE] w-8 h-8 rounded-xl brutal-border flex items-center justify-center font-black text-black text-sm shrink-0 mt-0.5">2</span>
                    <p class="font-bold text-slate-700 text-sm md:text-base">Setiap tenaga penuh, Samsul akan
                        <b>melangkah maju</b> menuju sekolah!
                    </p>
                </div>
            </div>

            <button onclick="closeTutorial()"
                class="w-full md:w-auto bg-[#D4F1BE] text-black font-black text-lg md:text-xl px-10 py-4 rounded-3xl brutal-border brutal-shadow-sm brutal-hover">
                OKE, AKU MENGERTI!
            </button>
        </div>
    </div>

    <script>
        let progress = 0;
        const container = document.getElementById('game-container');
        const charContainer = document.getElementById('character-container');
        const char = document.getElementById('character');
        const dust = document.getElementById('dust');
        const bar = document.getElementById('progressBar');
        const text = document.getElementById('progressText');

        // Logika Pengisian Tenaga
        let currentStepIndex = 0;
        // Jumlah tap yang dibutuhkan untuk setiap 10% langkah (semakin lama semakin butuh banyak tenaga)
        const tapsPerStep = [3, 3, 4, 4, 5, 5, 6, 6, 7, 7];
        let currentTaps = 0;

        function chargeEnergy() {
            if (progress >= 100) return;

            currentTaps++;
            const requiredTaps = tapsPerStep[currentStepIndex];

            // Hitung persen tenaga di dalam tombol
            let energyPct = (currentTaps / requiredTaps) * 100;
            const energyFill = document.getElementById('energy-fill');
            if (energyFill) {
                energyFill.style.width = energyPct + '%';
                energyFill.style.borderRightColor = '#000'; // Munculkan garis batas saat mengisi
            }

            // Efek getar kecil saat tombol ditekan
            const btnIcon = document.getElementById('btn-icon');
            if (btnIcon) {
                btnIcon.style.transform = 'scale(1.3)';
                setTimeout(() => btnIcon.style.transform = 'scale(1)', 150);
            }

            if (currentTaps >= requiredTaps) {
                // TENAGA PENUH! SAMSUL JALAN
                currentTaps = 0;
                currentStepIndex++;

                // Ubah icon sesaat menjadi sepatu
                if (btnIcon) {
                    btnIcon.innerText = '👟';
                    setTimeout(() => btnIcon.innerText = '⚡', 500);
                }

                // Reset visual bar tenaga
                if (energyFill) {
                    setTimeout(() => {
                        energyFill.style.transition = 'width 0.5s ease-in-out';
                        energyFill.style.width = '0%';
                        setTimeout(() => {
                            energyFill.style.transition = 'width 0.15s ease-out';
                            energyFill.style.borderRightColor = 'transparent';
                        }, 500);
                    }, 200);
                }

                // Panggil fungsi jalan
                moveAhead();
            }
        }

        function moveAhead() {
            if (progress >= 100) return;

            progress += 10;

            // 1. Update Posisi Visual
            // Kita batasi sampai 80% agar tidak menabrak sekolah secara visual
            const visualPos = (progress * 0.75) + 5;
            charContainer.style.left = visualPos + '%';

            // 2. Animasi Loncat & Debu
            char.classList.remove('bounce-active');
            void char.offsetWidth; // trigger reflow
            char.classList.add('bounce-active');

            dust.style.opacity = '1';
            dust.style.transform = 'scaleX(-1) translateY(-15px) scale(1.5)';
            setTimeout(() => {
                dust.style.opacity = '0';
                dust.style.transform = 'scaleX(-1) translateY(0) scale(1)';
            }, 300);

            // 3. Visual Feedback (Glow Hijau)
            container.classList.add('step-glow');
            setTimeout(() => container.classList.remove('step-glow'), 300);

            // 4. Update Progress Bar
            bar.style.width = progress + '%';
            text.innerText = progress + '%';

            // 50% Milestone: Ekspresi / Bubble
            if (progress === 50) {
                const bubble = document.createElement('div');
                bubble.id = 'char-bubble';
                bubble.innerText = '🏃‍♂️';
                // Memberikan style Speech Bubble (Chat) dengan z-index maksimum
                bubble.className = 'absolute -top-20 -right-4 bg-white brutal-border brutal-shadow-sm px-4 py-2 rounded-[2rem] rounded-bl-none text-4xl animate-bounce flex items-center justify-center z-[9999]';
                char.appendChild(bubble);
            }

            // 80% Milestone: Sekolah Glow
            if (progress === 80) {
                document.getElementById('school-container').classList.add('glow-yellow');
            }

            // 5. Cek Sampai
            if (progress >= 100) {
                const bubble = document.getElementById('char-bubble');
                if (bubble) bubble.innerText = '🤩'; // Ekspresi Senang

                // Sembunyikan tombol jalan
                const moveBtn = document.getElementById('move-btn');
                if (moveBtn) moveBtn.classList.add('hidden');

                // Efek Bintang
                for (let i = 0; i < 8; i++) {
                    const star = document.createElement('div');
                    star.innerText = '✨';
                    star.className = 'absolute text-3xl animate-bounce';
                    star.style.left = (Math.random() * 100 - 50) + 'px';
                    star.style.top = (Math.random() * -100 - 50) + 'px';
                    char.appendChild(star);
                }

                setTimeout(() => {
                    window.location.href = "{{ route('materi.belajar', ['step' => 1]) }}";
                }, 1500);
            }
        }

        let tutorialAnimTimer = null;

        function runTutorialAnimation() {
            const samsul = document.getElementById('sim-samsul');
            const energy = document.getElementById('sim-energy');
            const btn = document.getElementById('sim-btn');
            const cursor = document.getElementById('sim-cursor');
            if (!samsul || !energy || !btn || !cursor) return;

            // Reset posisi awal
            samsul.style.left = '0%';
            energy.style.width = '0%';
            energy.style.borderRightColor = 'transparent';
            btn.className = 'w-full h-14 bg-white brutal-border rounded-xl flex items-center justify-center font-black text-base shadow-sm relative overflow-hidden transition-all duration-150 border-black text-black';
            cursor.style.top = '78%';

            // Tap 1
            setTimeout(() => {
                cursor.style.transform = 'translate(-50%, -50%) scale(0.8)';
                energy.style.width = '35%';
                energy.style.borderRightColor = '#000';
                btn.classList.add('ring-4', 'ring-sky-400');
            }, 600);
            setTimeout(() => {
                cursor.style.transform = 'translate(-50%, -50%) scale(1)';
            }, 900);

            // Tap 2
            setTimeout(() => {
                cursor.style.transform = 'translate(-50%, -50%) scale(0.8)';
                energy.style.width = '70%';
            }, 1400);
            setTimeout(() => {
                cursor.style.transform = 'translate(-50%, -50%) scale(1)';
            }, 1700);

            // Tap 3 (Tenaga Penuh!)
            setTimeout(() => {
                cursor.style.transform = 'translate(-50%, -50%) scale(0.8)';
                energy.style.width = '100%';
                btn.classList.replace('bg-white', 'bg-[#D4F1BE]');
            }, 2200);

            // Samsul Melangkah Maju
            setTimeout(() => {
                cursor.style.transform = 'translate(-50%, -50%) scale(1)';
                btn.classList.remove('ring-4', 'ring-sky-400');
                btn.classList.replace('bg-[#D4F1BE]', 'bg-white');
                energy.style.width = '0%';
                energy.style.borderRightColor = 'transparent';
                samsul.style.left = '70%';
            }, 2700);
        }

        function showTutorial() {
            const overlay = document.getElementById('tutorial-overlay');
            const content = document.getElementById('tutorial-modal-content');
            if (!overlay || !content) return;

            overlay.classList.remove('opacity-0', 'pointer-events-none');
            overlay.classList.add('opacity-100', 'pointer-events-auto');
            content.classList.remove('scale-90');
            content.classList.add('scale-100');

            runTutorialAnimation();
            clearInterval(tutorialAnimTimer);
            tutorialAnimTimer = setInterval(runTutorialAnimation, 4500);
        }

        function closeTutorial() {
            const overlay = document.getElementById('tutorial-overlay');
            const content = document.getElementById('tutorial-modal-content');
            if (!overlay || !content) return;

            overlay.classList.remove('opacity-100', 'pointer-events-auto');
            overlay.classList.add('opacity-0', 'pointer-events-none');
            content.classList.remove('scale-100');
            content.classList.add('scale-90');

            clearInterval(tutorialAnimTimer);
        }

        document.addEventListener('DOMContentLoaded', () => {
            // Hilangkan intro overlay setelah 2 detik
            setTimeout(() => {
                const overlay = document.getElementById('intro-overlay');
                if (overlay) {
                    overlay.style.opacity = '0';
                    setTimeout(() => {
                        overlay.remove();
                        showTutorial();
                    }, 1000); // Tunggu animasi fade-out selesai
                }
            }, 2000);
        });
    </script>
</x-student-layout>