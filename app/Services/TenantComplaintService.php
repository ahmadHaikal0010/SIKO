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

    public function store(\Illuminate\Http\Request $request)
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;

        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('complaints', 'public');
            $data['attachment'] = $path;
        }

        return Complaint::create($data);
    }

    public function update(Complaint $complaint, array $data, \Illuminate\Http\Request $request = null)
    {
        if ($request && $request->hasFile('attachment')) {
            // optionally remove the old file
            if ($complaint->attachment) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($complaint->attachment);
            }
            $data['attachment'] = $request->file('attachment')->store('complaints', 'public');
        }

        $complaint->update($data);
        return $complaint;
    }

    public function destroy(Complaint $complaint)
    {
        $complaint->delete();
    }
}
