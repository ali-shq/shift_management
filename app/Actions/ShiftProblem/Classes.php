<?php

//allocation problem
//two cases, maximize preferences, or maximize filling of places by skill sets
//each place x time x number of people is a dot to be filled, attached to it are skills that need to be supplied
//presence of someone can be a skill or not, if not something else is needed to fill the place

//for the place x time -> we have skills needed, skills preferred and skills slots available, this last part could be more only for 
//spots available

use Illuminate\Support\Testing\Fakes\Fake;

//what has to be filled
Class Spot {
    public $id;
    public $time; //shift and date
    public $place;
    public $skills_set  = [];
}

Abstract Class Entity {
    public $id;
    public $default_available = true;
    public $skills_set = [];
    public $static_availability_rule;
    public $static_preference_rule;
    // public $skill_set_rules = []; //what is provided, what skills are available
    public $dynamic_availability_rule;    
    public $dynamic_preference_rule;    
}

Class Skill {
    public $id;
    public $name;
}

Class Place {
    public $id;
    public $location;
    public $shifts = [];
    //might matter if different places have different days off, a bit rare
    public $weekly_off_days = [];
    //skill by number
    public $needed_skills = [];
    public $preferred_skills = [];
    //computed
    public $needed_spots = [];
    public $preferred_spots = [];
}

Class ShiftProblem {
    public $places = [];
    public $employees = [];
}

Class ShiftProblemSolution {
    public $shift_problem;
    public $filled_spots = [];
}

#example
Class Employee extends Entity {};

$employee_no = 717;
$skills_no = 7;
$avg_skill = 1.1;
$places = 20;
$avg_spots = 35;
$shifts = 2;

$skills = [];
#for()

$employees = [];
for($i = 0; $i < $employee_no; $i++) {
    $employee = new Employee();
    $employees[] = $employee;
}


Abstract Class Entit {
    public $id;
    public $name;
    public $availability_rules = [];
    public $preference_rules = [];
    public $skill_set_rules = []; //what is provided, what skills are available
    public $default_available = true;
    public $additional_data = [];

    public function fill_available(ShiftProblem $shift_problem) 
    {

    }

     // keep track of equal preferences, see trading maybe?
    public function fill_preferred()
    {

    }  
}