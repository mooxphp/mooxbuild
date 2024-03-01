<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WpUserMeta;
use Illuminate\Auth\Access\HandlesAuthorization;

class WpUserMetaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the wpUserMeta can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list wpusermetas');
    }

    /**
     * Determine whether the wpUserMeta can view the model.
     */
    public function view(User $user, WpUserMeta $model): bool
    {
        return $user->hasPermissionTo('view wpusermetas');
    }

    /**
     * Determine whether the wpUserMeta can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create wpusermetas');
    }

    /**
     * Determine whether the wpUserMeta can update the model.
     */
    public function update(User $user, WpUserMeta $model): bool
    {
        return $user->hasPermissionTo('update wpusermetas');
    }

    /**
     * Determine whether the wpUserMeta can delete the model.
     */
    public function delete(User $user, WpUserMeta $model): bool
    {
        return $user->hasPermissionTo('delete wpusermetas');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete wpusermetas');
    }

    /**
     * Determine whether the wpUserMeta can restore the model.
     */
    public function restore(User $user, WpUserMeta $model): bool
    {
        return false;
    }

    /**
     * Determine whether the wpUserMeta can permanently delete the model.
     */
    public function forceDelete(User $user, WpUserMeta $model): bool
    {
        return false;
    }
}
