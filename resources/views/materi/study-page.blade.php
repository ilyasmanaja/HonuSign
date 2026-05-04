<x-student-layout>
    <div class="max-w-4xl w-full px-6 py-12 flex flex-col items-center justify-center min-h-[60vh]">
        <h1 class="text-3xl font-black text-slate-800 dark:text-white uppercase mb-12 text-center tracking-tighter">
            Tekan samsul untuk berangkat ke Sekolah! 🏃‍♂️
        </h1>

        <div
            class="relative w-full h-25 bg-slate-100 dark:bg-slate-800 rounded-[3rem] border-8 border-white dark:border-slate-700 shadow-inner overflow-hidden flex items-end px-12">
            <div id="character" class="text-7xl cursor-pointer select-none transition-all duration-100 relative z-10"
                onclick="moveAhead()">
                👦
            </div>
            <div class="absolute right-8 text-7xl">🏫</div>
        </div>

        <p class="mt-8 text-slate-500 font-bold uppercase tracking-widest">
            Progress: <span id="progressText">0</span>%
        </p>
    </div>

    <script>
        let progress = 0;
        function moveAhead() {
            const char = document.getElementById('character');
            const text = document.getElementById('progressText');
            progress += 10; // 10 kali klik untuk sampai

            char.style.left = progress + '%';
            text.innerText = progress;

            if (progress >= 90) {
                window.location.href = "{{ route('materi.belajar', ['step' => 1]) }}";
            }
        }
    </script>
</x-student-layout>