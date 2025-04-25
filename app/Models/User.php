<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Database\Eloquent\Relations\{HasOne, BelongsTo};


class User extends Authenticable
{
    public function detail(): HasOne {
        return $this->hasOne(UserDetail::class);
    }

    public function department(): BelongsTo {
        return $this->belongsTo(Department::class);
    }
}
