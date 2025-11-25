<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\StoreTenantRentalExtensionRequest;
use App\Http\Requests\Tenant\UpdateTenantRentalExtensionRequest;
use App\Models\RentalExtension;
use App\Services\TenantRentalExtensionService;
use Illuminate\Support\Facades\Auth;

class TenantRentalExtensionController extends Controller
{
    protected TenantRentalExtensionService $tenantRentalExtensionService;

    public function __construct(TenantRentalExtensionService $tenantRentalExtensionService)
    {
        $this->tenantRentalExtensionService = $tenantRentalExtensionService;
    }

    public function index()
    {
        $tenantId = Auth::user()->tenant->id ?? null;
        $rentalExtensions = $this->tenantRentalExtensionService->getAll($tenantId);
        return view('tenant.rental_extension.index', compact('rentalExtensions'));
    }

    public function show(RentalExtension $rentalExtension)
    {
        $rentalExtension = $this->tenantRentalExtensionService->read($rentalExtension);
        return view('tenant.rental_extension.show', compact('rentalExtension'));
    }

    public function create()
    {
        return view('tenant.rental_extension.create');
    }

    public function store(StoreTenantRentalExtensionRequest $request)
    {
        $this->tenantRentalExtensionService->store($request->validated());
        return redirect()->route('tenant.rental_extension.index')->with('success', 'Permohonan perpanjangan sewa berhasil diajukan.');
    }

    public function edit(RentalExtension $rentalExtension)
    {
        return view('tenant.rental_extension.edit', compact('rentalExtension'));
    }

    public function update(UpdateTenantRentalExtensionRequest $request, RentalExtension $rentalExtension)
    {
        $this->tenantRentalExtensionService->update($rentalExtension, $request->validated());
        return redirect()->route('tenant.rental_extension.index')->with('success', 'Permohonan perpanjangan sewa berhasil diperbarui.');
    }

    public function destroy(RentalExtension $rentalExtension)
    {
        $this->tenantRentalExtensionService->delete($rentalExtension);
        return redirect()->route('tenant.rental_extension.index')->with('success', 'Permohonan perpanjangan sewa berhasil dihapus.');
    }
}
