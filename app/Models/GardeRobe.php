<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GardeRobe extends Model
{
    protected $fillable = [
        'couleur_ garde_robes ',
        'image',
        'type_garde_robe_id',
        
        
    ];
    use HasFactory;
}
