<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Gallery\StoreGalleryRequest;
use App\Http\Requests\Gallery\UpdateGalleryRequest;
use App\Models\Gallery;
use App\Services\GalleryService;
use Illuminate\Support\Facades\Gate;

class GalleryController extends Controller
{
    protected GalleryService $galleryService;

    public function __construct(GalleryService $galleryService)
    {
        $this->galleryService = $galleryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries = $this->galleryService->getAll();
        return view('admin.gallery.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kost = $this->galleryService->getKost();
        return view('admin.gallery.create', compact('kost'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGalleryRequest $request)
    {
        // Pisahkan data untuk model dan file
        $data = $request->validated();
        $images = $request->file('images');

        // Panggil SATU method di service untuk mengurus semuanya
        $this->galleryService->create($data, $images);

        return redirect()->route('admin.gallery.index')->with('success', 'Data Galeri berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        $gallery = $this->galleryService->read($gallery);
        return view('admin.gallery.show', compact('gallery'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        $kost = $this->galleryService->getKost();
        $gallery = $this->galleryService->read($gallery);
        return view('admin.gallery.edit', compact('gallery', 'kost'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGalleryRequest $request, Gallery $gallery)
    {
        $data = $request->validated();
        $image = $request->file('image');

        $this->galleryService->update($gallery, $data, $image);

        return redirect()->route('admin.gallery.index')->with('success', 'Data Galeri berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        Gate::authorize('delete', $gallery);
        $this->galleryService->delete($gallery);
        return redirect()->route('admin.gallery.index')->with('success', 'Data Galeri berhasil dihapus.');
    }
}
