<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TableController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\GoogleWebController;



Route::get('/', function () {
    return view('welcome');
});

// login Google
Route::get('/login', [GoogleWebController::class, 'redirectToGoogle'])->name('login');
Route::get('/auth/google/callback', [GoogleWebController::class, 'handleGoogleCallback']);