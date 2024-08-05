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
    // protected array $withRelations = ['spots'];

    // public function index(Request $request)
    // {
    //     $this->generateNew($request);
    // }

    public function generateNew(Request $request)
    {
        $startDate = Carbon::createFromFormat('Y-m-d H:i', $request->input('start_date_time'));
        $endDate = Carbon::createFromFormat('Y-m-d H:i', $request->input('end_date_time'));

        $shiftProblem = new ShiftProblem(['start_date_time' => $startDate, 'end_date_time' => $endDate]);

        $shiftProblem->save();

        $employees = Employee::getActive($startDate, $endDate);

        $places = Place::with(['shifts', 'skills'])->whereIsActive(true)->get();

        $shiftProblem->all_employees = $employees->pluck('id')->toArray();
        $shiftProblem->all_places = $places->pluck('id')->toArray();

        $shiftProblem->save();
    }

    protected function generateSpots(ShiftProblem $shiftProblem) 
    {
        $spots = [];

        $startDate = $shiftProblem->start_date_time;
        $endDate = $shiftProblem->end_date_time;

        $places = Place::idIn($shiftProblem->all_places);

        while ($startDate <= $endDate) {
            foreach ($places as $place) {
                foreach ($place->skills as $skill) {
                    foreach ($place->shifts as $shift) {
                        /** @var Carbon $startDate */
                        $neededEmployees = $skill->pivot->needed_employees;
                        while ($neededEmployees-- > 0) {
                            $spots[] = $shiftProblem->spots()->create([
                                'shift_id' => $shift->id,
                                'place_id' => $place->id,
                                'skill_id' => $skill->id,
                                'start_date_time' => $startDate->format('Y-m-d') . ' ' . $shift->starts_at,
                                'end_date_time' => $startDate->format('Y-m-d') . ' ' . $shift->ends_at,
                            ]);
                        }
                    }
                }
            }
            $startDate = $startDate->addDay();
        }

        return $spots;
    }

    public function solve(ShiftProblem $shiftProblem) 
    {
        $allEmployees = Employee::with(['skills', 'shifts', 'places'])->idIn($shiftProblem->all_employees)->get();
    }
}
