<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Kost\StoreKostRequest;
use App\Models\Kost;
use App\Services\KostService;
use Illuminate\Http\Request;

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
}
