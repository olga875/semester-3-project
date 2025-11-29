<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Interval;
use App\Models\IntervalProgram;

class IntervallController extends Controller
{
    public function createIntervall(Request $request)
    {
        $data = $request->validate([
            'interval_name' => 'string',

        ]);

        if($data) {
            Interval::create([
                'interval_name' => $data['interval_name'],
                
            ]);
            return redirect()->route('interval')->with('success', 'Interval added successfully!');
        }
    }

    public function readIntervall()
    {
        $user_id = auth()->id();
        $intervalls = Interval::where('user_id', $user_id)->get();
        return view('intervall', ['intervalls' => $intervalls]);
    }

    public function editIntervall(Interval $interval)
    {
        return view('interval', ['interval' => $interval]);
    }

    public function updateIntervall(Request $request, Interval $interval)
    {
        $data = $request->validate([
            'interval_name' => 'string'
            // How do I get the specific parts here from the interval, like state and time amount, for each part of the interval?
        ]);

        $interval->update([
            'interval_name' => $data['interval_name'],

        ]);

        return redirect()->route('interval')->with('success', 'Interval updated successfully!');
    }

    public function deleteIntervall(Interval $interval)
    {
        $interval->delete();
        return redirect()->route('interval')->with('success', 'Interval deleted successfully!');
    }
}