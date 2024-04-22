<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    protected $fillable = [
        'sexe',
        'morphologie',
        'image',
        'user_id',
        
    ];
    use HasFactory;
}
