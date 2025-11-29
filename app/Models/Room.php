<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        "name",
        "company",
        "address",
        "table_num",
    ];

    public function tables () 
    {
        return $this->hasMany(Table::class);
    }

    public function floor()
    {
        return $this->belongsTo(Floor::class);
    }

}