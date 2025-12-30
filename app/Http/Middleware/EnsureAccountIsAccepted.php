<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureAccountIsAccepted
{
    /**
     * Handle an incoming request.
     * If the authenticated user's `is_accepted` is not 'accepted',
     * redirect or show a custom view. Also prevent disabled accounts from staying logged in.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // If there's no authenticated user, let auth middleware handle it
        if (!$user) {
            return redirect()->route('login');
        }



        // Only enforce acceptance flow for penghuni (regular tenant applicants)
        if ($user->role === 'penghuni') {
            // jika akun non-aktif, logout user dan redirect ke login dengan pesan
            if (($user->status ?? null) === 'inactive') {
                Auth::logout();
                return redirect()->route('login')->withErrors(['account_inactive' => 'Your account has been disabled. Please contact support.']);
            }

            // If explicitly rejected, show rejected view first
            if (($user->is_accepted ?? null) === 'rejected') {
                return response()->view('auth.rejected-acceptance');
            }

            // If not yet accepted (pending or other), show waiting view
            if (($user->is_accepted ?? null) !== 'accepted') {
                return response()->view('auth.waiting-acceptance');
            }
        }

        return $next($request);
    }
}
