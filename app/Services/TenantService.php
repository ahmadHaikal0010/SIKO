<?php

namespace App\Services;

use App\Models\Room;
use App\Models\Tenant;
use App\Models\User;

class TenantService
{
    public function getAll()
    {
        return Tenant::with('room.kost')->latest()->paginate(10);
    }

    public function read(Tenant $tenant)
    {
        return $tenant->load('room.kost');
    }

    public function create(array $data)
    {
        return Tenant::create($data);
    }

    public function update(Tenant $tenant, array $data)
    {
        $tenant->update($data);
        return $tenant;
    }

    public function delete(Tenant $tenant)
    {
        $tenant->delete();
    }

    public function getUsers()
    {
        return User::all();
    }

    public function getRooms()
    {
        return Room::all();
    }
}
