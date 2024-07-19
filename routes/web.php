<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoutineController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\PlanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', function () {
    return view('welcome');
});


Route::controller(HomeController::class)->middleware(['auth'])->group(function(){

    Route::get('/home', 'home')->name('home');
    
});

Route::controller(PlanController::class)->middleware(['auth'])->group(function(){
    
    Route::get('/plan/create', 'create')->name('Pcreate');
    
    Route::post('/plans/post', 'store')->name('Pstore');
    
});

Route::controller(GoalController::class)->middleware(['auth'])->group(function(){
    
    Route::get('/create', 'create')->name('Gcreate');
    
    Route::post('/goals/post', 'store')->name('Gstore');
    
});

Route::controller(RoutineController::class)->middleware(['auth'])->group(function(){

    Route::get('/routines/create', 'create')->name('Rcreate');
    
    Route::post('/routines/post', 'store')->name('Rstore');

    Route::get('/routines/{routine}', 'show')->name('show');
    
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
