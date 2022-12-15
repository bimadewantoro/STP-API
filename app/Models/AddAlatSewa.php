<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddAlatSewa extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'nama_alat',
        'alamat',
        'kapasitas',
        'nomor_pengurus',
        'biaya_harian',
        'biaya_mingguan',
        'biaya_bulanan',
        'biaya_tahunan',
        'dokumen_pendukung'];
}
