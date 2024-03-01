<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WpOption;
use Illuminate\Auth\Access\HandlesAuthorization;

class WpOptionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the wpOption can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list wpoptions');
    }

    /**
     * Determine whether the wpOption can view the model.
     */
    public function view(User $user, WpOption $model): bool
    {
        return $user->hasPermissionTo('view wpoptions');
    }

    /**
     * Determine whether the wpOption can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create wpoptions');
    }

    /**
     * Determine whether the wpOption can update the model.
     */
    public function update(User $user, WpOption $model): bool
    {
        return $user->hasPermissionTo('update wpoptions');
    }

    /**
     * Determine whether the wpOption can delete the model.
     */
    public function delete(User $user, WpOption $model): bool
    {
        return $user->hasPermissionTo('delete wpoptions');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete wpoptions');
    }

    /**
     * Determine whether the wpOption can restore the model.
     */
    public function restore(User $user, WpOption $model): bool
    {
        return false;
    }

    /**
     * Determine whether the wpOption can permanently delete the model.
     */
    public function forceDelete(User $user, WpOption $model): bool
    {
        return false;
    }
}
