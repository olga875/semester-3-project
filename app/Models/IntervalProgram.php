<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IntervalProgram extends Model
{
    //use HasFactory;

    protected $fillable = [
        'id',
        'is_standing',
        'time_amount',
        'interval_id'
    ];
}
