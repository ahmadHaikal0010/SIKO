<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Complaint\UpdateComplaintRequest;
use App\Models\Complaint;
use App\Services\ComplaintService;
use Illuminate\Support\Facades\Gate;

class ComplaintController extends Controller
{
    protected ComplaintService $complaintService;

    public function __construct(ComplaintService $complaintService)
    {
        $this->complaintService = $complaintService;
    }

    public function index()
    {
        $complaints = $this->complaintService->getAll();
        return view('admin.complaint.index', compact('complaints'));
    }

    public function show(Complaint $complaint)
    {
        $complaint = $this->complaintService->load($complaint);
        return view('admin.complaint.show', compact('complaint'));
    }

    public function destroy(Complaint $complaint)
    {
        Gate::authorize('delete', $complaint);
        $this->complaintService->destroy($complaint);
        return redirect()->route('admin.complaint.index')->with('success', 'Aduan berhasil dihapus.');
    }

    public function response(UpdateComplaintRequest $request, Complaint $complaint)
    {
        $this->complaintService->response($complaint, $request->validated());
        return redirect()->route('admin.complaint.index')->with('success', 'Aduan berhasil ditanggapi.');
    }

    public function closed(Complaint $complaint)
    {
        $this->complaintService->closed($complaint);
        return redirect()->route('admin.complaint.index')->with('success', 'Aduan berhasil ditutup.');
    }
}
