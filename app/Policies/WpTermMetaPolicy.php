<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WpTermMeta;
use Illuminate\Auth\Access\HandlesAuthorization;

class WpTermMetaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the wpTermMeta can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list wptermmetas');
    }

    /**
     * Determine whether the wpTermMeta can view the model.
     */
    public function view(User $user, WpTermMeta $model): bool
    {
        return $user->hasPermissionTo('view wptermmetas');
    }

    /**
     * Determine whether the wpTermMeta can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create wptermmetas');
    }

    /**
     * Determine whether the wpTermMeta can update the model.
     */
    public function update(User $user, WpTermMeta $model): bool
    {
        return $user->hasPermissionTo('update wptermmetas');
    }

    /**
     * Determine whether the wpTermMeta can delete the model.
     */
    public function delete(User $user, WpTermMeta $model): bool
    {
        return $user->hasPermissionTo('delete wptermmetas');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete wptermmetas');
    }

    /**
     * Determine whether the wpTermMeta can restore the model.
     */
    public function restore(User $user, WpTermMeta $model): bool
    {
        return false;
    }

    /**
     * Determine whether the wpTermMeta can permanently delete the model.
     */
    public function forceDelete(User $user, WpTermMeta $model): bool
    {
        return false;
    }
}
