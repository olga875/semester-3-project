<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminTableController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\AuthAdminMiddleware;
use App\Models\Building;
use App\Models\Floor;
use App\Models\Room;
use Illuminate\Support\Facades\Route;

Route::middleware([AuthAdminMiddleware::class])
    ->group(function () {
        Route::get('/admin/tables', [AdminTableController::class, 'index'])
            ->name('admin.tables.index');

        Route::post('/admin/tables', [AdminTableController::class, 'store'])
            ->name('admin.tables.store');

        Route::put('/admin/tables/{table}', [AdminTableController::class, 'update'])
            ->name('admin.tables.update');

        Route::delete('/admin/tables/{table}', [AdminTableController::class, 'destroy'])
            ->name('admin.tables.destroy');

        Route::get('admin', [AuthController::class, 'ServeAdmin'])
            ->name('admin.panel');

        Route::post('admin/{acRequest}', [AuthController::class, 'ApproveAccess'])
            ->name('admin.approval');

        Route::get('admin/control', [AdminController::class, 'serveBuildings'])
            ->name('admin.control');

        Route::post('/building', [AdminController::class, 'saveBuilding'])
            ->middleware('can:create,'. Building::class)
            ->name('building.post');
        Route::post('/floor', [AdminController::class, 'saveFloor'])
            ->middleware('can:create,'. Floor::class)    
            ->name('floor.post');
        Route::post('/office', [AdminController::class, 'saveRoom'])
            ->middleware('can:create,'. Room::class)    
            ->name('office.post');
    });
