<?php

namespace App\Models;

use App\ShiftProblem\SkilledEntity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends SkilledEntity
{
    use HasFactory;

    protected $searchFields = ['name', 'surname', 'email', 'gender', 'phone'];

    public function fixedSpotPreference(Spot $spot): int
    {
        return 1;
    }

    public function fixedAvailability(Spot $spot): bool
    {
        return true;
    }

    public function updateAvailability(Spot $changingSpot, bool $isPlacement = true)
    {
        
    }

    public function skills(): BelongsToMany 
    {
        return $this->belongsToMany(Skill::class);
    }

    public function employments(): HasMany 
    {
        return $this->hasMany(Employment::class);
    }
}
