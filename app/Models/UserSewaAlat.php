<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSewaAlat extends Model
{
    use HasFactory;
    protected $fillable = [
        'add_alat_sewa_id',
        'user_id',
    ];
}
