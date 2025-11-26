<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Interval;
use App\Models\IntervalProgram;

class AdminController extends Controller
{
    public function serveBuildings() {
        return view("BuildingControl");
    }
}