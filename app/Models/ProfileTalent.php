<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileTalent extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'profile_image',
        'profile_number',
        'profile_age',
        'profile_address_province',
        'profile_address_city'];
}
