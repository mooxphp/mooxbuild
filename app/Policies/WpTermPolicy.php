<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WpTerm;
use Illuminate\Auth\Access\HandlesAuthorization;

class WpTermPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the wpTerm can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list wpterms');
    }

    /**
     * Determine whether the wpTerm can view the model.
     */
    public function view(User $user, WpTerm $model): bool
    {
        return $user->hasPermissionTo('view wpterms');
    }

    /**
     * Determine whether the wpTerm can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create wpterms');
    }

    /**
     * Determine whether the wpTerm can update the model.
     */
    public function update(User $user, WpTerm $model): bool
    {
        return $user->hasPermissionTo('update wpterms');
    }

    /**
     * Determine whether the wpTerm can delete the model.
     */
    public function delete(User $user, WpTerm $model): bool
    {
        return $user->hasPermissionTo('delete wpterms');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete wpterms');
    }

    /**
     * Determine whether the wpTerm can restore the model.
     */
    public function restore(User $user, WpTerm $model): bool
    {
        return false;
    }

    /**
     * Determine whether the wpTerm can permanently delete the model.
     */
    public function forceDelete(User $user, WpTerm $model): bool
    {
        return false;
    }
}
