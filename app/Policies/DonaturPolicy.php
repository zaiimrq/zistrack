<?php

namespace App\Policies;

use App\Models\Donatur;
use App\Models\User;

class DonaturPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin() || $user->isUser();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Donatur $donatur): bool
    {
        return $user->isAdmin() || $user->isUser();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin() || $user->isUser();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Donatur $donatur): bool
    {
        return $user->isAdmin() || $user->isUser();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Donatur $donatur): bool
    {
        return $user->isAdmin() || $user->isUser();
    }
}
