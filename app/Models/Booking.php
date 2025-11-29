<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    //use HasFactory;

    protected $fillable = [
        'table_id',
        'user_id',
        'start_time',
        'end_time',
        'booked_day'
    ];
}
