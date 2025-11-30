<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasUuids;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        "name",
        "company",
        "address",
        "table_num",
        "floor_id",
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