<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('materi_images', function (Blueprint $table) {
            // Menambahkan kolom teks (nullable karena tidak semua tipe butuh teks)
            $table->text('teks')->nullable()->after('tipe');
            
            // Menambahkan kolom urutan (default 0) agar gambar/kartu tampil teratur
            $table->integer('urutan')->default(0)->after('teks');
        });
    }

    public function down(): void
    {
        Schema::table('materi_images', function (Blueprint $table) {
            $table->dropColumn(['teks', 'urutan']);
        });
    }
};