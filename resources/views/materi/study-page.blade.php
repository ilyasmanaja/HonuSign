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
        <h1
            class="text-6xl md:text-8xl font-black text-[#FFF5B8] text-outline transform -rotate-2 animate-bounce text-center px-4 drop-shadow-[0_10px_0_#000]">
            Perjalanan Samsul
        </h1>
        <p class="mt-4 text-2xl font-bold text-slate-500">Ayo ke Sekolah!</p>
    </div>

    <div id="game-container"
        class="min-h-[80vh] w-full flex flex-col items-center justify-center p-6 transition-all duration-300">

        <!-- Header Judul Visual -->
        <div class="text-center mb-8">
            <h1 class="text-4xl md:text-5xl font-black text-black tracking-tighter mb-4 leading-tight uppercase">
                Ayo <span class="text-[#FFD1E3] text-outline drop-shadow-[0_4px_0_#000]">Bantu Samsul</span> <br /> Ke
                Sekolah!
            </h1>
        </div>

        <!-- Area Perjalanan (Environment) -->
        <div
            class="relative w-full max-w-5xl h-64 bg-[#BEE9E8] brutal-border brutal-shadow rounded-[3rem] overflow-hidden">

            <!-- Awan Terbang -->
            <div class="absolute top-10 left-10 text-5xl cloud-anim opacity-50">☁️</div>
            <div class="absolute top-20 left-1/2 text-4xl cloud-anim opacity-40" style="animation-delay: -5s;">☁️</div>

            <!-- Pohon-pohon di Belakang -->
            <div class="absolute bottom-12 left-20 text-6xl opacity-80">🌳</div>
            <div class="absolute bottom-12 right-40 text-6xl opacity-80">🌳</div>

            <!-- Jalanan -->
            <div class="absolute bottom-0 w-full h-12 bg-slate-400/30 road-path"></div>

            <!-- Sekolah (Tujuan) -->
            <div id="school-container"
                class="absolute bottom-4 right-8 flex flex-col items-center transition-all duration-500 z-10">
                <div class="transform hover:scale-110 transition-transform">
                    <img src="{{ asset('images/keSekolah/SLB.png') }}" class="w-40 md:w-48 h-auto filter drop-shadow-xl"
                        alt="Sekolah SLB" />
                </div>
            </div>

            <!-- Karakter Samsul -->
            <div id="character-container" class="absolute bottom-4 left-8 transition-all duration-500 ease-out z-20">
                <div id="character" class="relative select-none">
                    <img src="{{ asset('images/keSekolah/samsul.png') }}" class="w-24 md:w-32 h-auto mix-blend-multiply"
                        alt="Samsul" />
                </div>
                <!-- Efek Debu saat Jalan -->
                <div id="dust" class="absolute -bottom-2 -left-6 text-3xl opacity-0 transition-all duration-300"
                    style="transform: scaleX(-1);">💨</div>
            </div>

        </div>

        <!-- Tombol Aksi Jalan -->
        <div class="mt-6 flex flex-col items-center w-full z-30">
            <p class="text-sm font-black text-slate-500 mb-2 uppercase tracking-widest">TAP CEPAT UNTUK ISI TENAGA!</p>
            <button onclick="chargeEnergy()" id="move-btn"
                class="relative bg-white text-black px-12 py-5 md:py-6 rounded-[3rem] brutal-border brutal-shadow brutal-hover font-black uppercase tracking-widest text-2xl md:text-4xl flex items-center justify-center gap-4 transition-all overflow-hidden w-full max-w-sm">

                <!-- Bar Pengisi Tenaga -->
                <div id="energy-fill"
                    class="absolute top-0 left-0 h-full bg-[#FFF5B8] w-0 transition-all duration-150 ease-out z-0 border-r-4 border-transparent">
                </div>

                <span class="relative z-10 flex items-center gap-4 transform transition-transform active:scale-95">
                    Isi Tenaga! <span class="text-4xl" id="btn-icon">⚡</span>
                </span>
            </button>
        </div>

        <!-- Progress Bar ala Semi-Brutalism -->
        <div class="mt-12 w-full max-w-2xl">
            <div class="flex justify-between mb-4 items-end">
                <span class="font-black text-xl tracking-widest uppercase text-black">Perjalanan:</span>
                <span id="progressText"
                    class="text-4xl font-black text-black bg-[#D4F1BE] brutal-border px-4 py-1 rounded-2xl transform rotate-2">0%</span>
            </div>
            <div class="w-full h-8 bg-white brutal-border brutal-shadow-sm rounded-2xl overflow-hidden p-1">
                <div id="progressBar"
                    class="h-full w-0 bg-[#FFD1E3] rounded-xl transition-all duration-500 border-r-4 border-black">
                </div>
            </div>
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
            energyFill.style.width = energyPct + '%';
            energyFill.style.borderRightColor = '#000'; // Munculkan garis batas saat mengisi

            // Efek getar kecil saat tombol ditekan
            const btnIcon = document.getElementById('btn-icon');
            btnIcon.style.transform = 'scale(1.3)';
            setTimeout(() => btnIcon.style.transform = 'scale(1)', 150);

            if (currentTaps >= requiredTaps) {
                // TENAGA PENUH! SAMSUL JALAN
                currentTaps = 0;
                currentStepIndex++;

                // Ubah icon sesaat menjadi sepatu
                btnIcon.innerText = '👟';
                setTimeout(() => btnIcon.innerText = '⚡', 500);

                // Reset visual bar tenaga
                setTimeout(() => {
                    energyFill.style.transition = 'width 0.5s ease-in-out';
                    energyFill.style.width = '0%';
                    setTimeout(() => {
                        energyFill.style.transition = 'width 0.15s ease-out';
                        energyFill.style.borderRightColor = 'transparent';
                    }, 500);
                }, 200);

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
                // Memberikan style Speech Bubble (Chat)
                bubble.className = 'absolute -top-20 -right-4 bg-white brutal-border brutal-shadow-sm px-4 py-2 rounded-[2rem] rounded-bl-none text-4xl animate-bounce flex items-center justify-center z-50';
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

        document.addEventListener('DOMContentLoaded', () => {
            // Hilangkan intro overlay setelah 2 detik
            setTimeout(() => {
                const overlay = document.getElementById('intro-overlay');
                if (overlay) {
                    overlay.style.opacity = '0';
                    setTimeout(() => overlay.remove(), 1000); // Tunggu animasi fade-out selesai
                }
            }, 2000);
        });
    </script>
</x-student-layout>