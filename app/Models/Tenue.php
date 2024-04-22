<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenue extends Model
{
    protected $fillable = [
        'avatar_id ',
        'garde_robe_id',
        'imagetenus_id',
        
        
    ];
    use HasFactory;
}
