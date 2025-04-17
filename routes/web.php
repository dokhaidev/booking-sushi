<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\GoogleController;


Route::get('/', function () {
    return view('welcome');
});

// login Google

