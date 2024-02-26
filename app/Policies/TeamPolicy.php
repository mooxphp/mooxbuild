<?php

namespace App\Policies;

use App\Models\Team;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TeamPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the team can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list teams');
    }

    /**
     * Determine whether the team can view the model.
     */
    public function view(User $user, Team $model): bool
    {
        return $user->hasPermissionTo('view teams');
    }

    /**
     * Determine whether the team can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create teams');
    }

    /**
     * Determine whether the team can update the model.
     */
    public function update(User $user, Team $model): bool
    {
        return $user->hasPermissionTo('update teams');
    }

    /**
     * Determine whether the team can delete the model.
     */
    public function delete(User $user, Team $model): bool
    {
        return $user->hasPermissionTo('delete teams');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete teams');
    }

    /**
     * Determine whether the team can restore the model.
     */
    public function restore(User $user, Team $model): bool
    {
        return false;
    }

    /**
     * Determine whether the team can permanently delete the model.
     */
    public function forceDelete(User $user, Team $model): bool
    {
        return false;
    }
}
