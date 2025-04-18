<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
=======
use App\Http\Controllers\GoogleController;
>>>>>>> 2eac8cda036f8d463e5c05f0b033b2fe0d01ed95

use App\Http\Controllers\GoogleController;


Route::get('/', function () {
    return view('welcome');
});

<<<<<<< HEAD
// login Google

=======

Route::get('/auth/google/redirect', [GoogleController::class, 'redirect']);
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);
>>>>>>> 2eac8cda036f8d463e5c05f0b033b2fe0d01ed95
