<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PreferencesController extends Controller
{
    public function customize(Request $request)
    {
        $existing = [
            'sit_minutes' => Session::get('prefs.sit_minutes'),
            'stand_minutes' => Session::get('prefs.stand_minutes'),
            'mode' => Session::get('prefs.mode'),
        ];

        return view('preferences.customize', compact('existing'));
    }

    public function saveCustom(Request $request)
    {
        $data = $request->validate([
            'sit_minutes' => 'required|integer|min:1|max:300',
            'stand_minutes' => 'required|integer|min:1|max:300',
        ]);

        Session::put('prefs', [
            'mode' => 'custom',
            'sit_minutes' => $data['sit_minutes'],
            'stand_minutes' => $data['stand_minutes'],
        ]);

        return redirect()->route('preferences.customize')->with('status', '✅ Your custom cycle has been saved!');
    }

    public function applyPreset(Request $request, string $mode)
    {
        $presets = [
            'focus'    => ['sit_minutes' => 50, 'stand_minutes' => 10],
            'balanced' => ['sit_minutes' => 40, 'stand_minutes' => 20],
            'active'   => ['sit_minutes' => 30, 'stand_minutes' => 30],
        ];

        abort_unless(array_key_exists($mode, $presets), 404);

        Session::put('prefs', array_merge(['mode' => $mode], $presets[$mode]));

        return redirect()->route('preferences.customize')->with('status', '✅ Selected successfully! Please click the button to apply the changes.');
    }
}