<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoWorkSpace extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_workspace',
        'alamat',
        'kapasitas',
        'nomor_pengurus',
        'biaya_harian',
        'biaya_mingguan',
        'biaya_bulanan',
        'biaya_tahunan',
        'fasilitas',
    ];
}
