<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProgress extends Model
{
    // 👇 Tambahkan baris ini untuk memaksa Laravel memakai tabel yang benar 👇
    protected $table = 'user_progresses';

    protected $fillable = [
        'user_id',
        'materi_id',
        'tahap',
        'score',
        'is_completed'
    ];

    // Relasi balik ke User (Siswa)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi balik ke Materi
    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }
}