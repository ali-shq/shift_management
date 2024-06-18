<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::get('/word', function () {

    $q = request()->input('q');

    $n = 15;

    $max = 5000;

    $i = 0;

    $words = [];

    while(count($words) < $n && $i++ < $max) {

        if (
            str_starts_with($word = fake()->country(), ucfirst($q)) && 
            !in_array($word, $words)
        ) {
            $words[] = $word;
        }
    }


    return response()->json($words);
});