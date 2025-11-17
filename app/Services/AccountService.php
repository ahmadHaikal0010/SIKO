<?php

namespace App\Services;

use App\Models\User;

class AccountService
{
    public function getAll()
    {
        return User::with('tenant')->where('role', 'user')->latest()->paginate(10);
    }

    public function store(array $data)
    {
        return User::create($data);
    }

    public function read(User $user)
    {
        return $user->load('tenant');
    }

    public function update(User $user, array $data)
    {
        return $user->update($data);
    }

    public function delete(User $user)
    {
        $user->delete();
    }

    public function accept(User $user)
    {
        $user->update(['is_accepted' => 'accepted']);
    }

    public function reject(User $user)
    {
        $user->update(['is_accepted' => 'rejected']);
    }
}
