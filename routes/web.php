<?php

use Illuminate\Support\Facades\Route;
use App\Http\controllers\UserController;
use App\Http\controllers\ProjectController;
use App\Http\controllers\MilestoneController;
use App\Http\controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

Route::get('/profile/edit',[App\Http\Controllers\HomeController::class, 'edit'])->name('profile.edit')->middleware('auth');
Route::put('/profile/update',[App\Http\Controllers\HomeController::class, 'update'])->name('profile.update')->middleware('auth');

Route::get('/auth/register',function(){
    return view('register');
});


// Route::middleware(['auth'])->group(function () {
//     Route::resource('users', UserController::class);
// });
Route::resource('users', UserController::class, ['middleware' => 'auth']);

// Route::get('projects/{projectId}/milestones', [ProjectController::class, 'milestonesIndex'])
//     ->name('projects.milestones.index');

Route::post('projects/{project}/milestones/{milestone}/tasks/reorder', [TaskController::class, 'reorder'])->name('projects.milestones.tasks.reorder')->middleware('auth');
Route::post('projects/{project}/milestones/{milestone}/tasks/reorder/list', [TaskController::class, 'sortlist'])->name('projects.milestones.tasks.sortlist')->middleware('auth');

Route::resource('projects', ProjectController::class, ['middleware' => 'auth']);
Route::resource('projects.milestones', MilestoneController::class, ['middleware' => 'auth']);
Route::resource('projects.milestones.tasks', TaskController::class, ['middleware' => 'auth']);


