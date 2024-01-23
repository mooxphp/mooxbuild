<?php

namespace App\Policies;

use App\Models\Sync;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SyncPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the sync can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the sync can view the model.
     */
    public function view(User $user, Sync $model): bool
    {
        return true;
    }

    /**
     * Determine whether the sync can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the sync can update the model.
     */
    public function update(User $user, Sync $model): bool
    {
        return true;
    }

    /**
     * Determine whether the sync can delete the model.
     */
    public function delete(User $user, Sync $model): bool
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
     * Determine whether the sync can restore the model.
     */
    public function restore(User $user, Sync $model): bool
    {
        return false;
    }

    /**
     * Determine whether the sync can permanently delete the model.
     */
    public function forceDelete(User $user, Sync $model): bool
    {
        return false;
    }
}
