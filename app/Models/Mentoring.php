<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mentoring extends Model
{
    use HasFactory;

    public $table = 'mentorings';

    protected $fillable = 
    [
        'user_id',
        'judul_mentoring',  
        'tanggal_mulai',
        'durasi',
        'judul_tugas',  
        'deskripsi',
        'image_path_banner',  
        'deadline_pengumpulan',
        'status_pengumpulan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
