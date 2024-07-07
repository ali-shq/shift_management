<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Place extends BaseModel
{
    use HasFactory;

    protected $searchFields = ['name', 'address'];

    public function shifts(): BelongsToMany 
    {
        return $this->belongsToMany(Shift::class);
    }

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class)->withPivot(['needed_employees']);
    }
}
