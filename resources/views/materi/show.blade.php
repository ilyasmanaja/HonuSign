<x-student-layout>
    <div class="max-w-6xl w-full px-6 py-12 flex flex-col items-center">

        <div class="w-full flex justify-between items-center mb-8">
            <a href="{{ route('materi.membaca') }}"
                class="text-slate-400 font-bold hover:text-white uppercase text-sm tracking-widest">← Kembali</a>
            <h1 class="text-3xl font-black text-slate-800 dark:text-white uppercase tracking-tighter">
                {{ $materi->judul }}
            </h1>
            <div class="w-20"></div>
        </div>

        {{-- Ganti bagian div video kamu dengan ini sementara --}}
        <div
            class="w-full h-[500px] md:h-[700px] bg-black rounded-[3rem] border-8 border-slate-800 overflow-hidden shadow-2xl mb-8 flex items-center justify-center">
            <video class="w-full h-full object-contain" controls autoplay loop muted>
                {{-- Pakai data dinamis dari database --}}
                <source src="{{ asset('videos/' . $materi->gambar) }}" type="video/mp4">
                Browser kamu tidak mendukung tag video.
            </video>
        </div>

        <div
            class="bg-white dark:bg-slate-800/50 border-4 border-slate-200 dark:border-slate-700 p-8 rounded-[3rem] w-full text-center shadow-lg">
            <h3 class="text-blue-600 dark:text-yellow-400 font-black uppercase tracking-widest text-sm mb-4">Tips
                Gerakan:</h3>
            <p class="text-slate-700 dark:text-white text-xl leading-relaxed font-bold italic">
                "{{ $materi->deskripsi }}"
            </p>
        </div>

    </div>
</x-student-layout>