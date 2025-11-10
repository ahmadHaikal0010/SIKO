<?php

namespace App\Services;

use App\Models\Room;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;

class TenantService
{
    /**
     * List tenants dengan filter ringan (q, status) + eager load.
     */
    public function getAll()
    {
        return Tenant::with(['room.kost'])
            ->when(request('q'), function ($q, $term) {
                $q->where(function ($s) use ($term) {
                    $s->where('nama_penghuni', 'like', "%{$term}%")
                      ->orWhere('telpon', 'like', "%{$term}%");
                });
            })
            ->when(request('status'), fn($q, $st) => $q->where('status', $st))
            ->latest()
            ->paginate(10);
    }

    public function read(Tenant $tenant)
    {
        return $tenant->load(['room.kost', 'user']);
    }

    /**
     * Buat tenant baru + set kamar = occupied.
     * Menolak jika kamar sudah occupied.
     */
    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            /** @var Room $room */
            $room = Room::lockForUpdate()->findOrFail($data['room_id']);

            if ($room->status !== 'available') {
                throw ValidationException::withMessages([
                    'room_id' => 'Kamar yang dipilih sedang terisi.',
                ]);
            }

            // default status jika tidak dikirim
            if (empty($data['status'])) {
                $data['status'] = 'active';
            }

            // default tanggal_masuk
            if (empty($data['tanggal_masuk'])) {
                $data['tanggal_masuk'] = Carbon::now()->toDateString();
            }

            $tenant = Tenant::create($data);

            // isi kamar
            $room->update(['status' => 'occupied']);

            return $tenant->load(['room.kost', 'user']);
        });
    }

    /**
     * Update tenant:
     * - Jika pindah kamar: kosongkan kamar lama, isi kamar baru (jika available).
     * - Jika status diubah ke finished: kosongkan kamar & set tanggal_keluar jika kosong.
     */
    public function update(Tenant $tenant, array $data)
    {
        return DB::transaction(function () use ($tenant, $data) {

            $oldRoomId = $tenant->room_id;

            // Pindah kamar?
            if (isset($data['room_id']) && (int)$data['room_id'] !== (int)$oldRoomId) {
                $newRoom = Room::lockForUpdate()->findOrFail($data['room_id']);

                if ($newRoom->status !== 'available') {
                    throw ValidationException::withMessages([
                        'room_id' => 'Kamar baru yang dipilih sedang terisi.',
                    ]);
                }

                // kosongkan kamar lama (jika masih ada & masih occupied)
                if ($oldRoomId) {
                    $oldRoom = Room::lockForUpdate()->find($oldRoomId);
                    if ($oldRoom && $oldRoom->status === 'occupied') {
                        $oldRoom->update(['status' => 'available']);
                    }
                }

                // isi kamar baru
                $newRoom->update(['status' => 'occupied']);
            }

            // Perubahan status
            if (isset($data['status']) && $data['status'] === 'finished') {
                // pastikan kamar menjadi available
                if ($tenant->room_id) {
                    $r = Room::lockForUpdate()->find($tenant->room_id);
                    if ($r && $r->status === 'occupied') {
                        $r->update(['status' => 'available']);
                    }
                }
                // set tanggal_keluar kalau belum ada
                if (empty($data['tanggal_keluar'])) {
                    $data['tanggal_keluar'] = Carbon::now()->toDateString();
                }
            }

            $tenant->update($data);

            return $tenant->load(['room.kost', 'user']);
        });
    }

    /**
     * Hapus tenant dan bebaskan kamar jika masih occupied.
     */
    public function delete(Tenant $tenant)
    {
        DB::transaction(function () use ($tenant) {
            if ($tenant->room_id) {
                $room = Room::lockForUpdate()->find($tenant->room_id);
                if ($room && $room->status === 'occupied' && $tenant->status !== 'finished') {
                    // Jika dihitung "keluar" lewat hapus, anggap bebaskan kamar
                    $room->update(['status' => 'available']);
                }
            }
            $tenant->delete();
        });
    }

    /**
     * Untuk dropdown user (urut nama).
     */
    public function getUsers()
    {
        return User::orderBy('name')->get();
    }

    /**
     * Untuk dropdown kamar (lengkap dengan kost).
     * $onlyAvailable = true → hanya kamar available.
     */
    public function getRooms(bool $onlyAvailable = false)
    {
        return Room::with('kost')
            ->when($onlyAvailable, fn($q) => $q->where('status', 'available'))
            ->orderBy('kost_id')
            ->orderBy('nomor_kamar')
            ->get();
    }
}
