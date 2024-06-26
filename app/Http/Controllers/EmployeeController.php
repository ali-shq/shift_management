<?php

namespace App\Http\Controllers;

class EmployeeController extends ResourceController
{
    protected array $validations = [
        'name' => 'required|string|min:2|max:40',
        'surname' => 'string|min:2|max:40',
        'email' => 'email',
        'gender' => 'required|in:male,female'
    ];

    protected array $withRelations = ['skills', 'employments'];
}
