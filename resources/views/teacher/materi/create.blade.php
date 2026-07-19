<x-admin-layout>
    <div class="max-w-4xl mx-auto py-10 px-6">
        <h2 class="text-3xl font-black text-black mb-8 uppercase">Input Materi Tahap 1</h2>

        {{-- Session Success & Error Messages --}}
        @if (session('success'))
            <div class="mb-6 p-4 bg-[#D4F1BE] brutal-border rounded-xl font-black text-black">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 p-4 bg-[#FFB3B3] brutal-border rounded-xl font-black text-black">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            action="{{ route('teacher.materi.store', ['mapel_slug' => $mapel->slug ?? request()->route('mapel_slug')]) }}"
            method="POST" enctype="multipart/form-data"
            class="bg-white p-8 md:p-10 brutal-border brutal-shadow rounded-[2rem] space-y-8">
            @csrf

            <div class="bg-[#F8FAFC] p-6 rounded-2xl brutal-border border-2">
                <h3 class="text-xl font-black text-black mb-4 border-b-4 border-slate-200 pb-2">1. Info Utama & Video
                </h3>

                <div class="mb-4">
                    <label class="font-black text-black block mb-2">Judul Materi:</label>
                    <input type="text" name="judul"
                        class="w-full p-4 brutal-border rounded-xl font-bold focus:outline-none"
                        placeholder="Contoh: Mengenal Pancasila" required>
                </div>

                <div class="mb-4">
                    <label class="font-black text-black block mb-2">Upload Video Peragaan (SIBI):</label>
                    <input type="file" name="video_peragaan" accept="video/mp4,video/quicktime"
                        class="w-full p-4 brutal-border rounded-xl font-bold bg-[#BEE9E8]">
                    <small class="text-slate-500 font-bold block mt-1">*Format: .mp4, .mov (Opsional)</small>
                </div>
            </div>

            <div class="bg-[#FFF5B8] p-6 rounded-2xl brutal-border border-2">
                <h3 class="text-xl font-black text-black mb-4 border-b-4 border-slate-200 pb-2">2. Bacaan (Bagian Atas)
                </h3>

                <div class="mb-4">
                    <label class="font-black text-black block mb-2">Ilustrasi Atas (Opsional):</label>
                    <input type="file" name="ilustrasi_atas" accept="image/*"
                        class="w-full p-4 brutal-border rounded-xl font-bold bg-white">
                </div>

                <div class="mb-4">
                    <label class="font-black text-black block mb-2">Deskripsi / Paragraf 1 (HTML):</label>
                    <textarea name="deskripsi" rows="4"
                        class="w-full p-4 brutal-border rounded-xl font-bold focus:outline-none bg-white"
                        placeholder="<p>Teks paragraf pertama di sini...</p>"></textarea>
                </div>
            </div>

            <div class="bg-[#D4F1BE] p-6 rounded-2xl brutal-border border-2">
                <h3 class="text-xl font-black text-black mb-4 border-b-4 border-slate-200 pb-2">3. Storyboard (Cerita 1)
                </h3>
                <p class="text-sm font-bold mb-4">Isi maksimal 3 kartu cerita bergambar.</p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @for ($i = 1; $i <= 3; $i++)
                        <div class="bg-white p-4 rounded-xl brutal-border">
                            <label class="font-black text-black block mb-1">Gambar {{ $i }}:</label>
                            <input type="file" name="cerita_1_gambar[]" accept="image/*"
                                class="w-full p-2 brutal-border rounded-lg mb-2 text-sm">

                            <label class="font-black text-black block mb-1">Teks {{ $i }}:</label>
                            <input type="text" name="cerita_1_teks[]"
                                class="w-full p-2 brutal-border rounded-lg font-bold text-sm"
                                placeholder="Teks singkat">
                        </div>
                    @endfor
                </div>
            </div>

            <div class="bg-[#FFF5B8] p-6 rounded-2xl brutal-border border-2">
                <h3 class="text-xl font-black text-black mb-4 border-b-4 border-slate-200 pb-2">4. Bacaan (Bagian
                    Tengah)</h3>

                <div class="mb-4">
                    <label class="font-black text-black block mb-2">Ilustrasi Tengah (Opsional):</label>
                    <input type="file" name="ilustrasi_tengah" accept="image/*"
                        class="w-full p-4 brutal-border rounded-xl font-bold bg-white">
                </div>

                <div class="mb-4">
                    <label class="font-black text-black block mb-2">Deskripsi Tambahan / Paragraf 2 (HTML):</label>
                    <textarea name="deskripsi_tambahan" rows="4"
                        class="w-full p-4 brutal-border rounded-xl font-bold focus:outline-none bg-white"
                        placeholder="<p>Teks paragraf kedua di sini...</p>"></textarea>
                </div>
            </div>

            <div class="bg-[#D4F1BE] p-6 rounded-2xl brutal-border border-2">
                <h3 class="text-xl font-black text-black mb-4 border-b-4 border-slate-200 pb-2">5. Storyboard (Cerita 2)
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @for ($i = 1; $i <= 3; $i++)
                        <div class="bg-white p-4 rounded-xl brutal-border">
                            <label class="font-black text-black block mb-1">Gambar {{ $i }}:</label>
                            <input type="file" name="cerita_2_gambar[]" accept="image/*"
                                class="w-full p-2 brutal-border rounded-lg mb-2 text-sm">

                            <label class="font-black text-black block mb-1">Teks {{ $i }}:</label>
                            <input type="text" name="cerita_2_teks[]"
                                class="w-full p-2 brutal-border rounded-lg font-bold text-sm"
                                placeholder="Teks singkat">
                        </div>
                    @endfor
                </div>
            </div>

            <div class="bg-[#FFF5B8] p-6 rounded-2xl brutal-border border-2">
                <h3 class="text-xl font-black text-black mb-4 border-b-4 border-slate-200 pb-2">6. Bacaan (Bagian Bawah
                    Akhir)</h3>

                <div class="mb-4">
                    <label class="font-black text-black block mb-2">Teks Paragraf Akhir (HTML):</label>
                    <textarea name="paragraf_akhir" rows="4"
                        class="w-full p-4 brutal-border rounded-xl font-bold focus:outline-none bg-white"
                        placeholder="<p>Teks penutup cerita...</p>"></textarea>
                </div>

                <div class="mb-4">
                    <label class="font-black text-black block mb-2">Ilustrasi Bawah (Opsional):</label>
                    <input type="file" name="ilustrasi_bawah" accept="image/*"
                        class="w-full p-4 brutal-border rounded-xl font-bold bg-white">
                </div>
            </div>

            <button type="submit"
                class="w-full bg-[#FFD1E3] p-6 rounded-2xl font-black text-black text-xl brutal-border brutal-shadow brutal-hover uppercase tracking-widest cursor-pointer mt-8">
                Simpan Materi Tahap 1
            </button>
        </form>
    </div>
</x-admin-layout>
