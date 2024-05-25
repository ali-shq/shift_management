<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Place extends Model
{
    use HasFactory;

    public function shifts(): BelongsToMany 
    {
        return $this->belongsToMany(Shift::class);
    }

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class)->as('needed_employees')->withPivot(['needed_employees']);
    }
}
