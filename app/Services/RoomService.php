<?php

namespace App\Services;

use App\Models\Kost;
use App\Models\Room;

class RoomService
{
    public function getAll()
    {
        return Room::with('kost')->latest()->paginate(10);
    }

    public function read(Room $room)
    {
        return $room;
    }

    public function create(array $data): Room
    {
        return Room::create($data);
    }

    public function update(Room $room, array $data): Room
    {
        $room->update($data);
        return $room;
    }

    public function delete(Room $room): void
    {
        $room->delete();
    }

    public function getKosts()
    {
        return Kost::all();
    }
}
