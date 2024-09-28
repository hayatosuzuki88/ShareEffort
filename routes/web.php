<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoutineController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentRoutineController;
use App\Http\Controllers\CommentPostController;
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



/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', function () {
    return view('welcome');
});
*/


Route::get('/', [HomeController::class, 'home'])->middleware(['auth', 'verified'])->name('home');
    
    
Route::controller(RoutineController::class)->middleware(['auth'])->group(function(){

    Route::get('/routines/create', 'create')->name('routine.create');
    
    Route::post('/routines/store', 'store')->name('routine.store');
    
    Route::get('/routines/like/{routine_id}', 'like')->name('routine.like');
    
    Route::get('/routines/unlike/{routine_id}', 'unlike')->name('routine.unlike');

    Route::get('/routines/{routine_id}', 'show')->name('routine.show');
    
});

Route::controller(GoalController::class)->middleware(['auth'])->group(function(){
    
    Route::get('/goals/create', 'create')->name('goal.create');
    
    Route::post('/goals/store', 'store')->name('goal.store');
    
});

Route::controller(PlanController::class)->middleware(['auth'])->group(function(){
    
    Route::get('/plans/create', 'create')->name('plan.create');
    
    Route::post('/plans/store', 'store')->name('plan.store');
    
});

Route::controller(TaskController::class)->middleware(['auth'])->group(function(){
    
   Route::get('/tasks/manage', 'manage')->name('task.manage');
   
   Route::get('get_events', 'getEvents');

});

Route::controller(PostController::class)->middleware(['auth'])->group(function() {
    
    Route::get('/posts/create', 'create')->name('post.create');
    
    Route::post('posts/store', 'store')->name('post.store');
    
    Route::get('posts/all', 'all')->name('post.all');
    
    Route::get('/posts/like/{post_id}', 'like')->name('post.like');
    
    Route::get('/posts/unlike/{post_id}', 'unlike')->name('post.unlike');
    
    Route::get('posts/{post_id}', 'show')->name('post.show');
    
    Route::delete('/posts/{post_id}/delete', 'delete')->name('post.delete');
});

Route::controller(UserController::class)->middleware(['auth'])->group(function(){
    
    Route::get('/users/follow/{user_id}', 'follow')->name('user.follow');
    
    Route::get('/users/removefollow/{user_id}', 'removefollow')->name('user.follow.remove');
    
    Route::get('/users/{user_id}', 'show')->name('user.show');
});

Route::controller(CommentRoutineController::class)->middleware(['auth'])->group(function() {
   
   Route::post('/routines/{routine_id}/comments', 'store')->name('routine.comment.store');
   
   Route::put('/comments/{comment_id}/like', 'like')->name('routine.comment.like');
   
   Route::get('/comments/{comment_id}', 'destroy')->name('routine.comment.remove');
   
});

Route::controller(CommentPostController::class)->middleware(['auth'])->group(function() {
   
   Route::post('/posts/{post_id}/comments', 'store')->name('post.comment.store');
   
   Route::put('/posts/comments/{comment_id}/like', 'like')->name('routine.comment.like');
   
   Route::get('/posts/comments/{comment_id}', 'destroy')->name('post.comment.remove');
   
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
