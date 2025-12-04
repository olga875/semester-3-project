<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// class Preference extends Model
class Interval extends Model
{
    protected $table = 'interval';
    
    protected $fillable = [
        'user_id',
        'interval_name',
        'last_used_at',
    ];

    protected $casts = [
        'last_used_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function programs()
    {
        return $this->hasMany(IntervalProgram::class);
    }
}