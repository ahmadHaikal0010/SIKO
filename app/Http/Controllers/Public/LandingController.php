<?php
namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Kost;

class LandingController extends Controller
{
    public function index()
    {
        // ambil semua kost + 1 foto terbaru (untuk cover)
        $kosts = Kost::with(['galleries' => fn($q) => $q->latest('id')->limit(1)])->get();
        return view('welcome', compact('kosts'));
    }
}
