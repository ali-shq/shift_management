<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Employee extends Entity
{
    use HasFactory;

    public function skills(): BelongsToMany 
    {
        return $this->belongsToMany(Skill::class);
    }
}
