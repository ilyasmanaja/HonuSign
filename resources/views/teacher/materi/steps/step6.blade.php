<x-admin-layout>
    <div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        
        <div class="mb-8 text-center md:text-left">
            <h1 class="text-3xl font-black text-black uppercase tracking-tight">Tahap 6: Sketsa Mewarnai</h1>
            <p class="text-sm font-bold text-slate-500 mt-1">Materi: {{ $materi->judul }}</p>
            
            <div class="mt-6 flex items-center justify-between relative">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="h-2 w-full bg-slate-200 border-2 border-black rounded-full"></div>
                </div>
                <div class="relative flex items-center justify-center bg-[#D4F1BE] border-4 border-black text-black rounded-full w-12 h-12 font-black z-10 shadow-[4px_4px_0_#000]">✓</div>
                <div class="relative flex items-center justify-center bg-[#D4F1BE] border-4 border-black text-black rounded-full w-12 h-12 font-black z-10 shadow-[4px_4px_0_#000]">✓</div>
                <div class="relative flex items-center justify-center bg-[#D4F1BE] border-4 border-black text-black rounded-full w-12 h-12 font-black z-10 shadow-[4px_4px_0_#000]">✓</div>
                <div class="relative flex items-center justify-center bg-[#D4F1BE] border-4 border-black text-black rounded-full w-12 h-12 font-black z-10 shadow-[4px_4px_0_#000]">✓</div>
                <div class="relative flex items-center justify-center bg-[#D4F1BE] border-4 border-black text-black rounded-full w-12 h-12 font-black z-10 shadow-[4px_4px_0_#000]">✓</div>
                <div class="relative flex items-center justify-center bg-[#FFF5B8] border-4 border-black text-black rounded-full w-12 h-12 font-black z-10 shadow-[4px_4px_0_#000] animate-pulse">6</div>
            </div>
        </div>

        @if ($errors->any())
            <div class="mb-6 p-4 bg-[#FFB3B3] border-4 border-black shadow-[4px_4px_0_#000] rounded-xl font-black text-black">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('teacher.materi.save.step', ['mapel_slug' => $mapel->slug, 'materi_slug' => $materi->slug, 'step' => 6]) }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 md:p-10 brutal-border brutal-shadow rounded-[2rem] space-y-10">
            @csrf

            <div class="bg-[#BEE9E8] p-8 rounded-2xl border-4 border-black shadow-[4px_4px_0_#000]">
                <div class="flex items-center justify-between gap-3 mb-6 border-b-4 border-black pb-4">
                    <div class="flex items-center gap-3">
                        <span class="text-4xl">🎨</span>
                        <h3 class="text-3xl font-black text-black uppercase tracking-tight">Upload Sketsa Kanvas</h3>
                    </div>
                </div>
                
                <div class="mb-8 bg-[#FFFEFA] p-5 border-2 border-dashed border-black rounded-xl space-y-3">
                    <p class="text-base font-black text-red-600">⚠️ PENTING: ATURAN GAMBAR SKETSA</p>
                    <ul class="list-disc pl-5 text-sm font-bold text-slate-700 space-y-2">
                        <li>Gambar harus berupa <b>garis tepi (outline) berwarna hitam</b>.</li>
                        <li>Bagian dalam gambar harus <b>berwarna putih atau transparan (PNG)</b> agar anak-anak bisa mewarnainya.</li>
                        <li>Sistem menggunakan metode <i>Multiply</i>, jadi jangan unggah gambar yang sudah penuh warna!</li>
                    </ul>
                </div>

                <div class="bg-white p-6 border-4 border-black rounded-xl relative shadow-sm hover:-translate-y-1 transition-transform text-center">
                    
                    <label class="font-black text-black block mb-4 text-lg">Pilih Gambar Sketsa (PNG/JPG/JPEG):</label>
                    
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-4 border-black border-dashed rounded-xl bg-slate-50 hover:bg-[#FFF5B8] transition-colors cursor-pointer relative" id="upload-box">
                        <div class="space-y-2 text-center pointer-events-none">
                            <span class="text-5xl">🖼️</span>
                            <div class="text-sm text-black font-black">Klik untuk Mengunggah File</div>
                            <p class="text-xs text-slate-500 font-bold">Maksimal ukuran file: 5MB</p>
                        </div>
                        <input type="file" name="sketsa_mewarnai" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" required id="file-input">
                    </div>
                    
                    <p id="file-name" class="mt-4 font-black text-indigo-600 text-sm hidden"></p>

                </div>
            </div>

            <div class="flex flex-col md:flex-row justify-between items-center pt-4 gap-4 border-t-4 border-slate-100 mt-6">
                <a href="{{ route('teacher.materi.edit.step', ['mapel_slug' => $mapel->slug, 'materi_slug' => $materi->slug, 'step' => 5]) }}" class="font-black text-black uppercase hover:underline">
                    ← Kembali ke Tahap 5
                </a>
                <button type="submit" class="w-full md:w-auto bg-[#FFD1E3] px-10 py-5 rounded-2xl border-4 border-black font-black text-black text-xl shadow-[6px_6px_0_#000] hover:-translate-y-1 active:translate-y-2 transition-transform cursor-pointer uppercase tracking-widest">
                    Simpan & Selesai! 🎉
                </button>
            </div>
        </form>
    </div>

    <script>
        const fileInput = document.getElementById('file-input');
        const uploadBox = document.getElementById('upload-box');
        const fileNameDisplay = document.getElementById('file-name');

        fileInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                uploadBox.classList.add('bg-[#D4F1BE]');
                uploadBox.classList.remove('bg-slate-50', 'hover:bg-[#FFF5B8]');
                fileNameDisplay.textContent = "✅ File Terpilih: " + this.files[0].name;
                fileNameDisplay.classList.remove('hidden');
            }
        });
    </script>
</x-admin-layout>