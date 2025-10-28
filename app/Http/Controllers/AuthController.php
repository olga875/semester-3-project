<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function ServeRegister()
    {
        return view('register');
    }

    public function Register(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'string', 'email', 'unique:users,email'],
            'name' => ['required', 'string', 'regex:/^[a-zA-Z0-9]{3,20}$/'],
            'password' => ['required', 'string', 'min:6', 'confirmed']
        ]);

        $user = User::where('email', $validated['email'])->first();

        if ($user) {
            return;    
        }

        $validated['password'] = bcrypt($validated['password']);

        $user = User::create($validated);

        return redirect()->route(route: 'login');
    }
}