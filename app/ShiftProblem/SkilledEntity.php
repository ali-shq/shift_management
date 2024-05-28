<?php

namespace App\ShiftProblem;

use App\Models\BaseModel;
use App\Models\Spot;

abstract class SkilledEntity extends BaseModel
{
    use ModelAccessor;

    public array $spots_preference = [];

    public array $all_spots = [];
    
    //fixed fit and availabity
    public array $fixed_spots_availability = [];
    public array $spots_availability = [];

    public function prepareFixedSpotMappings() 
    {
        /** @var \App\Models\Spot $spot */
        foreach ($this->all_spots as $spot) {
            $doesFit = $this->doesFit($spot);
            $this->fixed_spots_availability[$spot->id] = $doesFit;
            if ($doesFit) {
                $this->fixed_spots_preference[$spot->id] = $this->fixedSpotPreference($spot);
            }
        }
    }

    public function doesFit(Spot $spot): bool
    {
        return in_array($spot->skill->id, $this->skills->pluck('id'));
    }

    //doing the simple version? like an employee can be placed in only one spot, 
    //if we do otherwise, it becomes difficult to track
    public function isAvailable(Spot $spot): bool 
    {
        //this part does not change
        if (!$this->fixed_spot_availability[$spot->id]) {
            return false;
        }

        return $this->spot_availability[$spot->id];
    }

    abstract public function fixedSpotPreference(Spot $spot): int;
    abstract public function fixedAvailability(Spot $spot): bool;
    //isPlacement false = is removal after being placed
    abstract public function updateAvailability(bool $isPlacement = true, Spot $changingSpot);
    // abstract public function updatePreference(bool $isPlacement = true, Spot $changingSpot);
}
