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
        // hanya terima field yang boleh diupdate dari form admin
        $data = collect($data)->only(['status', 'tanggapan', 'tanggal_tanggapan'])->toArray();

        // kalau ada tanggapan tapi status belum diisi, set otomatis
        if (!empty($data['tanggapan']) && empty($data['status'])) {
            $data['status'] = 'ditanggapi';
        }

        // kalau ada tanggapan tapi tanggal belum diisi, set hari ini
        if (!empty($data['tanggapan']) && empty($data['tanggal_tanggapan'])) {
            $data['tanggal_tanggapan'] = now()->toDateString();
        }

        $complaint->update($data);

        return $complaint;
    }

    public function closed(Complaint $complaint)
    {
        return $complaint->update(['status' => 'selesai']);
    }
}
