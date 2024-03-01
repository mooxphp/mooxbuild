<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WpPost;
use Illuminate\Auth\Access\HandlesAuthorization;

class WpPostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the wpPost can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list wpposts');
    }

    /**
     * Determine whether the wpPost can view the model.
     */
    public function view(User $user, WpPost $model): bool
    {
        return $user->hasPermissionTo('view wpposts');
    }

    /**
     * Determine whether the wpPost can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create wpposts');
    }

    /**
     * Determine whether the wpPost can update the model.
     */
    public function update(User $user, WpPost $model): bool
    {
        return $user->hasPermissionTo('update wpposts');
    }

    /**
     * Determine whether the wpPost can delete the model.
     */
    public function delete(User $user, WpPost $model): bool
    {
        return $user->hasPermissionTo('delete wpposts');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete wpposts');
    }

    /**
     * Determine whether the wpPost can restore the model.
     */
    public function restore(User $user, WpPost $model): bool
    {
        return false;
    }

    /**
     * Determine whether the wpPost can permanently delete the model.
     */
    public function forceDelete(User $user, WpPost $model): bool
    {
        return false;
    }
}
