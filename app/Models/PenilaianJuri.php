<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianJuri extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['proposal_id', 'user_id', 'penerapan_di_masyarakat', 'manfaat', 'keberlangsungan', 'presentasi_penyajian_produk'];
}
