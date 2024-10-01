<?php

namespace App\Policies;

use App\Models\FresqueApplication;
use App\Models\User;

class FresqueApplicationPolicy
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
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, FresqueApplication $fresqueApplication): bool
    {
        return $user->can('view', $fresqueApplication->fresque);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, FresqueApplication $fresqueApplication): bool
    {
        return $user->can('update', $fresqueApplication->fresque);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, FresqueApplication $fresqueApplication): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, FresqueApplication $fresqueApplication): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, FresqueApplication $fresqueApplication): bool
    {
        return false;
    }
}
