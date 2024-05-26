<?php

namespace App\ShiftProblem;

use App\Models\BaseModel;
use App\Models\Spot;

Class SkilledEntity
{
    use ModelAccessor;

    public $default_available = true;
    public $static_availability_rule;
    public $static_preference_rule;
    // public $skill_set_rules = []; //what is provided, what skills are available
    public $dynamic_availability_rule;    
    public $dynamic_preference_rule;

    protected bool $placed = false;
    protected bool $tentatively_un_placed = false;

    public $all_spots = [];

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
        if ($this->tentatively_un_placed) {
            return true;
        }

        if ($this->placed) {
            return false;
        }

    }
}
