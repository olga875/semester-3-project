<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Preference;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Bluerhinos\phpMQTT;

class TablesController extends Controller
{
    public function index()
    {
        $height = 750; // Default height
        return view('welcome', compact('height'));
    }

    public function blink()
    {
        $server = env('MQTT_HOST');
        $port = env('MQTT_PORT');
        $username = '';
        $password = '';
        $client_id = 'phpMQTT-publisher';
        $mqtt = new phpMQTT($server, $port, $client_id);
    
        if ($mqtt->connect(true, NULL, $username, $password))
        {
            $mqtt->publish('pico/blink', 'blink', 0, false);
            $mqtt->close();
            return back();
        }
        else
        {
            return back();
        }
    }

    public function Stopblink()
    {
        $server = env('MQTT_HOST');
        $port = env('MQTT_PORT');
        $username = '';
        $password = '';
        $client_id = 'phpMQTT-publisher';
        $mqtt = new phpMQTT($server, $port, $client_id);
    
        if ($mqtt->connect(true, NULL, $username, $password))
        {
            $mqtt->publish('pico/Stopblink', 'Stopblink', 0, false);
            $mqtt->close();
            return back();
        }
        else
        {
            return back();
        }
    }

    public function updateDesk(Request $request)
    {
        $height = $request->input('height', 750);
   
        Http::put(
        'http://desk-api:5000/api/v2/F7H1vM3kQ5rW8zT9xG2pJ6nY4dL0aZ3K/desks/91:17:a4:3b:f4:4d/state',
        ['position_mm' => (int)$height]
        );
        //$this->blink();

        do{
            $statusResponse = Http::get(
                'http://desk-api:5000/api/v2/F7H1vM3kQ5rW8zT9xG2pJ6nY4dL0aZ3K/desks/91:17:a4:3b:f4:4d/state'
            );
            $currentHeight = $statusResponse->json()['position_mm'];
            $currentStatus = $statusResponse->json()['status'];
            usleep(500000);
        } while ($currentHeight != (int)$height || $currentStatus != 'Normal'); 
        
        $this->Stopblink();

        return response()->json([
            'status' => 'height_changed',
            'height' => $currentHeight,
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
