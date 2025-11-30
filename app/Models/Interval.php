<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// class Preference extends Model
class Interval extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'start_at',
        'end_at',
        'duration',
        'interval_name'
        ];

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
        'duration' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}