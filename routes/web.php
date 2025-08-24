<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProductController;


Route::get('/', [TaskController::class, 'index'])->name('home');


Route::resource('tasks', TaskController::class);

Route::resource('products', ProductController::class);
