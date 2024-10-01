<?php

namespace App\Policies;

use App\Models\FresqueApplicationFeedback;
use App\Models\User;

class FresqueApplicationFeedbackPolicy
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
    public function view(User $user, FresqueApplicationFeedback $fresqueApplicationFeedback): bool
    {
        return $user->can('view', $fresqueApplicationFeedback->application->fresque);
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
    public function update(User $user, FresqueApplicationFeedback $fresqueApplicationFeedback): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, FresqueApplicationFeedback $fresqueApplicationFeedback): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, FresqueApplicationFeedback $fresqueApplicationFeedback): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, FresqueApplicationFeedback $fresqueApplicationFeedback): bool
    {
        return false;
    }
}
