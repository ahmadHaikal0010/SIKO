<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TenantDashboardController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User|null $user */
        $user = \Illuminate\Support\Facades\Auth::user();

        // Only show the "needsTenant" notification to penghuni whose accounts are accepted and who have no tenant record
        $needsTenant = $user && $user->role === 'penghuni' && ($user->is_accepted ?? null) === 'accepted' && ! $user->tenant;

        return view('tenant.dashboard', compact('needsTenant'));
    }
}
