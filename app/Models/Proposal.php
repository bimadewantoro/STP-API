<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['user_id', 'proposal_judul', 'proposal_kategori', 'proposal_bab1', 'proposal_bab2', 'proposal_bab3', 'proposal_bab4', 'proposal_bab5', 'proposal_bab6'];
}
