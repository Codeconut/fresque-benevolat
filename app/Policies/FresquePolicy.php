<?php

namespace App\Policies;

use App\Models\Fresque;
use App\Models\User;

class FresquePolicy
{
    public function before($user, $ability)
    {
        if ($user->hasRole('admin')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Fresque $fresque): bool
    {
        if (Fresque::managedBy($user)->where('id', $fresque->id)->exists()) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole(['admin', 'animator']);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Fresque $fresque): bool
    {
        if (Fresque::managedBy($user)->where('id', $fresque->id)->exists()) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function replicate(User $user, Fresque $fresque): bool
    {
        return $user->id === $fresque->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Fresque $fresque): bool
    {
        return $user->id === $fresque->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Fresque $fresque): bool
    {
        return $user->id === $fresque->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Fresque $fresque): bool
    {
        return false;
    }
}
