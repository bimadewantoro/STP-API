<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormPendaftaran extends Model
{
    use HasFactory;

    public $table = 'form_pendaftarans';

    protected $fillable = [
        'user_id',
        'profil_bisnis',
        'model_bisnis',
        'deskripsi',
        'strategi_marketing',
        'profil_pemilik',
        'jumlah_pegawai',
        'projeksi_keuangan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
