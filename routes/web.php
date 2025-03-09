<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get("/home",[HomeController::class,"index"]);
Route::get("/register",[AuthController::class,"register"]);
Route::get("/login",[AuthController::class,"login"])->name("login");
Route::post("/saveuser",[AuthController::class,"saveuser"])->name("saveuser");
Route::post("/connection",[AuthController::class,"connection"])->name("connection");
Route::get("/logout",[AuthController::class,"logout"])->name("logout");



Route::get("/dashboard",[AuthController::class,"dashboard"])->name('dashboard');
Route::get("/products",[HomeController::class,"products"])->name('products');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::get('/admin', [AdminController::class, 'index'])->name('admin');
