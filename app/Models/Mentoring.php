<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mentoring extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'judul_mentoring',  
        'tanggal_mulai',
        'durasi',
        'judul_tugas',  
        'deskripsi',
        'image_path_banner',  
        'deadline_pengumpulan',
        'status_pengumpulan',
    ];
}
