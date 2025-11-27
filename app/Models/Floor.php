<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    use HasUuids;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        "name",
        "company",
        "address",
        "room_num",
        'building_id',
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