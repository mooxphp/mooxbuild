<?php

namespace App\Policies;

use App\Models\User;
use App\Models\PostalCode;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostalCodePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the postalCode can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list postalcodes');
    }

    /**
     * Determine whether the postalCode can view the model.
     */
    public function view(User $user, PostalCode $model): bool
    {
        return $user->hasPermissionTo('view postalcodes');
    }

    /**
     * Determine whether the postalCode can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create postalcodes');
    }

    /**
     * Determine whether the postalCode can update the model.
     */
    public function update(User $user, PostalCode $model): bool
    {
        return $user->hasPermissionTo('update postalcodes');
    }

    /**
     * Determine whether the postalCode can delete the model.
     */
    public function delete(User $user, PostalCode $model): bool
    {
        return $user->hasPermissionTo('delete postalcodes');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete postalcodes');
    }

    /**
     * Determine whether the postalCode can restore the model.
     */
    public function restore(User $user, PostalCode $model): bool
    {
        return false;
    }

    /**
     * Determine whether the postalCode can permanently delete the model.
     */
    public function forceDelete(User $user, PostalCode $model): bool
    {
        return false;
    }
}
