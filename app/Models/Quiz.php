<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    // Tambahkan ini supaya Seeder bisa mengisi datanya[cite: 2]
    protected $fillable = [
        'tipe',
        'pertanyaan',
        'jawaban_benar',
        'pilihan_data'
    ];
}