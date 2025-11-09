<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Kost\StoreKostRequest;
use App\Http\Requests\Kost\UpdateKostRequest;
use App\Models\Kost;
use App\Services\KostService;
use Illuminate\Support\Facades\Gate;

class KostController extends Controller
{
    protected KostService $kostService;

    public function __construct(KostService $kostService)
    {
        $this->kostService = $kostService;
    }

    public function index()
    {
        $kost = $this->kostService->getAll();
        return view('admin.kost.index', compact('kost'));
    }

    public function create()
    {
        return view('admin.kost.create');
    }

    public function store(StoreKostRequest $request)
    {
        $this->kostService->create($request->validated());
        return redirect()->route('admin.kost.index')->with('success', 'Data kost berhasil ditambahkan.');
    }

    public function show(Kost $kost)
    {
        return view('admin.kost.show', compact('kost'));
    }

    public function edit(Kost $kost)
    {
        return view('admin.kost.edit', compact('kost'));
    }

    public function update(UpdateKostRequest $request, Kost $kost)
    {
        $this->kostService->update($kost, $request->validated());
        return redirect()->route('admin.kost.index')->with('success', 'Data kost berhasil diperbarui.');
    }

    public function destroy(Kost $kost)
    {
        Gate::authorize('delete', $kost);
        $this->kostService->delete($kost);
        return redirect()->route('admin.kost.index')->with('success', 'Data kost berhasil dihapus.');
    }
}
