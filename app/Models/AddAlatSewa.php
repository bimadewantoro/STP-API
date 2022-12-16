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
        'no_seri',
        'merk',
        'tahun_pembelian',
        'pemilik',
        'alamat',
        'biaya_harian',
        'biaya_mingguan',
        'biaya_bulanan',
        'biaya_tahunan',
        'file_path',
        'image_path_banner'];
}
