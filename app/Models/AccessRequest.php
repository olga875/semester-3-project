<?php

namespace App\Models;

use App\Enums\AccessLevels;
use App\Enums\ApprovalState;
use App\Policies\AccessPolicy;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Model;

#[UsePolicy(AccessPolicy::class)]
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
