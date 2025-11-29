<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Bluerhinos\phpMQTT;

class PicoController extends Controller
{
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
            sleep(3);
            $mqtt->publish('pico/Stopblink', 'Stopblink', 0, false);
            $mqtt->close();
            return back();
        }
        else
        {
            return back();
        }
    }
}
