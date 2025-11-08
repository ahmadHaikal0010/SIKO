<?php

namespace App\Services;

use App\Models\Tenant;

class TenantService
{
    public function getAll()
    {
        return Tenant::with('kost', 'room')->latest()->paginate(10);
    }

    public function read(Tenant $tenant)
    {
        return $tenant->load('kost', 'room');
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
}
