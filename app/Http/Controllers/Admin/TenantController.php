<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\StoreTenantRequest;
use App\Http\Requests\Tenant\UpdateTenantRequest;
use App\Models\Tenant;
use App\Services\TenantService;
use Illuminate\Support\Facades\Gate;

class TenantController extends Controller
{
    protected TenantService $tenantService;

    public function __construct(TenantService $tenantService)
    {
        $this->tenantService = $tenantService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tenants = $this->tenantService->getAll();
        return view('admin.tenant.index', compact('tenants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = $this->tenantService->getUsers();
        $rooms = $this->tenantService->getRooms();
        return view('admin.tenant.create', compact('users', 'rooms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTenantRequest $request)
    {
        $this->tenantService->create($request->validated());
        return redirect()->route('admin.tenant.index')->with('success', 'Data Penghuni berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tenant $tenant)
    {
        $tenant = $this->tenantService->read($tenant);
        return view('admin.tenant.show', compact('tenant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tenant $tenant)
    {
        $tenant = $this->tenantService->read($tenant);
        $users = $this->tenantService->getUsers();
        $rooms = $this->tenantService->getRooms();
        return view('admin.tenant.edit', compact('tenant', 'users', 'rooms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTenantRequest $request, Tenant $tenant)
    {
        $this->tenantService->update($tenant, $request->validated());
        return redirect()->route('admin.tenant.index')->with('success', 'Data Penghuni berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tenant $tenant)
    {
        Gate::authorize('delete', $tenant);
        $this->tenantService->delete($tenant);
        return redirect()->route('admin.tenant.index')->with('success', 'Data Penghuni berhasil dihapus.');
    }
}
