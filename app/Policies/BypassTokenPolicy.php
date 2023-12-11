<?php

namespace App\Policies;

use App\Models\User;
use App\Models\BypassToken;
use Illuminate\Auth\Access\HandlesAuthorization;

class BypassTokenPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the bypassToken can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the bypassToken can view the model.
     */
    public function view(User $user, BypassToken $model): bool
    {
        return true;
    }

    /**
     * Determine whether the bypassToken can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the bypassToken can update the model.
     */
    public function update(User $user, BypassToken $model): bool
    {
        return true;
    }

    /**
     * Determine whether the bypassToken can delete the model.
     */
    public function delete(User $user, BypassToken $model): bool
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
     * Determine whether the bypassToken can restore the model.
     */
    public function restore(User $user, BypassToken $model): bool
    {
        return false;
    }

    /**
     * Determine whether the bypassToken can permanently delete the model.
     */
    public function forceDelete(User $user, BypassToken $model): bool
    {
        return false;
    }
}
