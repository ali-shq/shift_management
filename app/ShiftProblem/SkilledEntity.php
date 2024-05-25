<?php

namespace App\ShiftProblem;

use App\Models\BaseModel;

Class SkilledEntity
{
    public $default_available = true;
    public $skills_set = [];
    public $static_availability_rule;
    public $static_preference_rule;
    // public $skill_set_rules = []; //what is provided, what skills are available
    public $dynamic_availability_rule;    
    public $dynamic_preference_rule;

    protected bool $placed = false;

    public function __construct(protected BaseModel $model)
    {
    }

    public function __get($name)
    {
        if (property_exists($this->model, $name)) {
            return $this->model->name;
        }
    }

    public function __set($name, $value)
    {
        if (property_exists($this->model, $name)) {
            $this->model->name = $value;
        }
    }

    public function isAvailable($spot): bool 
    {
        if ($this->placed) {
            return false;
        }

        return true;
    }
}
