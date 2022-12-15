<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    use HasFactory;

    public $table = 'user_details';

    protected $fillable = [
        'user_id',
        'profile_image',
        'profile_call_number',
        'profile_age',
        'profile_address_province',
        'profile_address_city',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
