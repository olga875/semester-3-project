<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

<<<<<<< HEAD
class Preference extends Model
=======
class Table extends Model
>>>>>>> 3718dc5504ad4c6853f95a254b951b2fd1a7921f
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