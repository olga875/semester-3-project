<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// class Preference extends Model
class Interval extends Model
{
    //use HasFactory;

    protected $fillable = [
        'user_id',
        'interval_name'
    ];
}
