<?php

namespace App\Services;

use App\Models\RentalExtension;

class RentalExtensionService
{
    public function getAll()
    {
        return RentalExtension::with('tenant')->latest()->paginate(10);
    }

    public function read(RentalExtension $rentalExtension)
    {
        return $rentalExtension->load('tenant');
    }

    public function destroy(RentalExtension $rentalExtension)
    {
        return $rentalExtension->delete();
    }

    public function accept(RentalExtension $rentalExtension)
    {
        $rentalExtension->update(['status' => 'approved']);
    }

    public function reject(RentalExtension $rentalExtension)
    {
        $rentalExtension->update(['status' => 'rejected']);
    }
}
