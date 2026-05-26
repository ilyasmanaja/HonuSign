<x-student-layout>
    <!-- Interactive Visual Tutorial Overlay -->
    <div id="tutorial-overlay"
        class="fixed inset-0 bg-slate-900/80 backdrop-blur-md z-[5000] flex items-center justify-center p-4 transition-opacity duration-500 opacity-0 pointer-events-none">
        <div class="bg-[#FFFEFA] brutal-border brutal-shadow p-8 md:p-12 rounded-[3rem] max-w-xl w-full flex flex-col items-center text-center relative transform scale-90 transition-transform duration-500"
            id="tutorial-modal-content">

            <div
                class="bg-[#FFF5B8] px-6 py-2 rounded-2xl brutal-border brutal-shadow-sm font-black text-sm mb-6 -rotate-2 text-black">
                AKTIVITAS KELAS
            </div>

            <h2 class="text-3xl md:text-4xl font-black text-black tracking-tight mb-6">
                Diskusi Isyarat
            </h2>

            <!-- Animasi Guru Menjelaskan & Murid Mendengarkan -->
            <div class="relative w-full max-w-sm h-64 bg-[#BEE9E8] brutal-border rounded-[2rem] p-4 flex items-center justify-between mb-8 mx-auto overflow-hidden shadow-inner">
                <!-- Guru (Left) -->
                <div class="flex flex-col items-center z-10 w-1/3">
                    <span class="text-5xl animate-bounce">👩‍🏫</span>
                    <span class="text-xs font-black text-black bg-[#FFF5B8] px-3 py-1 rounded-xl brutal-border mt-3 shadow-[2px_2px_0_#000]">Guru</span>
                </div>

                <!-- Speech Wave / Bubbles (Center) -->
                <div class="flex gap-1.5 items-center justify-center flex-grow px-2 z-10 h-24">
                    <span class="w-2.5 h-10 bg-black rounded-full animate-pulse" style="animation-delay: 0.1s"></span>
                    <span class="w-2.5 h-16 bg-black rounded-full animate-pulse" style="animation-delay: 0.3s"></span>
                    <span class="w-2.5 h-8 bg-black rounded-full animate-pulse" style="animation-delay: 0.5s"></span>
                </div>

                <!-- Murid (Right) -->
                <div class="flex flex-col items-center z-10 w-1/3">
                    <span class="text-5xl animate-pulse">👦</span>
                    <span class="text-xs font-black text-black bg-[#D4F1BE] px-3 py-1 rounded-xl brutal-border mt-3 shadow-[2px_2px_0_#000]">Murid</span>
                </div>

                <!-- Big Ear / listening focus indicator -->
                <div class="absolute right-4 top-4 text-3xl animate-ping opacity-75">
                    👂
                </div>
            </div>

            <!-- Penjelasan Teks -->
            <div class="flex flex-col gap-4 text-left w-full bg-[#F8FAFC] brutal-border p-6 rounded-2xl mb-8 shadow-sm">
                <div class="flex items-start gap-3">
                    <span class="bg-[#FFF5B8] w-8 h-8 rounded-xl brutal-border flex items-center justify-center font-black text-black text-sm shrink-0 mt-0.5">1</span>
                    <p class="font-bold text-slate-700 text-sm md:text-base"><b>Bersama Guru</b>: Sesi diskusi isyarat ini dilakukan bersama guru di dalam kelas.</p>
                </div>
                <div class="flex items-start gap-3">
                    <span class="bg-[#D4F1BE] w-8 h-8 rounded-xl brutal-border flex items-center justify-center font-black text-black text-sm shrink-0 mt-0.5">2</span>
                    <p class="font-bold text-slate-700 text-sm md:text-base"><b>Perhatikan Isyarat</b>: Perhatikan dan tirukan penjelasan gerakan isyarat dari guru bersama-sama.</p>
                </div>
            </div>

            <!-- Confirm Button (Visual Icon Ok / Checklist) -->
            <button onclick="closeTutorial()"
                class="w-20 h-20 bg-[#D4F1BE] text-black rounded-full brutal-border brutal-shadow-sm brutal-hover flex items-center justify-center cursor-pointer animate-pulse"
                title="Mengerti">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10">
                    <circle cx="12" cy="12" r="10" opacity="0.2" />
                    <path d="M10 15.172l-3.5-3.5-1.414 1.414 4.914 4.914 9.9-9.9-1.414-1.414z" fill="currentColor" />
                </svg>
            </button>
        </div>
    </div>

    <div class="max-w-5xl w-full px-6 py-12 flex flex-col items-center">
        <!-- Progress Bar (Tahap 3) -->
        <div class="w-full mb-10 max-w-3xl">
            <div class="flex justify-between mb-4 items-end">
                <span class="font-black text-xl tracking-widest uppercase text-black">Membaca</span>
            </div>
            <div class="w-full h-8 bg-white brutal-border brutal-shadow-sm rounded-2xl overflow-hidden p-1">
                <div class="h-full bg-[#BEE9E8] rounded-xl transition-all duration-1000 border-r-4 border-black"
                    style="width: 50%"></div>
            </div>
        </div>

        <!-- Header Judul Materi -->
        <div class="text-center mb-10">
            <h1
                class="text-4xl md:text-6xl font-black text-[#FFF5B8] text-outline uppercase tracking-tighter transform -rotate-1 drop-shadow-[0_6px_0_#000]">
                Diskusi Isyarat
            </h1>
        </div>

        <!-- Konten Materi (Fokus Teks Cerita Bergambar) -->
        <div class="w-full flex justify-center mb-10">

            <!-- Card Utama Cerita -->
            <div
                class="w-full max-w-5xl bg-[#FFD1E3] brutal-border brutal-shadow rounded-[3rem] p-6 md:p-8 flex flex-col h-full">
                <div
                    class="bg-[#FFFEFA] brutal-border brutal-shadow-sm rounded-[2rem] p-6 md:p-10 flex-grow flex flex-col relative">

                    <!-- Header Card -->
                    <div class="flex justify-between items-center mb-10 gap-6 border-b-4 border-slate-200 pb-6">
                        <h3
                            class="font-black text-black uppercase tracking-widest text-xl md:text-2xl flex items-center gap-4">
                            <span
                                class="p-3 bg-[#FFF5B8] brutal-border brutal-shadow-sm rounded-2xl transform -rotate-3">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="w-8 h-8 text-black">
                                    <path opacity="0.2"
                                        d="M12 3v18c-3.333-1-5-1-8-1a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2c3 0 4.667 0 8 0z" />
                                    <path
                                        d="M12 3v18c3.333-1 5-1 8-1a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2c-3 0-4.667 0-8 0z" />
                                </svg>
                            </span>
                            SLB Insan Mutiara Pekanbaru
                        </h3>
                    </div>

                    <div class="text-xl md:text-2xl text-slate-700 leading-relaxed font-bold flex-grow space-y-6">

                        <!-- Gambar 1 (Centered, rotate -1) -->
                        <div class="my-10 flex justify-center transform -rotate-1">
                            <div
                                class="bg-white p-4 brutal-border brutal-shadow-sm rounded-[2.5rem] inline-block hover:scale-105 transition-transform duration-300">
                                <img src="{{ asset('images/materi/tahap3/Sedang paduan suara.png') }}"
                                    alt="Sedang paduan suara"
                                    class="w-full max-w-lg rounded-3xl brutal-border">
                            </div>
                        </div>

                        <!-- Paragraf 1 (Justified) -->
                        <p class="text-justify">
                            Pada sore hari di lapangan sekolah SLB Insan Mutiara Pekanbaru, anak-anak kelas 2 menjadi pengisi paduan suara saat upacara bendera pada hari senin. Anak-anak sangat bahagia, termasuk Made, Samsul, dan Udin. Mereka bersemangat untuk menyanyikan lagu satu nusa,satu bangsa dari L.Manik karena guru mereka pernah bercerita bahwa meski Indonesia ada banyak suku dan budaya tetapi Indonesia adalah kesatuan yang tidak dapat dipisahkan. Lagu ini mencerminkan persahabatan Made, Samsul dan Udin yang berbeda budaya. Made dari bali, Samsul dari riau, dan Udin dari jawa, meski berbeda mereka adalah sahabat
                        </p>

                        <!-- Gambar 2 (Centered, rotate 1) -->
                        <div class="my-10 flex justify-center transform rotate-1">
                            <div
                                class="bg-white p-4 brutal-border brutal-shadow-sm rounded-[2.5rem] inline-block hover:scale-105 transition-transform duration-300">
                                <img src="{{ asset('images/materi/tahap3/Udin membantu Siti yang terjatuh.png') }}"
                                    alt="Udin membantu Siti yang terjatuh"
                                    class="w-full max-w-lg rounded-3xl brutal-border">
                            </div>
                        </div>

                        <!-- Paragraf 2 (Justified) -->
                        <p class="text-justify">
                            Selesai latihan paduan suara, mereka bercerita dengan teman-temannya yang lain mengenai makna lagu satu nusa, satu bangsa. Saat semuanya berkumpul, Siti yang baru selesai membacakan undang-undang dasar berlari ke teman-temannya. Karena terburu-buru Siti menjadi terjatuh. Udin pun membantu siti yang menangis karena sakit di kakinya. Akhirnya mereka bercerita kembali bersama-sama.
                        </p>

                    </div>
                </div>
            </div>

        </div>

        <!-- Tombol Aksi (Visual-Only - Centered for better UX) -->
        <div class="w-full max-w-5xl flex justify-center gap-12 items-center mt-8 px-4">
            <!-- Tombol Keluar & Simpan (Visual House Icon) -->
            <a href="{{ route('materi.index') }}" onclick="tandaiSelesai(event, this.href, 3)"
                class="bg-[#FFB3B3] w-20 h-20 flex items-center justify-center brutal-border brutal-shadow-sm brutal-hover text-black rounded-full transform hover:-translate-y-2 transition-transform"
                title="Keluar & Simpan">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10">
                    <path opacity="0.2" d="M12 3L2 12h3v8h14v-8h3L12 3z" />
                    <path d="M12 3L2 12h3v8h14v-8h3L12 3zm0 2.83L18.17 12H17v6H7v-6H5.83L12 5.83z"
                        fill="currentColor" />
                </svg>
            </a>

            <!-- Tombol Lanjut ke Kamera (Visual Camera Icon) -->
            <a href="{{ route('materi.belajar', ['step' => 3, 'soal_ke' => 1]) }}"
                onclick="tandaiSelesai(event, this.href, 3)"
                class="bg-[#D4F1BE] w-20 h-20 flex items-center justify-center brutal-border brutal-shadow-sm brutal-hover text-black rounded-full transform hover:-translate-y-2 transition-transform"
                title="Mulai Tantangan Kamera">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-12 h-12">
                    <circle cx="12" cy="12" r="10" opacity="0.2" fill="currentColor" />
                    <path
                        d="M4 8a2 2 0 0 1 2-2h1.5l1-1.5h7l1 1.5H18a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8z M12 17a4 4 0 1 0 0-8 4 4 0 0 0 0 8z M12 15a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"
                        fill="currentColor" />
                </svg>
            </a>
        </div>
    </div>

    <script>
        function showTutorial() {
            const overlay = document.getElementById('tutorial-overlay');
            const content = document.getElementById('tutorial-modal-content');
            if (overlay && content) {
                overlay.classList.remove('opacity-0', 'pointer-events-none');
                overlay.classList.add('opacity-100', 'pointer-events-auto');
                content.classList.remove('scale-90');
                content.classList.add('scale-100');
            }
        }

        function closeTutorial() {
            const overlay = document.getElementById('tutorial-overlay');
            const content = document.getElementById('tutorial-modal-content');
            if (overlay && content) {
                overlay.classList.add('opacity-0', 'pointer-events-none');
                overlay.classList.remove('opacity-100', 'pointer-events-auto');
                content.classList.add('scale-90');
                content.classList.remove('scale-100');
            }
        }

        window.addEventListener('DOMContentLoaded', () => {
            showTutorial();
        });

        function tandaiSelesai(event, nextUrl, tahapKe) {
            event.preventDefault(); // Tahan dulu, jangan langsung pindah halaman

            fetch('{{ route('materi.save_progress') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    materi_id: {{ $materi->id }},
                    tahap: tahapKe,
                    score: 0 // Karena ini cuma bacaan, skor 0 tidak masalah
                })
            }).then(() => {
                window.location.href = nextUrl; // Kalau sukses simpan, baru pindah halaman
            }).catch(() => {
                window.location.href = nextUrl; // Kalau internet nge-lag, tetap izinkan pindah halaman
            });
        }
    </script>
</x-student-layout>
