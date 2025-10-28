<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelloController;

Route::get('/', function() {
    return view('HeightControl');
});

Route::post('/update-height', [HelloController::class, 'updateHeight']);
Route::get('/', [HelloController::class, 'index'])->name('desk.index');
Route::post('/update', [HelloController::class, 'updateDesk'])->name('desk.update');
Route::post('/save', [HelloController::class, 'updatePreferences'])->name('desk.save');
