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
                Belajar Bersama
            </h2>

            <!-- Animasi Guru Menjelaskan & Murid Mendengarkan -->
            <div
                class="relative w-full max-w-sm h-64 bg-[#BEE9E8] brutal-border rounded-[2rem] p-4 flex items-center justify-between mb-8 mx-auto overflow-hidden shadow-inner">
                <!-- Guru (Left) -->
                <div class="flex flex-col items-center z-10 w-1/3">
                    <span class="text-5xl animate-bounce">👩‍🏫</span>
                    <span
                        class="text-xs font-black text-black bg-[#FFF5B8] px-3 py-1 rounded-xl brutal-border mt-3 shadow-[2px_2px_0_#000]">Guru</span>
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
                    <span
                        class="text-xs font-black text-black bg-[#D4F1BE] px-3 py-1 rounded-xl brutal-border mt-3 shadow-[2px_2px_0_#000]">Murid</span>
                </div>

                <!-- Big Ear / listening focus indicator -->
                <div class="absolute right-4 top-4 text-3xl animate-ping opacity-75">
                    👂
                </div>
            </div>

            <!-- Penjelasan Teks -->
            <div class="flex flex-col gap-4 text-left w-full bg-[#F8FAFC] brutal-border p-6 rounded-2xl mb-8 shadow-sm">
                <div class="flex items-start gap-3">
                    <span
                        class="bg-[#FFF5B8] w-8 h-8 rounded-xl brutal-border flex items-center justify-center font-black text-black text-sm shrink-0 mt-0.5">1</span>
                    <p class="font-bold text-slate-700 text-sm md:text-base"><b>Bersama Guru</b>: Aktivitas belajar ini
                        dilakukan bersama guru di dalam kelas.</p>
                </div>
                <div class="flex items-start gap-3">
                    <span
                        class="bg-[#D4F1BE] w-8 h-8 rounded-xl brutal-border flex items-center justify-center font-black text-black text-sm shrink-0 mt-0.5">2</span>
                    <p class="font-bold text-slate-700 text-sm md:text-base"><b>Perhatikan Materi</b>: Klik kartu
                        keberagaman untuk mengeja isyaratnya dan tonton video penjelasan.</p>
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

    <!-- Interactive Spelling Modal -->
    <div id="spelling-modal"
        class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm hidden flex-col items-center justify-center opacity-0 transition-all duration-300 z-[6000]">
        <div class="bg-[#FFF9F0] brutal-border brutal-shadow p-6 md:p-8 rounded-[3rem] max-w-4xl w-full mx-4 transform scale-90 transition-transform duration-500 relative flex flex-col max-h-[90vh]"
            id="spelling-modal-content">

            <button onclick="closeSpellingModal()"
                class="absolute top-4 right-4 bg-white brutal-border brutal-shadow-sm w-12 h-12 rounded-full flex items-center justify-center text-black hover:bg-[#FFB3B3] transition-all transform hover:rotate-90 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="w-6 h-6 text-black">
                    <path
                        d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z" />
                </svg>
            </button>

            <div class="text-center mb-4">
                <span
                    class="inline-block px-4 py-1.5 bg-[#FFF5B8] text-black brutal-border brutal-shadow-sm rounded-xl text-xs font-black uppercase tracking-wider mb-2">Ejaan
                    Kata</span>
                <h2 id="spelling-modal-title"
                    class="text-2xl md:text-3xl font-black text-black tracking-tight uppercase">
                    Nama Keberagaman
                </h2>
            </div>

            <!-- Image of diversity card inside modal -->
            <div class="flex justify-center mb-6">
                <div class="bg-[#D4F1BE] p-3 brutal-border brutal-shadow-sm rounded-[2rem] transform -rotate-1 cursor-zoom-in hover:scale-105 transition-all duration-300 w-full max-w-[360px] md:max-w-[480px]"
                    onclick="zoomImage()" title="Klik untuk memperbesar">
                    <img id="spelling-modal-image" src="" alt="Gambar Keberagaman"
                        class="w-full h-44 md:h-60 object-cover rounded-2xl brutal-border bg-white">
                </div>
            </div>

            <!-- Spelling letter container (Scrollable) -->
            <div id="spelling-hands-container"
                class="flex-grow overflow-y-auto p-4 flex flex-col items-center justify-start gap-4">
                <!-- Word boxes will be injected here -->
            </div>

            <div class="mt-4 flex justify-center">
                <button onclick="closeSpellingModal()"
                    class="bg-[#D4F1BE] text-black px-8 py-3 rounded-2xl font-black brutal-border brutal-shadow-sm brutal-hover cursor-pointer uppercase">
                    Mengerti
                </button>
            </div>
        </div>
    </div>

    <!-- Image Zoom Overlay -->
    <div id="image-zoom-overlay"
        class="fixed inset-0 bg-slate-900/95 backdrop-blur-md hidden flex-col items-center justify-center opacity-0 transition-all duration-300 z-[7000] cursor-zoom-out"
        onclick="closeImageZoom()">
        <div class="relative transform scale-90 transition-transform duration-300 flex flex-col items-center justify-center max-w-[90vw] max-h-[85vh]"
            id="image-zoom-content">
            <!-- Close Button with Black 'X' -->
            <button onclick="closeImageZoom()"
                class="absolute -top-16 right-0 bg-white brutal-border brutal-shadow-sm w-12 h-12 rounded-full flex items-center justify-center text-black hover:bg-[#FFB3B3] transition-all transform hover:rotate-90 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="w-6 h-6 text-black">
                    <path
                        d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z" />
                </svg>
            </button>
            <div
                class="bg-[#FFFEFA] p-6 brutal-border brutal-shadow rounded-[3rem] flex flex-col items-center max-w-2xl w-full">
                <img id="zoomed-image" src="" alt="Gambar Diperbesar"
                    class="w-full max-h-[70vh] object-contain rounded-2xl brutal-border bg-white">
                <p class="mt-4 text-2xl font-black text-black uppercase tracking-wider text-center"
                    id="zoomed-image-title"></p>
            </div>
        </div>
    </div>

    <div class="max-w-5xl w-full px-6 py-12 flex flex-col items-center">

        <!-- Progress Bar -->
        <div class="w-full mb-10 max-w-3xl">
            <div class="flex justify-between mb-4 items-end">
                <span class="font-black text-xl tracking-widest uppercase text-black">Keberagaman</span>
            </div>
            <div class="w-full h-8 bg-white brutal-border brutal-shadow-sm rounded-2xl overflow-hidden p-1">
                <div class="h-full bg-[#E0BBE4] rounded-xl transition-all duration-1000 border-r-4 border-black"
                    style="width: 66.6%"></div>
            </div>
        </div>

        <!-- Header Judul -->
        <div class="text-center mb-10">
            <h1 class="text-4xl md:text-5xl font-black text-black uppercase tracking-tighter transform -rotate-1 mb-2">
                Keberagaman <span class="text-[#E0BBE4] text-outline drop-shadow-[0_4px_0_#000]">Indonesia</span>
            </h1>
        </div>

        <!-- Kontainer Utama Materi -->
        <div class="w-full bg-[#E0BBE4] brutal-border brutal-shadow rounded-[3rem] p-6 md:p-8 mb-10">
            <div class="bg-[#FFFEFA] brutal-border brutal-shadow-sm rounded-[2rem] p-6 md:p-10">

                <!-- Intro Paragraph (Simplified for deaf accessibility) -->
                <p class="text-xl md:text-2xl text-slate-700 leading-relaxed font-bold mb-10 text-justify">
                    Indonesia memiliki banyak keberagaman sosial dan budaya.
                    Keberagaman sosial contohnya: perbedaan pekerjaan dan agama.
                    Keberagaman budaya contohnya: adat istiadat, bahasa daerah, dan kesenian.
                    Berikut adalah contoh keberagaman di Indonesia:
                </p>

                <!-- Grid Keberagaman -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                    @php
                        $keberagaman = [
                            'Bahasa Daerah' => ['file' => 'bahasa_daerah.png', 'color' => '#BEE9E8'],
                            'Agama dan Kepercayaan' => ['file' => 'agama.png', 'color' => '#FFD1E3'],
                            'Pakaian Tradisional' => ['file' => 'pakaian_adat.png', 'color' => '#FFF5B8'],
                            'Suku Bangsa' => ['file' => 'suku_bangsa.png', 'color' => '#D4F1BE'],
                            'Tarian Daerah' => ['file' => 'tarian.png', 'color' => '#E0BBE4'],
                            'Musik Daerah' => ['file' => 'musik.png', 'color' => '#BEE9E8'],
                            'Rumah Adat' => ['file' => 'rumah_adat_riau.png', 'color' => '#FFD1E3'],
                            'Makanan Khas' => ['file' => 'makanan_riau.png', 'color' => '#FFF5B8'],
                            'Adat Istiadat' => ['file' => 'nikah_melayu.png', 'color' => '#D4F1BE'],
                        ];
                        $i = 1;
                    @endphp

                    @foreach ($keberagaman as $judul => $data)
                        <div onclick="showSpellingModal('{{ $judul }}', '{{ $data['file'] }}')"
                            class="cursor-pointer brutal-border brutal-shadow-sm rounded-[2rem] overflow-hidden hover:-translate-y-2 transition-all duration-300 transform active:scale-95 group"
                            style="background-color: {{ $data['color'] }}">
                            <div class="w-full h-40 brutal-border border-t-0 border-l-0 border-r-0 relative flex items-center justify-center overflow-hidden"
                                style="background-color: {{ $data['color'] }}">
                                <img src="{{ asset('images/tahap4/' . $data['file']) }}" alt="{{ $judul }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                    onerror="this.parentElement.classList.add('bg-slate-100')">
                                <!-- Hover helper for deaf children -->
                                <div
                                    class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                    <span
                                        class="bg-[#FFF5B8] text-black px-4 py-2 rounded-xl brutal-border brutal-shadow-sm font-black text-xs uppercase tracking-wider scale-90 group-hover:scale-100 transition-transform">
                                        Eja Isyarat
                                    </span>
                                </div>
                            </div>
                            <div class="p-4 text-center border-t-4 border-black"
                                style="background-color: {{ $data['color'] }}">
                                <h3 class="font-black text-black text-base md:text-lg">
                                    {{ $i++ }}. {{ $judul }}
                                </h3>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Video Section: Sumpah Pemuda -->
                <div class="my-10 w-full flex flex-col items-center">
                    <div class="flex items-center gap-3 mb-6">
                        <h4 class="text-xl md:text-2xl font-black text-black">Sejarah Bahasa Persatuan</h4>
                    </div>
                    <div
                        class="w-full bg-black brutal-border brutal-shadow rounded-[2rem] overflow-hidden aspect-video relative flex items-center justify-center">
                        <video controls class="w-full h-full object-cover z-10">
                            <source src="{{ asset('videos/sumpah_pemuda_isyarat.mp4') }}" type="video/mp4">
                            Browser kamu tidak mendukung tag video.
                        </video>
                    </div>
                </div>

                <!-- Info Paragraph 1 (Simplified, wrapper removed) -->
                <p class="text-xl md:text-2xl text-slate-700 leading-relaxed font-bold mb-10 text-justify">
                    Keberagaman membuat Indonesia menjadi negara yang sangat kaya akan budaya.
                    Tetapi, perbedaan juga bisa membuat kita sulit saling mengerti.
                    Oleh karena itu, kita membutuhkan alat pemersatu, yaitu <b>Bahasa Indonesia</b>.
                    Dengan Bahasa Indonesia, kita semua bisa berkomunikasi dan bekerja sama dengan baik.
                </p>

                <!-- Info Paragraph 2 (Simplified, wrapper removed) -->
                <p class="text-xl md:text-2xl text-slate-700 leading-relaxed font-bold mb-10 text-justify">
                    Pada tanggal <b>28 Oktober 1928</b> (Kongres Pemuda), lahirlah Bahasa Indonesia sebagai bahasa
                    persatuan.
                    Bahasa Indonesia menyatukan seluruh rakyat Indonesia dari berbagai budaya yang berbeda.
                    Dengan adanya bahasa persatuan, kita semua dapat hidup rukun, saling memahami, dan tetap bersatu
                    erat.
                </p>

            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="w-full max-w-5xl flex justify-center gap-12 items-center mt-8 px-4">
            <!-- Tombol Keluar & Simpan (Visual House Icon) -->
            <a href="{{ route('materi.index') }}" onclick="tandaiSelesai(event, this.href, 4)"
                class="bg-[#FFB3B3] w-20 h-20 flex items-center justify-center brutal-border brutal-shadow-sm brutal-hover text-black rounded-full transform hover:-translate-y-2 transition-transform"
                title="Keluar & Simpan">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10">
                    <path opacity="0.2" d="M12 3L2 12h3v8h14v-8h3L12 3z" />
                    <path d="M12 3L2 12h3v8h14v-8h3L12 3zm0 2.83L18.17 12H17v6H7v-6H5.83L12 5.83z"
                        fill="currentColor" />
                </svg>
            </a>

            <!-- Tombol Lanjut (Visual Right Chevron Play Icon) -->
            <a href="{{ route('materi.belajar', ['step' => 5]) }}" onclick="tandaiSelesai(event, this.href, 4)"
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

        function showSpellingModal(term, fileName) {
            const cleanTerm = term.toUpperCase().replace(/[^A-Z ]/g, '');
            const modal = document.getElementById('spelling-modal');
            const titleEl = document.getElementById('spelling-modal-title');
            const imgEl = document.getElementById('spelling-modal-image');
            const containerEl = document.getElementById('spelling-hands-container');

            titleEl.textContent = term;
            imgEl.src = `/images/tahap4/${fileName}`;
            containerEl.innerHTML = '';

            const words = cleanTerm.split(' ');
            words.forEach((word, wIdx) => {
                const wordDiv = document.createElement('div');
                wordDiv.className =
                    "flex flex-wrap justify-center gap-2 md:gap-4 mb-4 border-b-2 border-slate-100 pb-4 last:border-b-0 w-full";

                for (let i = 0; i < word.length; i++) {
                    const letter = word[i];

                    const letterCard = document.createElement('div');
                    letterCard.className =
                        "bg-[#FFF5B8] rounded-2xl brutal-border brutal-shadow-sm flex items-center justify-center w-14 h-14 md:w-16 md:h-16 transform hover:scale-110 transition-transform cursor-default";

                    const txt = document.createElement('span');
                    txt.className = "font-black text-2xl md:text-3xl text-black";
                    txt.textContent = letter;

                    letterCard.appendChild(txt);
                    wordDiv.appendChild(letterCard);
                }

                containerEl.appendChild(wordDiv);
            });

            modal.classList.remove('hidden');
            modal.classList.add('flex');
            void modal.offsetWidth;
            modal.classList.remove('opacity-0');
            document.getElementById('spelling-modal-content').classList.remove('scale-90');
            document.getElementById('spelling-modal-content').classList.add('scale-100');
        }

        function closeSpellingModal() {
            const modal = document.getElementById('spelling-modal');
            const content = document.getElementById('spelling-modal-content');
            if (modal && content) {
                modal.classList.add('opacity-0');
                content.classList.remove('scale-100');
                content.classList.add('scale-90');
                setTimeout(() => {
                    modal.classList.remove('flex');
                    modal.classList.add('hidden');
                }, 300);
            }
        }

        function zoomImage() {
            const modalImg = document.getElementById('spelling-modal-image');
            const modalTitle = document.getElementById('spelling-modal-title');
            const zoomOverlay = document.getElementById('image-zoom-overlay');
            const zoomedImg = document.getElementById('zoomed-image');
            const zoomedTitle = document.getElementById('zoomed-image-title');
            const zoomContent = document.getElementById('image-zoom-content');

            if (zoomOverlay && zoomedImg && zoomedTitle && zoomContent) {
                zoomedImg.src = modalImg.src;
                zoomedTitle.textContent = modalTitle.textContent;

                zoomOverlay.classList.remove('hidden');
                zoomOverlay.classList.add('flex');
                void zoomOverlay.offsetWidth;
                zoomOverlay.classList.remove('opacity-0');
                zoomOverlay.classList.add('opacity-100');
                zoomContent.classList.remove('scale-90');
                zoomContent.classList.add('scale-100');
            }
        }

        function closeImageZoom() {
            const zoomOverlay = document.getElementById('image-zoom-overlay');
            const zoomContent = document.getElementById('image-zoom-content');
            if (zoomOverlay && zoomContent) {
                zoomOverlay.classList.remove('opacity-100');
                zoomOverlay.classList.add('opacity-0');
                zoomContent.classList.remove('scale-100');
                zoomContent.classList.add('scale-90');
                setTimeout(() => {
                    zoomOverlay.classList.remove('flex');
                    zoomOverlay.classList.add('hidden');
                }, 300);
            }
        }

        function tandaiSelesai(event, nextUrl, tahapKe) {
            event.preventDefault();

            const btn = event.currentTarget;
            btn.innerHTML = 'Menyimpan... ';
            btn.classList.add('opacity-75', 'cursor-not-allowed');

            fetch('{{ route('materi.save_progress') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    materi_id: {{ $materi->id ?? 1 }},
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
