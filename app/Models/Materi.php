<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    /**
     * 1. $fillable (Mass Assignment)
     * Ini mendaftarkan kolom apa saja yang diizinkan untuk diisi 
     * secara otomatis melalui form atau seeder.
     */
    protected $fillable = [
        'order',
        'judul',
        'slug',
        'video_peragaan',     // Menggunakan nama baru pengganti 'gambar'
        'deskripsi',
        'deskripsi_tambahan'  // Untuk kebutuhan tahap 3/5
    ];

    /**
     * 2. Relasi ke Tabel materi_images
     * Satu materi bisa memiliki banyak gambar (untuk puzzle, mewarnai, dll).
     */
    public function images()
    {
        return $this->hasMany(MateriImage::class);
    }
}