<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Platform;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlatformPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the platform can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the platform can view the model.
     */
    public function view(User $user, Platform $model): bool
    {
        return true;
    }

    /**
     * Determine whether the platform can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the platform can update the model.
     */
    public function update(User $user, Platform $model): bool
    {
        return true;
    }

    /**
     * Determine whether the platform can delete the model.
     */
    public function delete(User $user, Platform $model): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the platform can restore the model.
     */
    public function restore(User $user, Platform $model): bool
    {
        return false;
    }

    /**
     * Determine whether the platform can permanently delete the model.
     */
    public function forceDelete(User $user, Platform $model): bool
    {
        return false;
    }
}
