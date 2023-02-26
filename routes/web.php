<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;

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
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->group(/*'/dashboard',*/ function () {
    /*return view('dashboard');*/
    /*changes*/
    Route::get('/dashboard',[TasksController::class,'index'])->name('dashboard');
    
    Route::get('/add-task',[TasksController::class,'add'])->name('addTask');
    Route::post('/create-task',[TasksController::class,'create'])->name('createTask');
    
    Route::get('/edit-task/{task}',[TasksController::class,'edit'])->name('editTask');
    Route::post('/update-task/{task}',[TasksController::class,'update'])->name('updateTask');
    Route::delete('/delete-task/{task}', [TasksController::class, 'delete'])->name('deleteTask');

});/*->name('dashboard');*/
