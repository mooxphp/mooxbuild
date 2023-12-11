<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Blacklist;
use Illuminate\Auth\Access\HandlesAuthorization;

class BlacklistPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the blacklist can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the blacklist can view the model.
     */
    public function view(User $user, Blacklist $model): bool
    {
        return true;
    }

    /**
     * Determine whether the blacklist can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the blacklist can update the model.
     */
    public function update(User $user, Blacklist $model): bool
    {
        return true;
    }

    /**
     * Determine whether the blacklist can delete the model.
     */
    public function delete(User $user, Blacklist $model): bool
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
     * Determine whether the blacklist can restore the model.
     */
    public function restore(User $user, Blacklist $model): bool
    {
        return false;
    }

    /**
     * Determine whether the blacklist can permanently delete the model.
     */
    public function forceDelete(User $user, Blacklist $model): bool
    {
        return false;
    }
}
