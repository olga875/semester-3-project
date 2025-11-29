<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Interval;
use App\Models\IntervalProgram;

class IntervallController extends Controller
{
    public function createIntervall(Request $request)
    {
        /*$data = $request->validate([

        ])*/
    }

    public function readIntervall()
    {
        /*$user_id = auth()->id();
        $intervalls = Interval::where('user_id', $user_id)->get();
        return view('intervall', ['intervalls' => $intervalls];)*/
    }

    public function updateIntervall()
    {

    }

    public function deleteIntervall()
    {

    }
}