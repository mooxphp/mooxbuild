<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Expiry;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExpiryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the expiry can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list expiries');
    }

    /**
     * Determine whether the expiry can view the model.
     */
    public function view(User $user, Expiry $model): bool
    {
        return $user->hasPermissionTo('view expiries');
    }

    /**
     * Determine whether the expiry can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create expiries');
    }

    /**
     * Determine whether the expiry can update the model.
     */
    public function update(User $user, Expiry $model): bool
    {
        return $user->hasPermissionTo('update expiries');
    }

    /**
     * Determine whether the expiry can delete the model.
     */
    public function delete(User $user, Expiry $model): bool
    {
        return $user->hasPermissionTo('delete expiries');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete expiries');
    }

    /**
     * Determine whether the expiry can restore the model.
     */
    public function restore(User $user, Expiry $model): bool
    {
        return false;
    }

    /**
     * Determine whether the expiry can permanently delete the model.
     */
    public function forceDelete(User $user, Expiry $model): bool
    {
        return false;
    }
}
