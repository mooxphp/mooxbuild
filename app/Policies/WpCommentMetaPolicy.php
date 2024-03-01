<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WpCommentMeta;
use Illuminate\Auth\Access\HandlesAuthorization;

class WpCommentMetaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the wpCommentMeta can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list wpcommentmetas');
    }

    /**
     * Determine whether the wpCommentMeta can view the model.
     */
    public function view(User $user, WpCommentMeta $model): bool
    {
        return $user->hasPermissionTo('view wpcommentmetas');
    }

    /**
     * Determine whether the wpCommentMeta can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create wpcommentmetas');
    }

    /**
     * Determine whether the wpCommentMeta can update the model.
     */
    public function update(User $user, WpCommentMeta $model): bool
    {
        return $user->hasPermissionTo('update wpcommentmetas');
    }

    /**
     * Determine whether the wpCommentMeta can delete the model.
     */
    public function delete(User $user, WpCommentMeta $model): bool
    {
        return $user->hasPermissionTo('delete wpcommentmetas');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete wpcommentmetas');
    }

    /**
     * Determine whether the wpCommentMeta can restore the model.
     */
    public function restore(User $user, WpCommentMeta $model): bool
    {
        return false;
    }

    /**
     * Determine whether the wpCommentMeta can permanently delete the model.
     */
    public function forceDelete(User $user, WpCommentMeta $model): bool
    {
        return false;
    }
}
