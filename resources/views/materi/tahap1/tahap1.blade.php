<x-student-layout>
    <div class="max-w-5xl w-full px-6 py-12 flex flex-col items-center">
        <!-- Progress Bar (Tahap 1) -->
        <div class="w-full mb-10 max-w-3xl">
            <div class="flex justify-between mb-4 items-end">
                <span class="font-black text-xl tracking-widest uppercase text-black">Membaca</span>
            </div>
            <div class="w-full h-8 bg-white brutal-border brutal-shadow-sm rounded-2xl overflow-hidden p-1">
                <div class="h-full bg-[#BEE9E8] rounded-xl transition-all duration-1000 border-r-4 border-black"
                    style="width: 16.6%"></div>
            </div>
        </div>

        <!-- Header Judul Materi -->
        <div class="text-center mb-10">
            <h1
                class="text-4xl md:text-6xl font-black text-[#FFF5B8] text-outline uppercase tracking-tighter transform -rotate-1 drop-shadow-[0_6px_0_#000]">
                Festival Budaya Kemerdekaan Indonesia
            </h1>
        </div>

        <!-- Konten Materi (Fokus Teks Cerita Bergambar) -->
        <div class="w-full flex justify-center mb-10">

            <!-- Card Utama Cerita -->
            <div
                class="w-full max-w-5xl bg-[#FFD1E3] brutal-border brutal-shadow rounded-[3rem] p-6 md:p-8 flex flex-col h-full">
                <div
                    class="bg-[#FFFEFA] brutal-border brutal-shadow-sm rounded-[2rem] p-6 md:p-10 flex-grow flex flex-col relative">

                    <!-- Header Card & Tombol Video -->
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

                        <!-- Tombol Ganti ke Video (Visual-Only TV Icon) -->
                        <a href="{{ route('materi.tahap1.video') }}"
                            class="bg-[#BEE9E8] brutal-border brutal-shadow-sm brutal-hover p-4 rounded-2xl flex items-center justify-center transform hover:-translate-y-1 transition-all"
                            title="Tonton Isyarat SIBI">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-9 h-9 text-black">
                                <rect x="2" y="7" width="20" height="13" rx="3" opacity="0.2"
                                    fill="currentColor" />
                                <path d="M8.5 3L12 7M15.5 3L12 7" stroke="currentColor" stroke-width="2.5"
                                    stroke-linecap="round" />
                                <rect x="2" y="7" width="20" height="13" rx="3" fill="none"
                                    stroke="currentColor" stroke-width="2.5" />
                                <path d="M10.5 11v5l4-2.5-4-2.5z" fill="currentColor" />
                            </svg>
                        </a>
                    </div>

                    <div class="text-xl md:text-2xl text-slate-700 leading-relaxed font-bold flex-grow space-y-6">

                        <!-- Membersihkan Kelas -->
                        <div class="my-10 flex justify-center transform -rotate-1">
                            <div
                                class="bg-white p-4 brutal-border brutal-shadow-sm rounded-[2.5rem] inline-block hover:scale-105 transition-transform duration-300">
                                <img src="{{ asset('images/materi/tahap1/kelas.png') }}"
                                    alt="Ilustrasi Membersihkan Kelas"
                                    class="w-full max-w-lg rounded-3xl brutal-border">
                            </div>
                        </div>

                        <!-- Paragraf 1 (Justified) -->
                        <p class="text-justify">
                            Di kelas 4 SLB Insan Mutiara Pekanbaru, Samsul dan teman-temannya mengikuti festival budaya
                            Hari Kemerdekaan 17 Agustus. Sebelum festival, mereka bersama-sama membersihkan kelas.

                            <!-- Storyboard Character Cards (Grid 3 Kolom) -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 my-10 relative">

                            <!-- Samsul Card -->
                            <div
                                class="bg-[#D4F1BE] p-6 brutal-border brutal-shadow rounded-[2.5rem] flex flex-col items-center text-center hover:-translate-y-2 transition-transform duration-300 z-10">
                                <div
                                    class="bg-white p-3 brutal-border brutal-shadow-sm rounded-3xl mb-6 transform rotate-2 hover:rotate-0 transition-transform">
                                    <img src="{{ asset('images/materi/tahap1/samsul_menyusun_kursi.png') }}"
                                        alt="Samsul menyusun kursi"
                                        class="w-full max-w-[200px] rounded-2xl brutal-border">
                                </div>
                                <p class="text-xl md:text-2xl font-black text-black">
                                    Samsul menyusun kursi
                                </p>
                            </div>

                            <!-- Abdul Card -->
                            <div
                                class="bg-[#BEE9E8] p-6 brutal-border brutal-shadow rounded-[2.5rem] flex flex-col items-center text-center hover:-translate-y-2 transition-transform duration-300 transform md:-translate-y-6 z-10">
                                <div
                                    class="bg-white p-3 brutal-border brutal-shadow-sm rounded-3xl mb-6 transform -rotate-2 hover:rotate-0 transition-transform">
                                    <img src="{{ asset('images/materi/tahap1/abdul_mengelap_kaca.png') }}"
                                        alt="Abdul mengelap kaca"
                                        class="w-full max-w-[200px] rounded-2xl brutal-border">
                                </div>
                                <p class="text-xl md:text-2xl font-black text-black">
                                    Abdul mengelap kaca
                                </p>
                            </div>

                            <!-- Siti Card -->
                            <div
                                class="bg-[#FFF5B8] p-6 brutal-border brutal-shadow rounded-[2.5rem] flex flex-col items-center text-center hover:-translate-y-2 transition-transform duration-300 z-10">
                                <div
                                    class="bg-white p-3 brutal-border brutal-shadow-sm rounded-3xl mb-6 transform rotate-1 hover:rotate-0 transition-transform">
                                    <img src="{{ asset('images/materi/tahap1/siti_menyapu.png') }}" alt="Siti menyapu"
                                        class="w-full max-w-[200px] rounded-2xl brutal-border">
                                </div>
                                <p class="text-xl md:text-2xl font-black text-black">
                                    Siti menyapu
                                </p>
                            </div>
                        </div>

                        <!-- Pakaian Adat -->
                        <div class="my-10 flex justify-center transform rotate-1">
                            <div
                                class="bg-white p-4 brutal-border brutal-shadow-sm rounded-[2.5rem] inline-block hover:scale-105 transition-transform duration-300">
                                <img src="{{ asset('images/materi/tahap1/pakaian_adat.png') }}" alt="Pakaian Adat"
                                    class="w-full max-w-lg rounded-3xl brutal-border">
                            </div>
                        </div>

                        <!-- Paragraf 2 (Justified) -->
                        <p class="text-justify">
                            Saat festival, mereka memakai baju adat yang berbeda-beda.
                        </p>

                        <!-- Storyboard Character Cards (Grid 3 Kolom) -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 my-10 relative">

                            <!-- Samsul Card -->
                            <div
                                class="bg-[#D4F1BE] p-6 brutal-border brutal-shadow rounded-[2.5rem] flex flex-col items-center text-center hover:-translate-y-2 transition-transform duration-300 z-10">
                                <div
                                    class="bg-white p-3 brutal-border brutal-shadow-sm rounded-3xl mb-6 transform rotate-2 hover:rotate-0 transition-transform">
                                    <img src="{{ asset('images/materi/tahap1/samsul_teluk_belangga.png') }}"
                                        alt="Samsul memakai baju Riau"
                                        class="w-full max-w-[200px] rounded-2xl brutal-border">
                                </div>
                                <p class="text-xl md:text-2xl font-black text-black">
                                    Samsul memakai baju Riau
                                </p>
                            </div>

                            <!-- Abdul Card -->
                            <div
                                class="bg-[#BEE9E8] p-6 brutal-border brutal-shadow rounded-[2.5rem] flex flex-col items-center text-center hover:-translate-y-2 transition-transform duration-300 transform md:-translate-y-6 z-10">
                                <div
                                    class="bg-white p-3 brutal-border brutal-shadow-sm rounded-3xl mb-6 transform -rotate-2 hover:rotate-0 transition-transform">
                                    <img src="{{ asset('images/materi/tahap1/abdul_kanigaran.png') }}"
                                        alt="Abdul memakai baju Jawa"
                                        class="w-full max-w-[200px] rounded-2xl brutal-border">
                                </div>
                                <p class="text-xl md:text-2xl font-black text-black">
                                    Abdul memakai baju Jawa
                                </p>
                            </div>

                            <!-- Siti Card -->
                            <div
                                class="bg-[#FFF5B8] p-6 brutal-border brutal-shadow rounded-[2.5rem] flex flex-col items-center text-center hover:-translate-y-2 transition-transform duration-300 z-10">
                                <div
                                    class="bg-white p-3 brutal-border brutal-shadow-sm rounded-3xl mb-6 transform rotate-1 hover:rotate-0 transition-transform">
                                    <img src="{{ asset('images/materi/tahap1/siti_bundo_kanduang.png') }}"
                                        alt="Siti memakai baju Minang"
                                        class="w-full max-w-[200px] rounded-2xl brutal-border">
                                </div>
                                <p class="text-xl md:text-2xl font-black text-black">
                                    Siti memakai baju Minang
                                </p>
                            </div>
                        </div>

                        <!-- Paragraf 3 (Justified) -->
                        <p class="text-justify">
                            Mereka berjalan bersama dengan semangat. Pada tanggal 17 Agustus, kelas 4 SLB Insan Mutiara
                            menjadi juara kelas terbersih karena anak-anaknya rajin membersihkan kelas. Samsul dan
                            teman-temannya merasa senang sekali.
                        </p>

                        <!-- Penghargaan -->
                        <div class="my-10 flex justify-center transform rotate-1">
                            <div
                                class="bg-white p-4 brutal-border brutal-shadow-sm rounded-[2.5rem] inline-block hover:scale-105 transition-transform duration-300">
                                <img src="{{ asset('images/materi/tahap1/penghargaan.png') }}"
                                    alt="Penghargaan kelas terbersih" class="w-full max-w-lg rounded-3xl brutal-border">
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>

        <!-- Tombol Aksi (Visual-Only - Centered for better UX) -->
        <div class="w-full max-w-5xl flex justify-center gap-12 items-center mt-8 px-4">
            <!-- Tombol Keluar & Simpan (Visual House Icon) -->
            <a href="{{ route('materi.index') }}" onclick="tandaiSelesai(event, this.href, 1)"
                class="bg-[#FFB3B3] w-20 h-20 flex items-center justify-center brutal-border brutal-shadow-sm brutal-hover text-black rounded-full transform hover:-translate-y-2 transition-transform"
                title="Keluar & Simpan">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10">
                    <path opacity="0.2" d="M12 3L2 12h3v8h14v-8h3L12 3z" />
                    <path d="M12 3L2 12h3v8h14v-8h3L12 3zm0 2.83L18.17 12H17v6H7v-6H5.83L12 5.83z"
                        fill="currentColor" />
                </svg>
            </a>

            <!-- Tombol Lanjut (Visual Right Chevron Play Icon) -->
            <a href="{{ route('materi.belajar', ['step' => 2]) }}" onclick="tandaiSelesai(event, this.href, 1)"
                class="bg-[#D4F1BE] w-20 h-20 flex items-center justify-center brutal-border brutal-shadow-sm brutal-hover text-black rounded-full transform hover:-translate-y-2 transition-transform"
                title="Lanjut">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-12 h-12">
                    <circle cx="12" cy="12" r="10" opacity="0.2" />
                    <path d="M10 17V7l7 5-7 5z" fill="currentColor" />
                </svg>
            </a>
        </div>
    </div>

    <script>
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
