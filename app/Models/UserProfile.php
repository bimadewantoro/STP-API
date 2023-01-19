<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'username',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
