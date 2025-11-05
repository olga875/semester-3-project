<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelloController;
use App\Http\Middleware\AuthAdminMiddleware;

Route::get('/', function() {
    return view('HeightControl');
})->name('home');

// Map update-height endpoint to the existing updateDesk method
Route::post('/update', [HelloController::class, 'updateDesk'])->name('desk.update');
Route::post('/save', [HelloController::class, 'update-height'])->name('desk.save');


Route::get('/register', [AuthController::class, 'ServeRegister'])->name('register.form');
Route::post("/register", [AuthController::class,"Register"])->name("register");


Route::get('/login', [AuthController::class, 'ServeLogin'])->name('login.form');
Route::post("/login", [AuthController::class, "Login"])->name("login");

Route::get('admin', [AuthController::class,'ServeAdmin'])
    ->middleware(AuthAdminMiddleware::class)
    ->name('admin.panel');

Route::post('admin/{acRequest}', [AuthController::class,'ApproveAccess'])
    ->middleware(AuthAdminMiddleware::class)
    ->name('admin.approval');