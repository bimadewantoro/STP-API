<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MentoringPeserta extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'nilai_penugasan',
        'lampiran_path',
        'tanggal_upload',
    ];
}
