<?php

namespace App\Http\Controllers;

class ShiftController extends ResourceController
{
    protected array $validations = [
        'label' => 'required|string|min:2|max:40',
        'starts_at' => 'required|dateFormat:H:i',
        'ends_at' => 'required|dateFormat:H:i',
    ];

}
