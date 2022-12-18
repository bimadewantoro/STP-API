<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelatihan extends Model
{
    use HasFactory;
<<<<<<< HEAD

    public $table = 'pelatihans';

    protected $fillable = [
        'user_id',
=======
    
    protected $fillable = [
>>>>>>> master
        'judul_pelatihan',
        'deskripsi',
        'pembicara',
        'kapasitas',
        'biaya',
        'hari',
        'jam',
<<<<<<< HEAD
        'dokumen_pendukung',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
=======
        'dokumen_pelatihan_path',
        'gambar_pelatihan_path',
    ];
>>>>>>> master
}
