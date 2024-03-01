<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Session;
use Illuminate\Auth\Access\HandlesAuthorization;

class SessionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the session can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list sessions');
    }

    /**
     * Determine whether the session can view the model.
     */
    public function view(User $user, Session $model): bool
    {
        return $user->hasPermissionTo('view sessions');
    }

    /**
     * Determine whether the session can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create sessions');
    }

    /**
     * Determine whether the session can update the model.
     */
    public function update(User $user, Session $model): bool
    {
        return $user->hasPermissionTo('update sessions');
    }

    /**
     * Determine whether the session can delete the model.
     */
    public function delete(User $user, Session $model): bool
    {
        return $user->hasPermissionTo('delete sessions');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete sessions');
    }

    /**
     * Determine whether the session can restore the model.
     */
    public function restore(User $user, Session $model): bool
    {
        return false;
    }

    /**
     * Determine whether the session can permanently delete the model.
     */
    public function forceDelete(User $user, Session $model): bool
    {
        return false;
    }
}
