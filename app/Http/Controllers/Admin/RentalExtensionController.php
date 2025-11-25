<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RentalExtension;
use App\Services\RentalExtensionService;
use Illuminate\Support\Facades\Gate;

class RentalExtensionController extends Controller
{
    protected RentalExtensionService $rentalExtensionService;

    public function __construct(RentalExtensionService $rentalExtensionService)
    {
        $this->rentalExtensionService = $rentalExtensionService;
    }

    public function index()
    {
        $rentalExtensions = $this->rentalExtensionService->getAll();
        return view('admin.rental_extension.index', compact('rentalExtensions'));
    }

    public function show(RentalExtension $rentalExtension)
    {
        $rentalExtension = $this->rentalExtensionService->read($rentalExtension);
        return view('admin.rental_extension.show', compact('rentalExtension'));
    }

    public function destroy(RentalExtension $rentalExtension)
    {
        Gate::authorize('delete', $rentalExtension);
        $this->rentalExtensionService->destroy($rentalExtension);
        return redirect()->route('admin.rental_extension.index')->with('success', 'Perpanjangan sewa berhasil dihapus.');
    }

    public function accept(RentalExtension $rentalExtension)
    {
        $this->rentalExtensionService->accept($rentalExtension);
        return redirect()->route('admin.rental_extension.index')->with('success', 'Perpanjangan sewa berhasil disetujui.');
    }

    public function reject(RentalExtension $rentalExtension)
    {
        $this->rentalExtensionService->reject($rentalExtension);
        return redirect()->route('admin.rental_extension.index')->with('success', 'Perpanjangan sewa berhasil ditolak.');
    }
}
