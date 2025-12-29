<?php

namespace App\Policies;

use App\Models\Complaint;
use App\Models\User;

class ComplaintPolicy
{
    public function viewAny(User $user): bool
    {
        return false;
    }

    public function view(User $user, Complaint $complaint): bool
    {
        return false;
    }

    public function create(User $user): bool
    {
        return $user->role === 'penghuni';
    }

    public function update(User $user, Complaint $complaint): bool
    {
        if ($user->role === 'admin') {
            return true;
        }

        if ($user->role === 'penghuni') {
            return $complaint->user_id === $user->id;
        }

        return false;
    }

    public function delete(User $user, Complaint $complaint): bool
    {
        if ($user->role === 'admin') {
            return true;
        }

        if ($user->role === 'penghuni') {
            return $complaint->user_id === $user->id;
        }

        return false;
    }

    public function restore(User $user, Complaint $complaint): bool
    {
        return false;
    }

    public function forceDelete(User $user, Complaint $complaint): bool
    {
        return false;
    }
}
