<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\ShiftProblemController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\SpotController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::resource('skills', SkillController::class);
    // Route::resource('skills', SkillController::class)->except(['get']);
    // Route::get('skills/{skill}/{slug}', [SkillController::class, 'show'])->name('skills.show');

    Route::resource('employees', EmployeeController::class);
    Route::resource('shifts', ShiftController::class);
    Route::resource('places', PlaceController::class);
    Route::resource('spots', SpotController::class);
    Route::resource('shiftproblems', ShiftProblemController::class);
    
    Route::resource('posts', PostController::class)->only(['create', 'store']);
    Route::resource('posts.comments', CommentController::class)->shallow()->only(['store', 'update', 'destroy']);

    Route::post('/likes/{type}/{id}', [LikeController::class, 'store'])->name('likes.store');
    Route::delete('/likes/{type}/{id}', [LikeController::class, 'destroy'])->name('likes.destroy');
});

Route::get('posts/{topic?}', [PostController::class, 'index'])->name('posts.index');
Route::get('posts/{post}/{slug}', [PostController::class, 'show'])->name('posts.show');
Route::get('/chat', [ChatController::class, 'index']);
Route::get('/messages', [ChatController::class, 'messages']);
Route::post('/messages', [ChatController::class, 'sendMessage']);