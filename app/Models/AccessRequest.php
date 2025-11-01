<?php

namespace App\Models;

use App\Enums\AccessLevels;
use App\Enums\ApprovalState;
use Illuminate\Database\Eloquent\Model;

class AccessRequest extends Model
{
    protected $fillable = ['user_id', 'level'];

    protected function casts(): array
    {
        return [
            'level' => AccessLevels::class,
            'state' => ApprovalState::class,
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
