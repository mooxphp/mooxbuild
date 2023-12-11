<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Timezone;
use Illuminate\Auth\Access\HandlesAuthorization;

class TimezonePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the timezone can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the timezone can view the model.
     */
    public function view(User $user, Timezone $model): bool
    {
        return true;
    }

    /**
     * Determine whether the timezone can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the timezone can update the model.
     */
    public function update(User $user, Timezone $model): bool
    {
        return true;
    }

    /**
     * Determine whether the timezone can delete the model.
     */
    public function delete(User $user, Timezone $model): bool
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
     * Determine whether the timezone can restore the model.
     */
    public function restore(User $user, Timezone $model): bool
    {
        return false;
    }

    /**
     * Determine whether the timezone can permanently delete the model.
     */
    public function forceDelete(User $user, Timezone $model): bool
    {
        return false;
    }
}
