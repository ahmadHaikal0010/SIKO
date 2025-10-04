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
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, true)) {
            $user = Auth::user();

            $durationInMinutes = 30 * 24 * 60;

            if ($user->role === 'admin') {
                $durationInMinutes = 7 * 24 * 60;
            }

            Auth::setRememberDuration($durationInMinutes);

            $request->session()->regenerate();

            switch ($user->role) {
                case "admin":
                    return redirect()->intended(route('admin.dashboard'));
                    break;
                case "penghuni":
                    return redirect()->intended(route('penghuni.dashboard'));
                    break;
                default:
                    Auth::logout();
                    return redirect()->route('loginform')->withErrors(['role' => 'Akses ditolak.']);
                    break;
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.'
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
