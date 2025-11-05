<?php

namespace App\Services;

use App\Models\Kost;

class KostService
{
    public function getAll()
    {
        return Kost::latest()->paginate(10);
    }

    public function create(array $data): Kost
    {
        return Kost::create($data);
    }

    public function update(Kost $kost, array $data): bool
    {
        return $kost->update($data);
    }
}
