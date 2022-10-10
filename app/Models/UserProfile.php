<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pt',
        'bidang',
        'email_pt',
        'no_pt',
        'description',
        'profile_photo',
    ];


    public $appends=[
        'profile_image_url',
    ];

    public function getProfileImageUrlAttribute(){
        if($this->profile_photo){
            return asset('/uploads/profile_images/'.$this->profile_photo);
        }else{
            return 'https://ui-avatars.com/api/?background=random&name='.urlencode($this->nama_pt);
        }
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
