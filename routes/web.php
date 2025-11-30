<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HelloController;
use App\Http\Middleware\AuthAdminMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PicoController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PreferencesController;
use App\Http\Controllers\IntervalController;
use App\Http\Controllers\AdminTableController;

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

Route::get('/preferences/customize', [PreferencesController::class, 'customize'])
    ->middleware('auth')
    ->name('preferences.customize');

Route::post('/preferences/customize', [PreferencesController::class, 'saveCustom'])
    ->middleware('auth')
    ->name('preferences.saveCustom');

Route::post('/preferences/preset/{mode}', [PreferencesController::class, 'applyPreset'])
    ->middleware('auth')
    ->name('preferences.applyPreset');

Route::get('/intervals', [IntervalController::class, 'index'])
    ->middleware('auth')
    ->name('intervals.index');

Route::post('/intervals', [IntervalController::class, 'store'])
    ->middleware('auth')
    ->name('intervals.store');

Route::put('/intervals/{interval}', [IntervalController::class, 'update'])
    ->middleware('auth')
    ->name('intervals.update');

Route::delete('/intervals/{interval}', [IntervalController::class, 'destroy'])
    ->middleware('auth')
    ->name('intervals.destroy');

Route::get('/admin/tables', [AdminTableController::class, 'index'])
    ->middleware('auth')
    ->name('admin.tables.index');

Route::post('/admin/tables', [AdminTableController::class, 'store'])
    ->middleware('auth')
    ->name('admin.tables.store');

Route::put('/admin/tables/{table}', [AdminTableController::class, 'update'])
    ->middleware('auth')
    ->name('admin.tables.update');

Route::delete('/admin/tables/{table}', [AdminTableController::class, 'destroy'])
    ->middleware('auth')
    ->name('admin.tables.destroy');

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

Route::get('admin/building', [AdminController::class, 'serveBuildings'])
    ->middleware(AuthAdminMiddleware::class)
    ->name('admin.building');

Route::post('/blink', [PicoController::class,'blink'])->name("blink");
