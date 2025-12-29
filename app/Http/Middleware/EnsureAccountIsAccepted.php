<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAccountIsAccepted
{
    /**
     * Handle an incoming request.
     * If the authenticated user's `is_accepted` is not 'accepted',
     * redirect or show a custom view.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // If there's no authenticated user, let auth middleware handle it
        if (!$user) {
            return redirect()->route('login');
        }

        // If explicitly rejected, show rejected view first
        if (($user->is_accepted ?? null) === 'rejected') {
            return response()->view('auth.rejected-acceptance');
        }

        // If not yet accepted (pending or other), show waiting view
        if (($user->is_accepted ?? null) !== 'accepted') {
            return response()->view('auth.waiting-acceptance');
        }

        return $next($request);
    }
}
