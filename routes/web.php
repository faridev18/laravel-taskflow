<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get("/home",[HomeController::class,"index"]);
Route::get("/register",[AuthController::class,"register"]);
Route::post("/saveuser",[AuthController::class,"saveuser"])->name("saveuser");