<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'co_work_space_id',
        'name',
        'path',
    ];

    public function coWorkSpace()
    {
        return $this->belongsTo(CoWorkSpace::class);
    }
}
