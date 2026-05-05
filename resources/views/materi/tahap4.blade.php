<x-student-layout>
    <div class="max-w-5xl w-full px-6 py-12 flex flex-col items-center">
        <!-- Progress Bar (Tahap 4) -->
        <div class="w-full mb-10">
            <div class="flex justify-between mb-2">
                <span class="text-xs font-black text-emerald-600 uppercase tracking-widest">Tahap 4: Belajar Keberagaman</span>
                <span class="text-xs font-black text-slate-400 uppercase tracking-widest">Misi 4 dari 6</span>
            </div>
            <div class="w-full bg-slate-200 dark:bg-slate-800 h-3 rounded-full overflow-hidden border-2 border-white dark:border-slate-700">
                <!-- Progress 66% -->
                <div class="bg-emerald-500 h-full transition-all duration-1000" style="width: 66.6%"></div> 
            </div>
        </div>

        <h1 class="text-3xl font-black text-slate-800 dark:text-white uppercase mb-8 tracking-tighter text-center">
            Keberagaman Indonesia 🇮🇩
        </h1>

        <!-- Kontainer Utama Materi -->
        <div class="w-full bg-white dark:bg-slate-900 rounded-[3rem] border-4 border-slate-200 dark:border-slate-800 shadow-2xl overflow-hidden mb-10 p-10 md:p-14">
            
            <!-- Intro Paragraph -->
            <div class="prose prose-lg dark:prose-invert max-w-none text-slate-600 dark:text-slate-300 leading-loose font-medium text-justify mb-10">
                <p>
                    Indonesia adalah negara yang memiliki banyak keberagaman. Keberagaman ini disebut keberagaman sosial dan budaya, yaitu perbedaan dalam kehidupan masyarakat yang meliputi aspek sosial seperti pekerjaan dan agama, serta aspek budaya seperti adat istiadat, bahasa, dan kesenian. Bentuk keberagaman sosial dan budaya di Indonesia antara lain:
                </p>
            </div>

            <!-- Grid 9 Keberagaman (Nanti gambar tinggal kamu ganti di folder public/images/) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                @php
                    $keberagaman = [
                        'Bahasa Daerah' => 'bahasa_daerah.jpg',
                        'Agama dan Kepercayaan' => 'agama.jpg',
                        'Pakaian Tradisional' => 'pakaian_adat.jpg',
                        'Suku Bangsa' => 'suku_bangsa.jpg',
                        'Tarian Daerah' => 'tarian.jpg',
                        'Musik Daerah' => 'musik.jpg',
                        'Rumah Adat' => 'rumah_adat_riau.jpg',
                        'Makanan Khas Daerah' => 'makanan_riau.jpg',
                        'Adat Istiadat' => 'nikah_melayu.jpg'
                    ];
                    $i = 1;
                @endphp

                @foreach($keberagaman as $judul => $gambar)
                <div class="bg-slate-50 dark:bg-slate-800 rounded-3xl border-4 border-slate-200 dark:border-slate-700 overflow-hidden shadow-sm hover:translate-y-[-5px] transition-all">
                    <!-- Placeholder Gambar -->
                    <div class="w-full h-40 bg-slate-200 dark:bg-slate-700 relative flex items-center justify-center border-b-4 border-slate-200 dark:border-slate-700">
                        <img src="{{ asset('images/' . $gambar) }}" alt="{{ $judul }}" class="w-full h-full object-cover" onerror="this.style.display='none'">
                        <span class="absolute text-slate-400 text-sm font-bold opacity-50 text-center px-4">Siapkan gambar:<br>{{ $gambar }}</span>
                    </div>
                    <div class="p-4 text-center">
                        <h3 class="font-black text-slate-700 dark:text-white text-lg">{{ $i++ }}. {{ $judul }}</h3>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Paragraf Penyambung Sumpah Pemuda -->
            <div class="prose prose-lg dark:prose-invert max-w-none text-slate-600 dark:text-slate-300 leading-loose font-medium text-justify mb-10 space-y-6">
                <p>
                    Semua keberagaman tersebut membuat Indonesia menjadi bangsa yang kaya budaya. Namun, perbedaan ini juga bisa membuat masyarakat sulit saling memahami jika tidak ada alat pemersatu. Karena itu, manusia sebagai makhluk sosial membutuhkan komunikasi, interaksi, dan kerja sama dalam kehidupan sehari-hari di keluarga, sekolah, dan masyarakat. Untuk memudahkan semua orang dari berbagai daerah agar bisa saling mengerti, dibutuhkan bahasa persatuan, yaitu Bahasa Indonesia.
                </p>
                <p>
                    Keberagaman ini membuat Indonesia menjadi negara yang kaya akan budaya. Namun, perbedaan ini juga bisa membuat masyarakat sulit saling memahami jika tidak ada alat pemersatu. Oleh karena itu, pada tanggal 28 Oktober 1928 dalam kongres pemuda lahirlah sebuah bahasa pemersatu yakni Bahasa Indonesia yang dapat menjadi perantara komunikasi antar budaya yang berbeda-beda sehingga dapat tercipta kerukunan antar masyarakat.
                </p>
            </div>

            <!-- Video Player (Nanti video tinggal dimasukkan ke folder public/videos/) -->
            <div class="w-full bg-slate-900 rounded-[2rem] overflow-hidden border-8 border-slate-800 shadow-2xl mb-10 aspect-video relative flex items-center justify-center">
                <video controls class="w-full h-full object-cover z-10">
                    <source src="{{ asset('videos/sumpah_pemuda_isyarat.mp4') }}" type="video/mp4">
                    Browser kamu tidak mendukung tag video.
                </video>
                <!-- Teks ini akan tertutup kalau videonya ada -->
                <span class="absolute text-slate-500 font-bold z-0">Siapkan video: sumpah_pemuda_isyarat.mp4</span>
            </div>

            <!-- Closing Paragraph -->
            <div class="prose prose-lg dark:prose-invert max-w-none text-slate-600 dark:text-slate-300 leading-loose font-medium text-justify">
                <p>
                    Bahasa Indonesia sangat berperan penting dalam membentuk komunikasi, hubungan dan relasi antar masyarakat yang penuh dengan keberagaman. Dengan adanya Bahasa Indonesia sebagai bahasa persatuan, seluruh masyarakat Indonesia dapat hidup rukun, saling memahami, dan tetap bersatu meskipun memiliki banyak perbedaan budaya. Terima kasih ^^
                </p>
            </div>
        </div>

        <!-- Tombol Lanjut (Dengan fitur save progress) -->
        <a href="{{ route('materi.belajar', ['step' => 5]) }}" 
           onclick="tandaiSelesai(event, this.href, 4)"
           class="bg-emerald-600 hover:bg-emerald-500 text-white p-6 px-12 rounded-[2.5rem] font-black uppercase shadow-[0_10px_0_0_#059669] active:shadow-none active:translate-y-2 transition-all text-center text-lg w-full md:w-auto">
            Selesai Membaca, Lanjut Tahap 5! 🚀
        </a>
    </div>

    <!-- Script Pengirim Data Progress -->
    <script>
        function tandaiSelesai(event, nextUrl, tahapKe) {
            event.preventDefault(); 

            // Tombol diubah jadi loading state biar kelihatan interaktif
            const btn = event.currentTarget;
            const originalText = btn.innerHTML;
            btn.innerHTML = 'Menyimpan... ⏳';
            btn.classList.add('opacity-75', 'cursor-not-allowed');

            fetch('{{ route('materi.save_progress') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    materi_id: {{ $materi->id ?? 1 }}, // Fallback ke 1 kalau materi kosong
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