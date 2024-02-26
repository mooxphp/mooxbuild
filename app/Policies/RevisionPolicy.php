<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Revision;
use Illuminate\Auth\Access\HandlesAuthorization;

class RevisionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the revision can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list revisions');
    }

    /**
     * Determine whether the revision can view the model.
     */
    public function view(User $user, Revision $model): bool
    {
        return $user->hasPermissionTo('view revisions');
    }

    /**
     * Determine whether the revision can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create revisions');
    }

    /**
     * Determine whether the revision can update the model.
     */
    public function update(User $user, Revision $model): bool
    {
        return $user->hasPermissionTo('update revisions');
    }

    /**
     * Determine whether the revision can delete the model.
     */
    public function delete(User $user, Revision $model): bool
    {
        return $user->hasPermissionTo('delete revisions');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete revisions');
    }

    /**
     * Determine whether the revision can restore the model.
     */
    public function restore(User $user, Revision $model): bool
    {
        return false;
    }

    /**
     * Determine whether the revision can permanently delete the model.
     */
    public function forceDelete(User $user, Revision $model): bool
    {
        return false;
    }
}
