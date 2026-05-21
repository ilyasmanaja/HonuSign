<x-student-layout>
    <div class="max-w-5xl w-full px-6 py-12 flex flex-col items-center">

        <!-- Progress Bar -->
        <div class="w-full mb-10 max-w-3xl">
            <div class="flex justify-between mb-4 items-end">
                <span class="font-black text-xl tracking-widest uppercase text-black">Diskusi</span>
            </div>
            <div class="w-full h-8 bg-white brutal-border brutal-shadow-sm rounded-2xl overflow-hidden p-1">
                <div class="h-full bg-[#BEE9E8] rounded-xl transition-all duration-1000 border-r-4 border-black"
                    style="width: 50%"></div>
            </div>
        </div>

        <!-- Header Judul -->
        <div class="text-center mb-10">s
            <h1 class="text-4xl md:text-5xl font-black text-black uppercase tracking-tighter transform -rotate-1 mb-2">
                Ayo <span class="text-[#BEE9E8] text-outline drop-shadow-[0_4px_0_#000]">Membaca</span>!
            </h1>
        </div>

        <!-- Konten Card -->
        <div class="w-full max-w-5xl bg-[#BEE9E8] brutal-border brutal-shadow rounded-[3rem] p-6 md:p-8 mb-10">
            <div class="bg-[#FFFEFA] brutal-border brutal-shadow-sm rounded-[2rem] p-6 md:p-10">
                <!-- Header Card -->
                <div class="flex items-center gap-4 mb-8 border-b-4 border-slate-200 pb-6">
                    <span class="p-3 bg-[#BEE9E8] brutal-border brutal-shadow-sm rounded-2xl transform -rotate-3">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="w-8 h-8 text-black">
                            <path opacity="0.2"
                                d="M12 3v18c-3.333-1-5-1-8-1a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2c3 0 4.667 0 8 0z" />
                            <path d="M12 3v18c3.333-1 5-1 8-1a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2c-3 0-4.667 0-8 0z" />
                        </svg>
                    </span>
                    <h3 class="font-black text-black uppercase tracking-widest text-xl md:text-2xl">Diskusi Isyarat</h3>
                </div>

                <div class="text-xl md:text-2xl text-slate-700 leading-relaxed font-bold space-y-6">
                    <p>Pada sore hari di lapangan sekolah di Dumai, anak-anak kelas 2 diminta untuk menjadi pengisi
                        paduan suara saat upacara bendera pada hari senin. Anak-anak sangat riang gembira, termasuk
                        made, samsul, dan udin. Mereka bersemangat untuk menyanyikan lagu satu nusa, satu bangsa ciptaan
                        L.Manik karena guru mereka pernah bercerita bahwa meski Indonesia punya beragam suku dan budaya
                        tetapi Indonesia tetaplah sebuah kesatuan yang tidak dapat dipisahkan. Lagu ini mencerminkan
                        persahabatan made, samsul dan udin yang berbeda budaya. Made dari bali, Samsul dari melayu riau,
                        dan udin dari jawa, meski berbeda suku dan kebudayaan mereka masih tetap bersahabat bersama.</p>
                    <p>Selesai mereka latihan paduan suara, made, samsul dan udin berkumpul dengan teman-temannya yang
                        lain memberitahukan makna lagu satu nusa, satu bangsa yang mereka nyanyikan. Saat semuanya
                        berkumpul, siti yang baru selesai membacakan undang-undang langsung berlari menuju tempat
                        teman-temannya. Sebab terburu-buru ia pun tersandung bebatuan dan jatuh. Udin pun segera
                        menolong siti yang hampir menangis karena rasa sakit di kakinya. Kemudian siti pun duduk
                        bersama-sama membahas mengenai lagu satu nusa, satu bangsa dan tentang keberagaman budaya
                        mereka.</p>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="w-full max-w-5xl flex flex-col md:flex-row justify-between items-center mt-4 gap-6">
            <!-- Tombol Keluar & Simpan -->
            <a href="{{ route('materi.index') }}" onclick="tandaiSelesai(event, this.href, 3)"
                class="bg-[#FFB3B3] w-full md:w-auto justify-center brutal-border brutal-shadow-sm brutal-hover text-black px-8 py-5 md:px-10 md:py-6 rounded-[3rem] font-black uppercase tracking-widest text-lg md:text-xl flex items-center gap-4 text-center transform hover:-translate-y-2 transition-transform">
                Keluar & Simpan Progres
            </a>

            <!-- Tombol Lanjut -->
            <a href="{{ route('materi.belajar', ['step' => 3, 'soal_ke' => 1]) }}"
                onclick="tandaiSelesai(event, this.href, 3)"
                class="bg-[#D4F1BE] w-full md:w-auto justify-center brutal-border brutal-shadow-sm brutal-hover text-black px-8 py-5 md:px-12 md:py-6 rounded-[3rem] font-black uppercase tracking-widest text-xl md:text-2xl flex items-center gap-4 text-center transform hover:-translate-y-2 transition-transform">
                Mulai Tantangan Kamera!
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="w-6 h-6 text-black">
                        <path opacity="0.2"
                            d="M4 8a2 2 0 0 1 2-2h1.5l1-1.5h7l1 1.5H18a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8z" />
                        <path d="M12 18a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9zm0-2.5a2 2 0 1 1 0-4 2 2 0 0 1 0 4z" />
                    </svg>
                </span>
            </a>
        </div>
    </div>

    <script>
        function tandaiSelesai(event, nextUrl, tahapKe) {
            event.preventDefault();

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
                    score: 0
                })
            }).then(() => {
                window.location.href = nextUrl;
            }).catch(() => {
                window.location.href = nextUrl;
            });
        }
    </script>
</x-student-layout>