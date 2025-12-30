<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\StoreTenantRequest;
use App\Http\Requests\Tenant\UpdateTenantRequest;
use App\Models\Tenant;
use App\Services\TenantService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class TenantSelfController extends Controller
{
    protected TenantService $tenantService;

    public function __construct(TenantService $tenantService)
    {
        $this->tenantService = $tenantService;
    }

    public function create(): View|RedirectResponse
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();
        // If user already has tenant, redirect to edit
        if ($user && $user->tenant) {
            return redirect()->route('tenant.tenant.edit');
        }

        $rooms = $this->tenantService->getRooms(true); // only available
        return view('tenant.tenant.create', compact('rooms'));
    }

    public function store(StoreTenantRequest $request): RedirectResponse
    {
        $data = $request->validated();
        // Force user_id to current user
        $data['user_id'] = Auth::id();

        $this->tenantService->create($data);

        return redirect()->route('tenant.dashboard')->with('success', 'Terima kasih — data penghuni berhasil disimpan.');
    }

    public function edit(): View|RedirectResponse
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();
        $tenant = $user?->tenant;
        if (!$tenant) {
            return redirect()->route('tenant.tenant.create');
        }
        $rooms = $this->tenantService->getRooms();
        return view('tenant.tenant.edit', compact('tenant', 'rooms'));
    }

    public function update(UpdateTenantRequest $request): RedirectResponse
    {
        $tenant = Auth::user()->tenant;
        $this->tenantService->update($tenant, $request->validated());
        return redirect()->route('tenant.dashboard')->with('success', 'Data penghuni berhasil diperbarui.');
    }
}
