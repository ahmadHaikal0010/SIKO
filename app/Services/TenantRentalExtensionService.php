<?php

namespace App\Services;

use App\Models\RentalExtension;

class TenantRentalExtensionService
{
    public function getAll($tenantId = null)
    {
        $query = RentalExtension::with('tenant')->latest();
        if ($tenantId) {
            $query->where('tenant_id', $tenantId);
        }
        return $query->paginate(10);
    }

    public function read(RentalExtension $rentalExtension)
    {
        return $rentalExtension->load('tenant');
    }

    public function store(array $data)
    {
        return RentalExtension::create($data);
    }

    public function update(RentalExtension $rentalExtension, array $data)
    {
        return $rentalExtension->update($data);
    }

    public function delete(RentalExtension $rentalExtension)
    {
        return $rentalExtension->delete();
    }
}
