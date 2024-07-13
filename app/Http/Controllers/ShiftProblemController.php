<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Place;
use App\Models\ShiftProblem;
use App\Models\Skill;
use App\Models\Spot;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ShiftProblemController extends ResourceController
{
    protected array $withRelations = ['spots'];

    public function index(Request $request)
    {
        $this->generateNew($request);
    }

    public function generateNew(Request $request)
    {
        $startDate = $request->input('start_date_time');
        $endDate = $request->input('end_date_time');

        $shiftProblem = new ShiftProblem(['start_date_time' => $startDate, 'end_date_time' => $endDate]);

        $shiftProblem->save();

        $employees = Employee::getActive($startDate, $endDate);

        $places = Place::with(['shifts', 'skills'])->whereIsActive(true)->get();

        $spots = [];

        foreach ($places as $place) {
            foreach ($place->skills as $skill) {
                foreach ($place->shifts as $shift) {
                    $neededEmployees = $skill->pivot->needed_employees;
                    while($neededEmployees-- > 0) {
                        $spots[] = $shiftProblem->spots()->create([
                            'shift_id' => $shift->id,
                            'place_id' => $place->id,
                            'skill_id' => $skill->id,
                            'start_date_time' => $startDate,
                            'end_date_time' => $endDate,
                        ]);
                    }
                }
            }
        }

        $shiftProblem->all_employees = $employees->pluck('id')->toJson();
        $shiftProblem->all_places = $places->pluck('id')->toJson();

        $shiftProblem->save();
        // var_dump($employees->count());
    }
}
