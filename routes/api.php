<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IntervalController;

Route::get('/intervals', [IntervalController::class, 'index']);
Route::post('/intervals', [IntervalController::class, 'store']);
Route::put('/intervals/{interval}', [IntervalController::class, 'update']);
Route::delete('/intervals/{interval}', [IntervalController::class, 'destroy']);
