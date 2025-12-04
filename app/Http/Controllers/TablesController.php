<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Preference;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PicoController;
use App\Jobs\DeskMoveHandler;

use Bluerhinos\phpMQTT;

class TablesController extends Controller
{
    public function index()
    {
        $height = 750; // Default height
        return view('welcome', compact('height'));
    }

     public function updateDesk(Request $request)
    {
        $height = $request->input('height', 750);
   
        DeskMoveHandler::dispatch($height); //changing height job is sended to external handler (Jobs/DeskMoveHandler.php) to not block main thread

        return response()->json([
            'status' => 'height_changed',
            'height' => $height,
        ]);
    }


    public function applySittingHeight(Request $request)
    {
        $user = Auth::user() ?? User::first();      
        $data = $request->validate([
            'sitting_height' => 'nullable|numeric',
            'standing_height' => 'nullable|numeric',
        ]);

        $pref = Preference::firstOrCreate(
            ['user_id' => $user->id],
            [
                'sitting_height' => $data['sitting_height'],
                'standing_height' => $data['standing_height']
            ]
        );

        $pref->sitting_height = $data['sitting_height'];
        $pref->save();

        return response()->json([
            'status' => 'oki',
            'sitting_height' => $pref->sitting_height,
            'standing_height' => $pref->standing_height,
        ]);
    }

    public function applyStandingHeight(Request $request)
    {
        $user = Auth::user() ?? User::first();        

        $data = $request->validate([
            'sitting_height' => 'nullable|numeric',
            'standing_height' => 'nullable|numeric',
        ]);

        $pref = Preference::firstOrCreate(
            ['user_id' => $user->id],
            [
                'sitting_height' => $data['sitting_height'],
                'standing_height' => $data['standing_height'],
            ]
        );

        $pref->standing_height = $data['standing_height'];
        $pref->save();

        return response()->json([
            'status' => 'ok',
            'sitting_height' => $pref->sitting_height,
            'standing_height' => $pref->standing_height,
        ]);
    }
}
