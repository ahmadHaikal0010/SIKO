<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\RentalExtension;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index(): View
    {
        $complaintCount = Complaint::where('status', 'menunggu')->count();
        $rentalExtensionCount = RentalExtension::where('status', 'pending')->count();
        $pendingAccountCount = User::where('role', 'penghuni')->where('is_accepted', 'pending')->count();

        // tenants whose tanggal_keluar is within next 14 days and not finished
        $today = Carbon::now()->toDateString();
        $inTwoWeeks = Carbon::now()->addDays(14)->toDateString();
        $expiringTenantCount = Tenant::whereNotNull('tanggal_keluar')
            ->whereBetween('tanggal_keluar', [$today, $inTwoWeeks])
            ->where('status', '!=', 'finished')
            ->count();

        // latest items (previews for dashboard)
        $latestPendingAccounts = User::where('role', 'penghuni')
            ->where('is_accepted', 'pending')
            ->latest()
            ->take(3)
            ->get(['id', 'name', 'email', 'created_at']);

        $latestRentalExtensions = RentalExtension::where('status', 'pending')
            ->with('tenant')
            ->latest()
            ->take(3)
            ->get();

        $latestComplaints = Complaint::where('status', 'menunggu')
            ->with('user')
            ->latest()
            ->take(3)
            ->get();

        $latestExpiringTenants = Tenant::whereNotNull('tanggal_keluar')
            ->whereBetween('tanggal_keluar', [$today, $inTwoWeeks])
            ->where('status', '!=', 'finished')
            ->latest('tanggal_keluar')
            ->take(3)
            ->get();

        $totalNotifications = $complaintCount + $rentalExtensionCount + $pendingAccountCount + $expiringTenantCount;

        return view('admin.dashboard', compact(
            'complaintCount',
            'rentalExtensionCount',
            'expiringTenantCount',
            'pendingAccountCount',
            'latestPendingAccounts',
            'latestRentalExtensions',
            'latestComplaints',
            'latestExpiringTenants',
            'totalNotifications'
        ));
    }
}
