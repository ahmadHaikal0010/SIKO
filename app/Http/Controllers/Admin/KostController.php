<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kost;
use Illuminate\Http\Request;

class KostController extends Controller
{
    public function index()
    {
        $kost = Kost::latest()->paginate(10);
        return view(route('admin.kost.index'), compact('kost'));
    }
}
