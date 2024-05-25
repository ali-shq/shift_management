<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Skill extends BaseModel
{
    use HasFactory;

    public function employees(): BelongsToMany 
    {
        return $this->belongsToMany(Employee::class);
    }

    public function places(): BelongsToMany 
    {
        return $this->belongsToMany(Place::class);
    }
}
