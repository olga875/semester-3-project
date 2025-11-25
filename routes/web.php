<?php

use App\Http\Controllers\AdminController;
use App->Http->Controllers->HelloController;
use App->Http->Controllers->PicoController;
use App->Http->Controllers->BookingController;
use App->Http->Controllers->PreferencesController;
use App->Http->Controllers->IntervalController;
use App->Http->Controllers->AdminTableController;
use App->Http->Middleware->AuthAdminMiddleware;
use Illuminate->Support->Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        $pref = session('prefs', null);
        return view('HeightControl', compact('pref'));
    })->name('home');

    Route::get('/timetable', function () {
        return view('Timetable');
    })->name('timetable');
    
    Route::post('/update-height', [HelloController::class, 'updateDesk'])->name('desk.updateHeight');
    Route::post('/update', [HelloController::class, 'updateDesk'])->name('desk.update');
    Route::post('/save', [HelloController::class, 'updateDesk'])->name('desk.save');

    Route::get('/preferences/customize', [PreferencesController::class, 'customize'])->name('preferences.customize');
    Route::post('/preferences/customize', [PreferencesController::class, 'saveCustom'])->name('preferences.saveCustom');
    Route::post('/preferences/preset/{mode}', [PreferencesController::class, 'applyPreset'])->name('preferences.applyPreset');

    Route::post('/preferences/sitting', [HelloController::class, 'applySittingHeight'])->name('preferences.sitting');
    Route::post('/preferences/standing', [HelloController::class, 'applyStandingHeight'])->name('preferences.standing');
    
    Route::get('/intervals', [IntervalController::class, 'index'])->name('intervals.index');
    Route::post('/intervals', [IntervalController::class, 'store'])->name('intervals.store');
    Route::put('/intervals/{interval}', [IntervalController::class, 'update'])->name('intervals.update');
    Route::delete('/intervals/{interval}', [IntervalController::class, 'destroy'])->name('intervals.destroy');

    Route::get('/admin/tables', [AdminTableController::class, 'index'])->name('admin.tables.index');
    Route::post('/admin/tables', [AdminTableController::class, 'store'])->name('admin.tables.store');
    Route::put('/admin/tables/{table}', [AdminTableController::class, 'update'])->name('admin.tables.update');
    Route::delete('/admin/tables/{table}', [AdminTableController::class, 'destroy'])->name('admin.tables.destroy');
});


Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'ServeRegister'])->name('register.form');
    Route::post('/register', [AuthController::class, 'Register'])->name('register');

    Route::get('/login', [AuthController::class, 'ServeLogin'])->name('login.form');
    Route::post('/login', [AuthController::class, 'Login'])->name('login');
});


Route::middleware(AuthAdminMiddleware::class)->group(function () {
    Route::get('admin', [AuthController::class, 'ServeAdmin'])->name('admin.panel');
    Route::post('admin/{acRequest}', [AuthController::class, 'ApproveAccess'])->name('admin.approval');
    
    Route::get('admin/building', [AdminController::class, 'serveBuildings'])->name('admin.building');
    Route::post('/blink', [PicoController::class,'blink'])->name("blink");
});
