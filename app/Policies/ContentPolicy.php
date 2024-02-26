<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Content;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the content can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list contents');
    }

    /**
     * Determine whether the content can view the model.
     */
    public function view(User $user, Content $model): bool
    {
        return $user->hasPermissionTo('view contents');
    }

    /**
     * Determine whether the content can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create contents');
    }

    /**
     * Determine whether the content can update the model.
     */
    public function update(User $user, Content $model): bool
    {
        return $user->hasPermissionTo('update contents');
    }

    /**
     * Determine whether the content can delete the model.
     */
    public function delete(User $user, Content $model): bool
    {
        return $user->hasPermissionTo('delete contents');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete contents');
    }

    /**
     * Determine whether the content can restore the model.
     */
    public function restore(User $user, Content $model): bool
    {
        return false;
    }

    /**
     * Determine whether the content can permanently delete the model.
     */
    public function forceDelete(User $user, Content $model): bool
    {
        return false;
    }
}
