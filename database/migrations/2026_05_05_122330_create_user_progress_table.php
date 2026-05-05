<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_progresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ID Siswa
            $table->foreignId('materi_id')->constrained()->onDelete('cascade'); // ID Materi (contoh: Halo Apa Kabar)
            $table->integer('tahap'); // Tahap ke berapa (1, 2, 3, 4, 5, 6)
            $table->integer('score')->default(0); // Nilai yang didapat (misal 0 - 100)
            $table->boolean('is_completed')->default(false); // Penanda apakah tahap ini sudah diselesaikan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_progress');
    }
};
