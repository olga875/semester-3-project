<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelloController;

Route::get('/', [HelloController::class, 'index'])->name('desk.index');
Route::post('/', [HelloController::class, 'updateDesk'])->name('desk.update');