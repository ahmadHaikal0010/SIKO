<?php

namespace App\Services;

use App\Models\Complaint;

class ComplaintService
{
    public function getAll()
    {
        return Complaint::with('user')->latest()->paginate(10);
    }

    public function load(Complaint $complaint)
    {
        return $complaint->load('user');
    }

    public function destroy(Complaint $complaint)
    {
        return $complaint->delete();
    }

    public function response(Complaint $complaint, array $data)
    {
        return $complaint->update($data, ['status' => 'ditanggapi']);
    }

    public function closed(Complaint $complaint)
    {
        return $complaint->update(['status' => 'selesai']);
    }
}
