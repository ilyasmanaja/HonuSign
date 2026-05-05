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
        Schema::create('materi_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('materi_id')->constrained()->onDelete('cascade'); // Relasi ke materi utama
            $table->string('path'); // Nama file gambar (misal: burung_sketsa.png)
            $table->string('tipe'); // Penanda: 'puzzle', 'mewarnai', atau 'ilustrasi'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materi_images');
    }
};
