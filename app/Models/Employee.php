<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Entity
{
    use HasFactory;

    public function skills(): BelongsToMany 
    {
        return $this->belongsToMany(Skill::class);
    }

    public function employments(): HasMany 
    {
        return $this->hasMany(Employment::class);
    }
}
