<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\StoreTenantComplaintRequest;
use App\Http\Requests\Tenant\UpdateTenantComplaintRequest;
use App\Models\Complaint;
use App\Services\TenantComplaintService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TenantComplaintController extends Controller
{
    protected TenantComplaintService $tenantComplaintService;

    public function __construct(TenantComplaintService $tenantComplaintService)
    {
        $this->tenantComplaintService = $tenantComplaintService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $complaints = $this->tenantComplaintService->getAll();
        return view('tenant.complaint.index', compact('complaints'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tenant.complaint.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTenantComplaintRequest $request)
    {
        $this->tenantComplaintService->store($request->validated());
        return redirect()->route('tenant.complaint.index')->with('success', 'Aduan berhasil diajukan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Complaint $complaint)
    {
        $complaint = $this->tenantComplaintService->load($complaint);
        return view('tenant.complaint.show', compact('complaint'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Complaint $complaint)
    {
        return view('tenant.complaint.edit', compact('complaint'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTenantComplaintRequest $request, Complaint $complaint)
    {
        $this->tenantComplaintService->update($complaint, $request->validated());
        return redirect()->route('tenant.complaint.index')->with('success', 'Aduan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Complaint $complaint)
    {
        Gate::authorize('delete', $complaint);
        $this->tenantComplaintService->destroy($complaint);
        return redirect()->route('tenant.complaint.index')->with('success', 'Aduan berhasil dihapus.');
    }
}
