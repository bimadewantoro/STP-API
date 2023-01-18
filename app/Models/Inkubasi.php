<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inkubasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'tentang',
        'durasi',
        'benefit',
        'akses',
    ];
}
