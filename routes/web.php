<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\WorkspaceController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get("/home", [HomeController::class, "index"]);
Route::get("/register", [AuthController::class, "register"]);
Route::get("/login", [AuthController::class, "login"])->name("login");
Route::post("/saveuser", [AuthController::class, "saveuser"])->name("saveuser");
Route::post("/connection", [AuthController::class, "connection"])->name("connection");
Route::get("/logout", [AuthController::class, "logout"])->name("logout");

Route::middleware(["auth"])->group(function () {


    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin-export', [AdminController::class, 'exportPDF'])->name('admin.export');
    Route::get('/admin-qr', [AdminController::class, 'generateQrCode'])->name('admin.qr');



    
    Route::get("/my-workspace", [WorkspaceController::class, "myworkspace"])->name("my-workspace");
    Route::get("/create-workspace", [WorkspaceController::class, "createworkspace"])->name("create-workspace");
    Route::post("/save-workspace", [WorkspaceController::class, "saveworkspace"])->name("save-workspace");

    Route::get("/my-workspace/{id}", [BoardController::class, "workspaceboads"])->name("workspaceboads");
    Route::get("/create-board/{id}", [BoardController::class, "createboard"])->name("createboard");
    Route::post("/save-board", [BoardController::class, "saveboard"])->name("saveboard");
    Route::get("/workspace/{id}/delete", [BoardController::class, "deleteboard"])->name("deleteboard");

    Route::get("/workspacemember/{id}", [WorkspaceController::class, "workspacemember"])->name("workspacemember");
    Route::post("/savemember", [WorkspaceController::class, "savemember"])->name("savemember");
    Route::get('/workspace/{workspace}/remove-member/{user}', [WorkspaceController::class, 'removeMember'])->name('workspace.removeMember');

    Route::get("/show-task/{id}", [TaskController::class, "showtask"])->name("showtask");
    Route::get("/newtask/{id}", [TaskController::class, "newtask"])->name("newtask");
    Route::post('/save-task', [TaskController::class, 'saveTask'])->name('savetask');
    Route::get('/delete-task/{id}', [TaskController::class, 'deleteTask'])->name('deletetask');
    Route::put('/update-tasks/{task}', [TaskController::class, 'updateTask'])->name('updatetask');

    Route::get('/pricing', [SubscriptionController::class, 'pricing'])->name('pricing');
    Route::get('/subscribe/{plan}', [SubscriptionController::class, 'subscribe'])->name('subscribe');
    Route::get('/kkiapay/callback', [SubscriptionController::class, 'callback'])->name('kkiapay.callback');








        Route::get('/addcontact', [ContactController::class, 'addcontact'])->name('addcontact');
        Route::get('/contacts', [ContactController::class, 'contacts'])->name('contacts');
        Route::post('/savecontact', [ContactController::class, 'savecontact'])->name('savecontact');


});
