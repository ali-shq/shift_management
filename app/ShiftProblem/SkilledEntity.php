<?php

namespace App\ShiftProblem;

use App\Models\BaseModel;
use App\Models\Spot;

abstract class SkilledEntity
{
    use ModelAccessor;

    public $spots_preference = [];
    
    //fixed fit and availabity
    public array $fixed_spot_availability = [];
    public array $spot_availability = [];

    public function __construct(BaseModel $model)
    {
        $this->_new($model);
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

    abstract public function spotPreference(Spot $spot): int;
    abstract public function fixedAvailability(Spot $spot): bool;
    //isPlacement false = is removal after being placed
    abstract public function updateAvailability(bool $isPlacement = true, Spot $changingSpot);
}
