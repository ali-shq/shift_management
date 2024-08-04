<?php

namespace App\Models;

use App\ShiftProblem\SkilledEntity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
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
        foreach ($this->employments as $employment) {

        }
        //TODO use the employment
        return true;
    }

    public function updateAvailability(Spot $changingSpot, bool $isPlacement = true)
    {
        //if we placed the employee it will be unavailable for the other spots, so placement is more what we are
        //looking at, but we may keep it separately for the snowball effect
    }

    public function skills(): BelongsToMany 
    {
        return $this->belongsToMany(Skill::class)->withPivot(['preference']);
    }

    public function shifts(): BelongsToMany 
    {
        return $this->belongsToMany(Shift::class)->withPivot(['preference']);
    }

    public function places(): BelongsToMany 
    {
        return $this->belongsToMany(Place::class)->withPivot(['preference']);
    }

    public function employments(): HasMany 
    {
        return $this->hasMany(Employment::class);
    }

    public function scopeGetActive(Builder $query, $startDate, $endDate): void
    {
        $query->whereIsActive(true)->whereHas('employments', fn($e) => $e->active($startDate, $endDate));
    }

    public function scopeIdIn(Builder $query, array $ids): void
    {
        $query->whereIn('id', $ids);
    }

}
