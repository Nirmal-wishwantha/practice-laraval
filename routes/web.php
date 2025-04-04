<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', [UserController::class, 'showForm'])->name('home');
Route::post('/register', [UserController::class, 'register'])->name('register');
