<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $fillable = [
        'name',
        'floor',
        'is_active'
    ];

    // still needs the things given by the API added
}
