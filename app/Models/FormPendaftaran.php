<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormPendaftaran extends Model
{
    use HasFactory;

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
}
