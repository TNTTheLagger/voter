<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vote extends Model
{
    protected $fillable = ['user_id', 'color'];

    // Define relationship with User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
