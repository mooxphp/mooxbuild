<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WpUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class WpUserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the wpUser can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list wpusers');
    }

    /**
     * Determine whether the wpUser can view the model.
     */
    public function view(User $user, WpUser $model): bool
    {
        return $user->hasPermissionTo('view wpusers');
    }

    /**
     * Determine whether the wpUser can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create wpusers');
    }

    /**
     * Determine whether the wpUser can update the model.
     */
    public function update(User $user, WpUser $model): bool
    {
        return $user->hasPermissionTo('update wpusers');
    }

    /**
     * Determine whether the wpUser can delete the model.
     */
    public function delete(User $user, WpUser $model): bool
    {
        return $user->hasPermissionTo('delete wpusers');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete wpusers');
    }

    /**
     * Determine whether the wpUser can restore the model.
     */
    public function restore(User $user, WpUser $model): bool
    {
        return false;
    }

    /**
     * Determine whether the wpUser can permanently delete the model.
     */
    public function forceDelete(User $user, WpUser $model): bool
    {
        return false;
    }
}
