<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * represents a place to be filled
 */
class Spot extends BaseModel
{
    use HasFactory;

    public function employee(): HasOne 
    {
        return $this->hasOne(Employee::class);
    }

    public function shift(): HasOne 
    {
        return $this->hasOne(Shift::class);
    }

    public function place(): HasOne 
    {
        return $this->hasOne(Place::class);
    }

    public function shiftProblem(): BelongsTo 
    {
        return $this->belongsTo(ShiftProblem::class);
    }
}
