<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelloController;

Route::get('/', function() {
    return view('HeightControl');
});

Route::post('/update-height', [HelloController::class, 'updateHeight']);