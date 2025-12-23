<?php

namespace App\Services;

use App\Models\Complaint;
use Illuminate\Support\Facades\Auth;

class TenantComplaintService
{
    public function getAll()
    {
        return Complaint::where('user_id', Auth::id())->latest()->paginate(10);
    }

    public function load(Complaint $complaint)
    {
        return $complaint->load('user');
    }

    public function store(array $data)
    {
        return Complaint::create($data);
    }

    public function update(Complaint $complaint, array $data)
    {
        $complaint->update($data);
        return $complaint;
    }

    public function destroy(Complaint $complaint)
    {
        $complaint->delete();
    }
}
