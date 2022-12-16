<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilTenant extends Model
{
    use HasFactory;

    protected $fillable =  
    [
        'nama_perusahaan',
        'alamat_perusahaan',
        'email_perusahaan',
        'nomor_perusahaan',
        'ketua_perusahaan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
