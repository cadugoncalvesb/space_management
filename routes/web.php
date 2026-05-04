<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocalController;
use App\Http\Controllers\SpaceController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('locals', LocalController::class);
Route::resource('spaces', SpaceController::class);
Route::resource('users', UserController::class);
