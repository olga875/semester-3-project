<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    //use HasFactory;

    protected $fillable = [
        'current_height',
        'name',
        'room_id',
        'company'
    ];
}

// still needs the things given by the API added