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
        'jam_operasional_buka',
        'jam_operasional_tutup',
        'hari_operasional_buka',
        'hari_operasional_tutup',
        'dokumen_cowork_path',
        'image_cowork_path',
    ];
}
