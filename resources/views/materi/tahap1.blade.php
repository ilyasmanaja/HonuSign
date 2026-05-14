<x-student-layout>
    <div class="max-w-6xl mx-auto w-full px-4 py-8 md:py-12 flex flex-col items-center">
        <!-- Progress Bar (Tahap 1) -->
        <div class="w-full mb-10 max-w-3xl">
            <div class="flex justify-between mb-4 items-end">
                <span class="font-black text-xl tracking-widest uppercase text-black">Tahap 1: Membaca</span>
                <span
                    class="text-xl font-black text-black bg-[#FFD1E3] brutal-border px-4 py-1 rounded-2xl transform rotate-2 shadow-[2px_2px_0_#000]">Misi
                    1 dari 6</span>
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
                {{ $materi->judul }}
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
                    <div
                        class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-6 border-b-4 border-slate-200 pb-6">
                        <h3
                            class="font-black text-black uppercase tracking-widest text-xl md:text-2xl flex items-center gap-4">
                            <span
                                class="p-3 bg-[#FFF5B8] brutal-border brutal-shadow-sm rounded-2xl transform -rotate-3 text-3xl">📖</span>
                            SLB Insan Mutiara Pekanbaru
                        </h3>

                        <!-- Tombol Ganti ke Video -->
                        <a href="{{ route('materi.tahap1.video') }}"
                            class="bg-[#BEE9E8] brutal-border brutal-shadow-sm brutal-hover px-6 py-4 md:px-8 md:py-4 rounded-[2rem] font-black text-black text-sm md:text-base uppercase flex items-center gap-3 transform hover:-translate-y-1 transition-all">
                            <span class="text-2xl">🎥</span> Tonton Isyarat SIBI
                        </a>
                    </div>

                    <div class="text-xl md:text-2xl text-slate-700 leading-relaxed font-bold flex-grow space-y-6">

                        <!-- Membersihkan Kelas) -->
                        <div class="my-10 flex justify-center transform -rotate-1">
                            <div
                                class="bg-white p-4 brutal-border brutal-shadow-sm rounded-[2.5rem] inline-block hover:scale-105 transition-transform duration-300">
                                <img src="{{ asset('images/materi/tahap1/kelas.png') }}"
                                    alt="Ilustrasi Membersihkan Kelas"
                                    class="w-full max-w-lg rounded-3xl brutal-border">
                            </div>
                        </div>

                        <!-- Paragraf 1 -->
                        <p>
                            Di kelas 4 SLB Insan Mutiara Pekanbaru, Samsul dan teman-temannya bersiap mengikuti festival
                            budaya untuk merayakan Hari Kemerdekaan 17 Agustus. Sebelum festival, mereka gotong royong
                            membersihkan kelas.
                        </p>

                        <!-- Storyboard Character Cards (Grid 3 Kolom) -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 my-10 relative">
                            <!-- Bintang Hiasan Floating -->
                            <div class="absolute -top-6 -left-6 text-4xl animate-bounce" style="animation-delay: 0s;">✨
                            </div>
                            <div class="absolute -bottom-6 -right-6 text-4xl animate-bounce"
                                style="animation-delay: 0.5s;">⭐</div>

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

                        <!-- Paragraf 2 -->
                        <p>
                            Saat festival, mereka memakai pakaian adat yang berbeda-beda.
                        </p>

                        <!-- Storyboard Character Cards (Grid 3 Kolom) -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 my-10 relative">
                            <!-- Bintang Hiasan Floating -->
                            <div class="absolute -top-6 -left-6 text-4xl animate-bounce" style="animation-delay: 0s;">✨
                            </div>
                            <div class="absolute -bottom-6 -right-6 text-4xl animate-bounce"
                                style="animation-delay: 0.5s;">⭐</div>

                            <!-- Samsul Card -->
                            <div
                                class="bg-[#D4F1BE] p-6 brutal-border brutal-shadow rounded-[2.5rem] flex flex-col items-center text-center hover:-translate-y-2 transition-transform duration-300 z-10">
                                <div
                                    class="bg-white p-3 brutal-border brutal-shadow-sm rounded-3xl mb-6 transform rotate-2 hover:rotate-0 transition-transform">
                                    <img src="{{ asset('images/materi/tahap1/samsul_teluk_belangga.png') }}"
                                        alt="Samsul menyusun kursi"
                                        class="w-full max-w-[200px] rounded-2xl brutal-border">
                                </div>
                                <p class="text-xl md:text-2xl font-black text-black">
                                    Samsul memakai teluk belanga.
                                </p>
                            </div>

                            <!-- Abdul Card -->
                            <div
                                class="bg-[#BEE9E8] p-6 brutal-border brutal-shadow rounded-[2.5rem] flex flex-col items-center text-center hover:-translate-y-2 transition-transform duration-300 transform md:-translate-y-6 z-10">
                                <div
                                    class="bg-white p-3 brutal-border brutal-shadow-sm rounded-3xl mb-6 transform -rotate-2 hover:rotate-0 transition-transform">
                                    <img src="{{ asset('images/materi/tahap1/abdul_kanigaran.png') }}"
                                        alt="Abdul mengelap kaca"
                                        class="w-full max-w-[200px] rounded-2xl brutal-border">
                                </div>
                                <p class="text-xl md:text-2xl font-black text-black">
                                    Abdul memakai kanigaran.
                                </p>
                            </div>

                            <!-- Siti Card -->
                            <div
                                class="bg-[#FFF5B8] p-6 brutal-border brutal-shadow rounded-[2.5rem] flex flex-col items-center text-center hover:-translate-y-2 transition-transform duration-300 z-10">
                                <div
                                    class="bg-white p-3 brutal-border brutal-shadow-sm rounded-3xl mb-6 transform rotate-1 hover:rotate-0 transition-transform">
                                    <img src="{{ asset('images/materi/tahap1/siti_bundo_kanduang.png') }}"
                                        alt="Siti menyapu" class="w-full max-w-[200px] rounded-2xl brutal-border">
                                </div>
                                <p class="text-xl md:text-2xl font-black text-black">
                                    Siti memakai bundo kanduang
                                </p>
                            </div>
                        </div>
                        <p>
                            Awalnya beberapa anak berbicara
                            dengan bahasa daerah, tetapi tidak semua teman mengerti. Guru kemudian mengingatkan untuk
                            memakai Bahasa Indonesia agar semua bisa saling memahami. Mereka berjalan bersama dengan
                            rapi dan terlihat kompak.
                        </p>
                        <div class="my-10 flex justify-center transform rotate-1">
                            <div
                                class="bg-white p-4 brutal-border brutal-shadow-sm rounded-[2.5rem] inline-block hover:scale-105 transition-transform duration-300">
                                <img src="{{ asset('images/materi/tahap1/penghargaan.png') }}"
                                    alt="Penghargaan kelas terbersih" class="w-full max-w-lg rounded-3xl brutal-border">
                            </div>
                        </div>
                        <p>
                            Pada acara 17 Agustus, kelas 4 SLB Insan Mutiara diumumkan sebagai
                            kelas terbersih karena mereka rajin bekerja sama membersihkan kelas. Samsul dan
                            teman-temannya
                            merasa senang dan bangga.
                        </p>

                    </div>

                </div>
            </div>

        </div>

        <!-- Tombol Aksi (Lanjut) -->
        <a href="{{ route('materi.belajar', ['step' => 2]) }}" onclick="tandaiSelesai(event, this.href, 1)"
            class="bg-[#D4F1BE] brutal-border brutal-shadow-sm brutal-hover text-black px-8 py-5 md:px-12 md:py-6 rounded-[3rem] font-black uppercase tracking-widest text-xl md:text-2xl mt-4 flex items-center gap-4 text-center transform hover:-translate-y-2">
            Selesai Membaca, Lanjut! <span class="text-4xl animate-bounce">🚀</span>
        </a>
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