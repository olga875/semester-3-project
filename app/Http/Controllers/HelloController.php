<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Preference;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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

    public function updatePreferences(Request $request)
    {
        $data = $request->validate([
            'sitting_height' => 'required|numeric',
            'standing_height' => 'required|numeric'
            
        ]);
   
        $preference = Preference::updateOrCreate([
                //'user_id' => auth()->id(),
                'sitting_height' => $data['sitting_height'],
                'standing_height' => $data['standing_height']
            ]
        );



        return view('welcome', [
            'sitting_height' => $data['sitting_height'],
            'standing_height' => $data['standing_height']
        ]);

    }

    public function saveHeights(Request $request)
    {
        $data = $request->validate([
            'sitting_height' => 'nullable|numeric',
            'standing_height' => 'nullable|numeric',
        ]);

        $user = Auth::user() ?? User::first();
        if (!$user) {
            return back()->with('error', 'There is no such a user.');
        }

        if (array_key_exists('sitting_height', $data)) {
            $user->sitting_height = $data['sitting_height'];
        }
        if (array_key_exists('standing_height', $data)) {
            $user->standing_height = $data['standing_height'];
        }
        $user->save();

        return back()->with('status', 'Heights saved.');
    }
}
