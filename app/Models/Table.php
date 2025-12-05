<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'current_height',
        'name',
        'room_id',
        'company',
        'is_active'
    ];

    // still needs the things given by the API added
}
