<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignupController;

Route::post('/store', [SignupController::class, 'store']);


Route::get('/', function () {
    return view('welcome');
});

