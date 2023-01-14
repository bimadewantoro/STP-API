<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelatihan extends Model
{
    use HasFactory;

    public $table = 'pelatihans';

    protected $fillable = [
        'user_id',
        'judul_pelatihan',
        'deskripsi',
        'pembicara',
        'kapasitas',
        'biaya',
        'hari',
        'jam',
        'dokumen_pendukung',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
