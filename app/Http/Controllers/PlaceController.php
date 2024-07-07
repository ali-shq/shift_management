<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;

class PlaceController extends ResourceController
{
    protected array $validations = [
        'name' => 'required|string|min:2|max:40',
    ];

    protected array $withRelations = ['skills', 'shifts'];
}
