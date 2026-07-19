<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Satu Mapel bisa memiliki banyak Materi
    public function materis()
    {
        return $this->hasMany(Materi::class);
    }
}