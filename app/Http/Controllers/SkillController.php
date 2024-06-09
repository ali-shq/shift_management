<?php

namespace App\Http\Controllers;

class SkillController extends ResourceController
{
    protected array $validations = [
        'name' => 'required|string|min:3|max:20',
        'description' => 'nullable|string|min:10|max:200',
    ];

}
