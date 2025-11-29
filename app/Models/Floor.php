<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    protected $fillable = [
        "name",
        "company",
        "address",
        "room_num",
    ];

    public function rooms () 
    {
        return $this->hasMany(Room::class);
    }

    public function building()
    {
        return $this->belongsTo(Building::class);
    }

}