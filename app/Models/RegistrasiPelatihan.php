<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrasiPelatihan extends Model
{
    use HasFactory;

    protected $table = 'registrasi_pelatihans';

    protected $fillable = [
        'pelatihan_id',
        'profile_talent_id',
        'status',
        'bukti_pembayaran_path',
    ];

    public function pelatihan()
    {
        return $this->belongsTo(Pelatihan::class, 'pelatihan_id', 'id');
    }

    public function profile_talent()
    {
        return $this->belongsTo(ProfileTalent::class, 'profile_talent_id', 'id');
    }
}
