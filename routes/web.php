<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

// Make the tasks list the homepage
Route::get('/', [TaskController::class, 'index'])->name('home');

// Resource routes give you: index, create, store, show, edit, update, destroy
Route::resource('tasks', TaskController::class);
