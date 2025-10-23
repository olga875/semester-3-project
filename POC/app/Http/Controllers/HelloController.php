<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HelloController extends Controller
{
    public function index()
    {
        $height = 750; // Default height
        return view('welcome', compact('height'));
    }

    public function updateDesk(Request $request)
    {
        $height = $request->input('height', 750);
   
        $response = Http::put(
        'http://localhost:8006/api/v2/F7H1vM3kQ5rW8zT9xG2pJ6nY4dL0aZ3K/desks/91:17:a4:3b:f4:4d/state',
        ['position_mm' => (int)$height]
        );

        return view('welcome', [
            'height' => $height,
            'apiResponse' => $response->body()
        ]);

    }
}
