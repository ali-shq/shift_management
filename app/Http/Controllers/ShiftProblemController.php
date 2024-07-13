<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\ShiftProblem;
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
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $employees = Employee::getActive($startDate, $endDate);

        // var_dump($employees->count());
    }
}
