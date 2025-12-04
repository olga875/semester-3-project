<?php

namespace App\Http\Controllers;

use App\Enums\AccessLevels;
use App\Enums\ApprovalState;
use App\Models\AccessRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function ServeRegister()
    {
        return view('Register');
    }

    public function Register(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'string', 'email', 'unique:users,email'],
            'name' => ['required', 'string', 'regex:/^[a-zA-Z0-9]{3,20}$/'],
            'access' => ['required', 'in:user,staff'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $user = User::where('email', $validated['email'])->first();

        if ($user) {
            return;
        }

        $validated['password'] = bcrypt($validated['password']);

        $user = User::create($validated);
        $accessRequest = AccessRequest::create([
            'user_id' => $user->id,
            'level' => $validated['access'],
        ]);

        return redirect()->route(route: 'login');
    }

    public function ServeLogin()
    {
        return view('Login');
    }

    public function Login(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (! $user) {
            return back()->withErrors([
                'email' => 'Incorrect e-mail or password.',
            ])->onlyInput('email');
        }

        if (! Hash::check($validated['password'], $user['password'])) {
            return back()->withErrors([
                'email' => 'Incorrect e-mail or password.',
            ])->onlyInput('email');
        } elseif ($user->access_level == AccessLevels::NONE) {
            return back()->withErrors([
                'email' => 'Your account has not been approved yet, contact your system administrator',
            ])->onlyInput('email');
        }

        Auth::login($user);

        return redirect()->route('home');

    }

    public function ServeAdmin(Request $request)
    {
        $requests = AccessRequest::where('state', ApprovalState::SUBMITTED)
            ->with('user')
            ->get();

        return view('Admin', compact('requests'));
    }

    public function ApproveAccess(Request $request, AccessRequest $acRequest)
    {
        if ($request->user()->cannot('update', $acRequest)) {
            abort(403, 'error');
        }

        $validated = $request->validate([
            'approved' => ['required', 'boolean'],
        ]);

        if ($validated['approved']) {
            $user = $acRequest->user;
            $user->update(['role' => $acRequest->level]);
            $acRequest->update(['state' => ApprovalState::APPROVED]);
        } else {
            $acRequest->update(['state' => ApprovalState::REJECTED]);
        }
        

        return back()->with('status', 'Access request has been saved');
    }

    public function DeleteUser(Request $request, User $user)
    {
        // check if user is admin
        if (!$request->user()->isAdmin()) {
            abort(403, 'Unauthorized action');
        }

        // prevents deleting yourself
        if ($user->id === $request->user()->id) {
            return back()->withErrors(['error' => 'You cannot delete your own account']);
        }

        // prevents deleting other admins
        if ($user->isAdmin()) {
            return back()->withErrors(['error' => 'You cannot delete other administrators']);
        }

        // delete related access requests first
        AccessRequest::where('user_id', $user->id)->delete();
        
        // delete the specific user
        $user->delete();

        return back()->with('status', 'User deleted successfully');
    }
}
