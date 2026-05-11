<x-student-layout>
    <div class="max-w-5xl w-full px-6 py-12 flex flex-col items-center">
        <!-- Progress Bar (Tahap 4) -->
        <div class="w-full mb-10">
            <div class="flex justify-between mb-2">
                <span class="text-xs font-black text-blue-500 uppercase tracking-widest">Tahap 5: Memahami</span>
                <span class="text-xs font-black text-slate-400 uppercase tracking-widest">Misi 5 dari 6</span>
            </div>
            <div
                class="w-full bg-slate-200 dark:bg-slate-800 h-3 rounded-full overflow-hidden border-2 border-white dark:border-slate-700">
                <!-- Progress 66% -->
                <div class="bg-blue-500 h-full transition-all duration-1000" style="width: 83.3%"></div>
            </div>
        </div>

        <h1 class="text-3xl font-black text-slate-800 dark:text-white uppercase mb-8 tracking-tighter text-center">
            Ayo kita memahami
        </h1>

        <!-- Kontainer Utama Materi -->
        <div
            class="w-7xl bg-white dark:bg-slate-900 rounded-[3rem] border-4 border-slate-200 dark:border-slate-800 shadow-2xl overflow-hidden mb-10 p-10 md:p-14">

            <!-- Intro Paragraph -->
            <div
                class="prose prose-lg dark:prose-invert max-w-none text-slate-600 dark:text-slate-300 leading-loose font-medium text-justify mb-10">
                <p>
                    Contoh gambar cinta tanah air dan tidak mencintai tanah air Indonesia:
                </p>
            </div>

            <!-- Grid 9 Keberagaman (Nanti gambar tinggal kamu ganti di folder public/images/) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                @php
                    $keberagaman = [
                        'Amir mengikuti upacara dengan khidmat' => 'upacara_bendera.png',
                        'Abdul mencoret-coret dinding kelas' => 'coret_tembok.png',
                        'Ani berbicara saat lagu Indonesia Raya dinyanyikan' => 'ngobrol_upacara.png',
                        'Ariva membuang sampah di Sungai' => 'buang_sampah.png',
                        'Okta berbicara dengan keras saat temannya sedang beribadah.' => 'bicara_solat.png',
                        'Sisca melaksanakan piket dengan sungguh-sungguh' => 'siska_piket.png',
                    ];
                    $i = 1;
                @endphp

                @foreach($keberagaman as $judul => $gambar)
                    <div
                        class="w-fit h-fit bg-slate-50 dark:bg-slate-800 rounded-3xl border-4 border-slate-200 dark:border-slate-700 overflow-hidden shadow-sm hover:-translate-y-1.25 transition-all">
                        <!-- Placeholder Gambar -->
                        <div
                            class="w-fit h-fit bg-slate-200 dark:bg-slate-700 relative flex items-center justify-center border-b-4 border-slate-200 dark:border-slate-700">
                            <img src="{{ asset('images/tahap5/' . $gambar) }}" alt="{{ $judul }}"
                                class="w-full h-full object-cover" onerror="this.style.display='none'">
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Tombol Lanjut (Dengan fitur save progress) -->
            <div class="flex justify-center w-full mt-10">
                <a href="{{ route('materi.belajar', ['step' => 6]) }}" onclick="tandaiSelesai(event, this.href, 5)"
                    class="bg-blue-600 hover:bg-blue-500 text-white p-6 px-12 rounded-[2.5rem] font-black uppercase active:shadow-none active:translate-y-2 transition-all text-center text-lg w-full md:w-auto">
                    Selesai Membaca, Lanjut Tahap 6! 🚀
                </a>
            </div>
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