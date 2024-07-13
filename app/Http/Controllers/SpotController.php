<?php

namespace App\Http\Controllers;

class SpotController extends ResourceController
{
    protected array $withRelations = ['shift', 'place', 'skills'];
}
