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
        Schema::table('materis', function (Blueprint $table) {
            // Menghapus kolom kategori yang sudah tidak dipakai
            $table->dropColumn('kategori');

            // Menambahkan kolom order untuk menentukan urutan materi (Materi 1, 2, 3...)
            $table->integer('order')->default(0)->after('id');

            // Mengubah kolom 'gambar' menjadi 'video' agar lebih deskriptif untuk Tahap 1
            $table->renameColumn('gambar', 'video_peragaan');

            // Tambahkan kolom untuk materi Tahap 3 (Diskusi) atau Tahap 5 (Explain)
            $table->text('deskripsi_tambahan')->nullable()->after('deskripsi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('materis', function (Blueprint $table) {
            $table->enum('kategori', ['abjad', 'kata', 'kalimat'])->default('abjad');
            $table->dropColumn('order');
            $table->renameColumn('video_peragaan', 'gambar');
            $table->dropColumn('deskripsi_tambahan');
        });
    }
};
