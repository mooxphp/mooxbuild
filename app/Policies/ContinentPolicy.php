<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Continent;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContinentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the continent can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the continent can view the model.
     */
    public function view(User $user, Continent $model): bool
    {
        return true;
    }

    /**
     * Determine whether the continent can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the continent can update the model.
     */
    public function update(User $user, Continent $model): bool
    {
        return true;
    }

    /**
     * Determine whether the continent can delete the model.
     */
    public function delete(User $user, Continent $model): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the continent can restore the model.
     */
    public function restore(User $user, Continent $model): bool
    {
        return false;
    }

    /**
     * Determine whether the continent can permanently delete the model.
     */
    public function forceDelete(User $user, Continent $model): bool
    {
        return false;
    }
}
