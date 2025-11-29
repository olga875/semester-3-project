<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

<<<<<<< HEAD
class Preference extends Model
=======
class Booking extends Model
>>>>>>> 3718dc5504ad4c6853f95a254b951b2fd1a7921f
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
