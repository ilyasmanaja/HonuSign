<x-student-layout>
    <div class="max-w-4xl w-full px-6 py-12 flex flex-col items-center">
        <!-- Progress Bar (Tahap 2) -->
        <div class="w-full mb-10">
            <div class="flex justify-between mb-2">
                <span class="text-xs font-black text-blue-600 uppercase tracking-widest">Tahap 2: Jawab Pertanyaan</span>
                <span class="text-xs font-black text-slate-400 uppercase tracking-widest">Misi 2 dari 6</span>
            </div>
            <div class="w-full bg-slate-200 dark:bg-slate-800 h-3 rounded-full overflow-hidden border-2 border-white">
                <div class="bg-blue-500 h-full transition-all duration-1000" style="width: 33.3%"></div>
            </div>
        </div>

        <!-- Pertanyaan -->
        <div class="bg-white dark:bg-slate-900 border-4 border-slate-200 p-8 rounded-[3rem] w-full text-center shadow-lg mb-8">
            <h2 class="text-2xl font-black text-slate-800 dark:text-white uppercase">
                "Siapakah tokoh yang menggunakan pakaian teluk belanga?"
            </h2>
        </div>

        <!-- Slot Jawaban (Tempat Huruf yang Dipilih) -->
        <div id="answer-slots" class="flex flex-wrap justify-center gap-4 mb-12 min-h-[120px] w-full p-6 bg-slate-50 dark:bg-slate-800/50 rounded-[2rem] border-4 border-dashed border-slate-300">
            <!-- Huruf akan muncul di sini saat diklik -->
        </div>

        <!-- Pilihan Huruf Isyarat (Diacak) -->
        <div class="text-center mb-6">
            <p class="text-slate-400 font-bold uppercase text-xs tracking-widest mb-4">Pilih Isyarat yang Benar:</p>
            <div id="options" class="flex flex-wrap justify-center gap-4">
                @php
                    $jawaban = "BURUNG";
                    $hurufArray = str_split($jawaban);
                    shuffle($hurufArray); // Acak hurufnya
                @endphp

                @foreach($hurufArray as $index => $h)
                    <div onclick="pickLetter('{{ $h }}', this)" 
                         class="cursor-pointer bg-white dark:bg-slate-700 p-2 rounded-2xl border-4 border-slate-200 hover:border-pink-500 hover:-translate-y-1 transition-all shadow-md">
                        <img src="{{ asset('images/sibi/' . $h . '.jpg') }}" alt="{{ $h }}" class="w-16 h-16 object-contain">
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Tombol Reset & Cek -->
        <div class="flex gap-4">
            <button onclick="resetGame()" class="bg-slate-200 text-slate-600 px-6 py-3 rounded-2xl font-black uppercase text-sm">Ulangi</button>
            <button id="next-btn" class="hidden bg-green-500 text-white px-10 py-3 rounded-2xl font-black uppercase text-sm shadow-[0_5px_0_0_#15803d]">Lanjut! 🚀</button>
        </div>
    </div>

    <script>
        const correctAnswer = "BURUNG";
        let currentInput = "";

        function pickLetter(letter, element) {
            const slotContainer = document.getElementById('answer-slots');
            
            // Tambahkan visual huruf ke slot
            const newLetter = document.createElement('div');
            newLetter.className = "bg-pink-500 p-2 rounded-2xl border-4 border-white shadow-lg animate-bounce-short";
            newLetter.innerHTML = `<img src="/images/sibi/${letter}.jpg" class="w-16 h-16 object-contain">`;
            slotContainer.appendChild(newLetter);

            currentInput += letter;
            element.classList.add('opacity-0', 'pointer-events-none'); // Sembunyikan huruf yang sudah dipilih

            // Cek jika panjangnya sudah sama
            if (currentInput.length === correctAnswer.length) {
                if (currentInput === correctAnswer) {
                    alert("Yeeay! Jawaban Kamu BENAR! 🎉");
                    document.getElementById('next-btn').classList.remove('hidden');
                } else {
                    alert("Waduh, urutannya masih salah. Coba lagi yuk!");
                    resetGame();
                }
            }
        }

        function resetGame() {
            currentInput = "";
            document.getElementById('answer-slots').innerHTML = "";
            const options = document.querySelectorAll('#options div');
            options.forEach(opt => opt.classList.remove('opacity-0', 'pointer-events-none'));
        }
    </script>
</x-student-layout>