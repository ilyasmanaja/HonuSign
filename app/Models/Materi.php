<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    /**
     * 1. $fillable (Mass Assignment)
     */
    protected $fillable = [
        'mapel_id',           // WAJIB DITAMBAHKAN
        'order',
        'judul',
        'slug',
        'video_peragaan',
        'deskripsi',
        'deskripsi_tambahan',
    ];

    /**
     * 2. Relasi ke Tabel materi_images
     */
    public function images()
    {
        return $this->hasMany(MateriImage::class);
    }

    /**
     * 3. Relasi ke Tabel mapels
     */
    public function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }

    /**
     * 4. Relasi ke Tabel quizzes (WAJIB DITAMBAHKAN UNTUK TAHAP 2, 3, 5)
     */
    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }
}