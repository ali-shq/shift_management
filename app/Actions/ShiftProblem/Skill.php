<?php

namespace App\Actions\ShiftProblem;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Skill extends Model
{
    public function entities(): BelongsToMany 
    {
        return $this->belongsToMany(Entity::class);
    }
}
