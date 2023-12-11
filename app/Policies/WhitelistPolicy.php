<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Whitelist;
use Illuminate\Auth\Access\HandlesAuthorization;

class WhitelistPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the whitelist can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the whitelist can view the model.
     */
    public function view(User $user, Whitelist $model): bool
    {
        return true;
    }

    /**
     * Determine whether the whitelist can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the whitelist can update the model.
     */
    public function update(User $user, Whitelist $model): bool
    {
        return true;
    }

    /**
     * Determine whether the whitelist can delete the model.
     */
    public function delete(User $user, Whitelist $model): bool
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
     * Determine whether the whitelist can restore the model.
     */
    public function restore(User $user, Whitelist $model): bool
    {
        return false;
    }

    /**
     * Determine whether the whitelist can permanently delete the model.
     */
    public function forceDelete(User $user, Whitelist $model): bool
    {
        return false;
    }
}
