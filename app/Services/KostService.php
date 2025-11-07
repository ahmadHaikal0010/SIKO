<?php

namespace App\Services;

use App\Models\Kost;

class KostService
{
    public function getAll()
    {
        return Kost::with('rooms')->latest()->paginate(10);
    }

    public function create(array $data): Kost
    {
        return Kost::create($data);
    }

    public function update(Kost $kost, array $data): Kost
    {
        $kost->update($data);
        return $kost;
    }

    public function delete(Kost $kost): void
    {
        $kost->delete();
    }
}
