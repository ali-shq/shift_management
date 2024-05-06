<?php

namespace App\Actions\ShiftProblem;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EntityData extends Model
{
    public function entity(): BelongsTo 
    {
        return $this->belongsTo(Entity::class);
    }
}
