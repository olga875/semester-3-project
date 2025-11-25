<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
<<<<<<< HEAD
<<<<<<< HEAD
    //use HasFactory;

    protected $fillable = [
        'current_height',
        'location_building',
        'location_room',
        'name'
    ];
}

// still needs the things given by the API added
=======
    //
=======
    protected $fillable = [
        'name',
        'floor',
        'is_active'
    ];
>>>>>>> 3966384 (task three CRUD for admin)
}
>>>>>>> 289fc06 (table selection logic ready and tested)
