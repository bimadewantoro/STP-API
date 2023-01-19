<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inkubasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'deskripsi',
        'durasi',
        'benefit',
        'akses',
    ];
}
