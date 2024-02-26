<?php

namespace App\Policies;

use App\Models\User;
use App\Models\FailedJob;
use Illuminate\Auth\Access\HandlesAuthorization;

class FailedJobPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the failedJob can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list failedjobs');
    }

    /**
     * Determine whether the failedJob can view the model.
     */
    public function view(User $user, FailedJob $model): bool
    {
        return $user->hasPermissionTo('view failedjobs');
    }

    /**
     * Determine whether the failedJob can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create failedjobs');
    }

    /**
     * Determine whether the failedJob can update the model.
     */
    public function update(User $user, FailedJob $model): bool
    {
        return $user->hasPermissionTo('update failedjobs');
    }

    /**
     * Determine whether the failedJob can delete the model.
     */
    public function delete(User $user, FailedJob $model): bool
    {
        return $user->hasPermissionTo('delete failedjobs');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete failedjobs');
    }

    /**
     * Determine whether the failedJob can restore the model.
     */
    public function restore(User $user, FailedJob $model): bool
    {
        return false;
    }

    /**
     * Determine whether the failedJob can permanently delete the model.
     */
    public function forceDelete(User $user, FailedJob $model): bool
    {
        return false;
    }
}
