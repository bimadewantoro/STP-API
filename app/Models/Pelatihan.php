<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelatihan extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'judul_pelatihan',
        'deskripsi',
        'pembicara',
        'kapasitas',
        'biaya',
        'hari',
        'jam',
        'dokumen_pelatihan_path',
        'gambar_pelatihan_path',
    ];
}
