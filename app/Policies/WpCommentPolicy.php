<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WpComment;
use Illuminate\Auth\Access\HandlesAuthorization;

class WpCommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the wpComment can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list wpcomments');
    }

    /**
     * Determine whether the wpComment can view the model.
     */
    public function view(User $user, WpComment $model): bool
    {
        return $user->hasPermissionTo('view wpcomments');
    }

    /**
     * Determine whether the wpComment can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create wpcomments');
    }

    /**
     * Determine whether the wpComment can update the model.
     */
    public function update(User $user, WpComment $model): bool
    {
        return $user->hasPermissionTo('update wpcomments');
    }

    /**
     * Determine whether the wpComment can delete the model.
     */
    public function delete(User $user, WpComment $model): bool
    {
        return $user->hasPermissionTo('delete wpcomments');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete wpcomments');
    }

    /**
     * Determine whether the wpComment can restore the model.
     */
    public function restore(User $user, WpComment $model): bool
    {
        return false;
    }

    /**
     * Determine whether the wpComment can permanently delete the model.
     */
    public function forceDelete(User $user, WpComment $model): bool
    {
        return false;
    }
}
