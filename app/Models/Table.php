<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    //use HasFactory;

    protected $fillable = [
        'current_height',
        'location_building',
        'location_room',
        'name'
    ];
}

// still needs the things given by the API added