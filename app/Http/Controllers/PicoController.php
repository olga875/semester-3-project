<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Bluerhinos\phpMQTT;

class PicoController extends Controller
{
    public function blink(Request $request)
    {
        $validatedclient = $request->validate([
            // Regex checks if input is either "all" or integer between 1-150
            'clientid'=> 'required|regex:/^(all|[1-9][0-9]?|1[0-4][0-9]|150)$/',
        ]);
        $clientpico = $validatedclient['clientid'];
        $server = env('MQTT_HOST');
        $port = env('MQTT_PORT');
        $username = '';
        $password = '';
        $client_id = 'phpMQTT-publisher';
        $mqtt = new phpMQTT($server, $port, $client_id);
    
        if ($mqtt->connect(true, NULL, $username, $password))
        {
            $mqtt->publish("pico/{$clientpico}/blink", 'blink', 0, false);
            sleep(3);
            $mqtt->publish("pico/{$clientpico}/Stopblink", 'Stopblink', 0, false);
            $mqtt->close();
            return back();
        }
        else
        {
            return back();
        }
    }
}
