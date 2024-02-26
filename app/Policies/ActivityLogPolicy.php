<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Auth\Access\HandlesAuthorization;

class ActivityLogPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the activityLog can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list activitylogs');
    }

    /**
     * Determine whether the activityLog can view the model.
     */
    public function view(User $user, ActivityLog $model): bool
    {
        return $user->hasPermissionTo('view activitylogs');
    }

    /**
     * Determine whether the activityLog can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create activitylogs');
    }

    /**
     * Determine whether the activityLog can update the model.
     */
    public function update(User $user, ActivityLog $model): bool
    {
        return $user->hasPermissionTo('update activitylogs');
    }

    /**
     * Determine whether the activityLog can delete the model.
     */
    public function delete(User $user, ActivityLog $model): bool
    {
        return $user->hasPermissionTo('delete activitylogs');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete activitylogs');
    }

    /**
     * Determine whether the activityLog can restore the model.
     */
    public function restore(User $user, ActivityLog $model): bool
    {
        return false;
    }

    /**
     * Determine whether the activityLog can permanently delete the model.
     */
    public function forceDelete(User $user, ActivityLog $model): bool
    {
        return false;
    }
}
