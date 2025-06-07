<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WorkspaceController;
use App\Http\Controllers\BoardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get("/home",[HomeController::class,"index"]);
Route::get("/register",[AuthController::class,"register"]);
Route::get("/login",[AuthController::class,"login"])->name("login");
Route::post("/saveuser",[AuthController::class,"saveuser"])->name("saveuser");
Route::post("/connection",[AuthController::class,"connection"])->name("connection");
Route::get("/logout",[AuthController::class,"logout"])->name("logout");



Route::get("/my-workspace",[WorkspaceController::class,"myworkspace"])->name("my-workspace");
Route::get("/create-workspace",[WorkspaceController::class,"createworkspace"])->name("create-workspace");
Route::post("/save-workspace",[WorkspaceController::class,"saveworkspace"])->name("save-workspace");



Route::get("/my-workspace/{id}", [BoardController::class, "workspaceboads"])->name("workspaceboads");
Route::get("/create-board/{id}",[BoardController::class,"createboard"])->name("createboard");
Route::post("/save-board",[BoardController::class,"saveboard"])->name("saveboard");

