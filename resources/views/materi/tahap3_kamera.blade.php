<x-student-layout>
    <div class="max-w-6xl w-full px-6 py-12 flex flex-col items-center">
        <h2 class="text-2xl font-black text-blue-600 uppercase mb-6 text-center">
            Misi {{ $soal_ke }} dari 5: Peragakan Isyarat Berikut!
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 w-full items-start">
            
            <!-- Sisi Kiri: Soal -->
            <div class="flex flex-col gap-6">
                <div class="bg-white dark:bg-slate-900 border-4 border-slate-200 p-8 rounded-[3rem] shadow-lg">
                    <p class="text-slate-500 font-bold uppercase text-xs mb-2">Pertanyaan:</p>
                    <h1 class="text-4xl font-black text-slate-800 dark:text-white uppercase tracking-tighter">
                        "{{ $quiz->jawaban_benar }}"[cite: 2]
                    </h1>
                </div>
                
                {{-- Input Teks Fallback (Jika kamera bermasalah) --}}
                <div class="bg-slate-100 p-6 rounded-3xl border-2 border-dashed border-slate-300">
                    <p class="text-xs font-bold text-slate-400 uppercase mb-3">Ketikan jawaban jika kamera tidak muncul:</p>
                    <input type="text" id="manual-input" placeholder="Ketik di sini..." 
                           class="w-full p-4 rounded-xl border-2 border-slate-200 focus:border-purple-500 outline-none uppercase font-bold text-lg">
                </div>
            </div>

            <!-- Sisi Kanan: Kamera Area -->
            <div class="relative group">
                <div class="absolute -inset-4 bg-gradient-to-tr from-purple-500 to-blue-500 rounded-[4rem] blur-xl opacity-25 group-hover:opacity-40 transition duration-1000"></div>
                
                <div class="relative bg-black rounded-[3rem] border-8 border-slate-800 aspect-square overflow-hidden shadow-2xl">
                    <!-- Video Stream -->
                    <video id="webcam" autoplay playsinline class="w-full h-full object-cover"></video>
                    
                    <!-- Overlay Scanning Effect -->
                    <div class="absolute inset-0 border-4 border-purple-500/50 rounded-[2.5rem] pointer-events-none">
                        <div class="w-full h-1 bg-purple-500 absolute top-0 animate-scan"></div>
                    </div>

                    <!-- Placeholder AI Feedback -->
                    <div id="ai-status" class="absolute bottom-6 left-1/2 -translate-x-1/2 bg-black/60 backdrop-blur-md text-white px-6 py-3 rounded-full text-sm font-bold flex items-center gap-3">
                        <span class="w-3 h-3 bg-yellow-400 rounded-full animate-ping"></span>
                        Menunggu Gerakan Tangan...
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-12 flex gap-4">
            <button onclick="simulateAI()" class="bg-blue-500 text-white p-6 px-10 rounded-2xl font-black uppercase cursor-pointer">
                Simulasikan Isyarat Benar (Testing)
            </button>
            <a href="{{ route('materi.belajar', ['step' => 3, 'soal_ke' => $soal_ke + 1]) }}" 
               id="btn-next" class="hidden bg-teal-500 text-white p-6 px-10 rounded-2xl font-black uppercase">
                Lanjut Soal Berikutnya! 🚀
            </a>
        </div>
    </div>

    <script>
        const video = document.getElementById('webcam');
        const statusText = document.getElementById('ai-status');

        // Minta izin kamera
        if (navigator.mediaDevices.getUserMedia) {
            navigator.mediaDevices.getUserMedia({ video: true })
                .then(function (stream) {
                    video.srcObject = stream;
                })
                .catch(function (error) {
                    console.log("Kamera tidak diizinkan: " + error);
                    statusText.innerHTML = "❌ Kamera Tidak Aktif";
                });
        }

        // Fungsi Simulasi Deteksi AI (Placeholder)
        function simulateAI() {
            statusText.innerHTML = "✅ Gerakan '{{ $quiz->jawaban_benar }}' Terdeteksi!";
            statusText.classList.replace('bg-black/60', 'bg-green-600');
            document.getElementById('btn-next').classList.remove('hidden');
            
            // Suara Efek Berhasil
            const audio = new Audio('https://www.soundjay.com/buttons/sounds/button-3.mp3');
            audio.play();
        }
    </script>

    <style>
        @keyframes scan {
            0% { top: 0; }
            100% { top: 100%; }
        }
        .animate-scan {
            animation: scan 3s linear infinite;
        }
    </style>
</x-student-layout>