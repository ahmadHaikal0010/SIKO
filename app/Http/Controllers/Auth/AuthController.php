<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            switch ($user->role) {
                case "admin":
                    return redirect()->intended(route('admin.dashboard'));
                    break;
                case "penghuni":
                    return redirect()->intended(route('penghuni.dashboard'));
                    break;
                default:
                    Auth::logout();
                    return redirect()->route('loginform')->withErrors(['role' => 'Unauthorized role.']);
                    break;
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.'
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
