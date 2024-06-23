<?php

namespace App\Http\Controllers;

use App\Models\BaseModel;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends ResourceController
{
    protected array $withRelations = ['skills', 'employments'];
}
