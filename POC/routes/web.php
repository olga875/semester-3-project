<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\PreferencesController;

Route::get('/', function() {
    return view('HeightControl');
});

Route::post('/update-height', [HelloController::class, 'updateHeight']);

Route::get('/preferences/customize', [PreferencesController::class, 'customize'])
    ->name('preferences.customize');

Route::post('/preferences/customize/save', [PreferencesController::class, 'saveCustom'])
    ->name('preferences.customize.save');

Route::post('/preferences/customize/preset/{mode}', [PreferencesController::class, 'applyPreset'])
    ->name('preferences.customize.preset');
