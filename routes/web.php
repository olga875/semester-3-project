<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HelloController;
use App\Http\Middleware\AuthAdminMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PicoController;
use App\Http\Controllers\BookingController;

Route::get('/', function () {
    return view('HeightControl');
})->middleware('auth')->name('home');

Route::get('/timetable', function () {
    return view('Timetable');
})->middleware('auth')->name('timetable');

// Desk movement endpoint used by front-end
Route::post('/update-height', [HelloController::class, 'updateDesk'])->middleware('auth')->name('desk.updateHeight');

// Preferences save endpoints
Route::post('/preferences/sitting', [HelloController::class, 'applySittingHeight'])->middleware('auth')->name('preferences.sitting');
Route::post('/preferences/standing', [HelloController::class, 'applyStandingHeight'])->middleware('auth')->name('preferences.standing');

// Map update-height endpoint to the existing updateDesk method
Route::post('/update', [HelloController::class, 'updateDesk'])->middleware('auth')->name('desk.update');
Route::post('/save', [HelloController::class, 'updateDesk'])->middleware('auth')->name('desk.save');

Route::get('/register', [AuthController::class, 'ServeRegister'])->middleware('guest')->name('register.form');
Route::post('/register', [AuthController::class, 'Register'])->middleware('guest')->name('register');

Route::get('/login', [AuthController::class, 'ServeLogin'])->middleware('guest')->name('login.form');
Route::post('/login', [AuthController::class, 'Login'])->middleware('guest')->name('login');

Route::get('admin', [AuthController::class, 'ServeAdmin'])
    ->middleware(AuthAdminMiddleware::class)
    ->name('admin.panel');

Route::post('admin/{acRequest}', [AuthController::class, 'ApproveAccess'])
    ->middleware(AuthAdminMiddleware::class)
    ->name('admin.approval');

Route::get('admin/building', [AdminController::class, 'serveBuildings'])->middleware(AuthAdminMiddleware::class)->name('admin.building');
Route::post('/blink', [PicoController::class,'blink'])->name("blink");
