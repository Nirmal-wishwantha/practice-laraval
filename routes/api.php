<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function () {
    return response()->json(['message' => 'Test user works']);
});


Route::get('/test', function () {
    return response()->json(['message' => 'Test route works']);
});