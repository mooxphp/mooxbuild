<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Theme;
use Illuminate\Auth\Access\HandlesAuthorization;

class ThemePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the theme can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the theme can view the model.
     */
    public function view(User $user, Theme $model): bool
    {
        return true;
    }

    /**
     * Determine whether the theme can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the theme can update the model.
     */
    public function update(User $user, Theme $model): bool
    {
        return true;
    }

    /**
     * Determine whether the theme can delete the model.
     */
    public function delete(User $user, Theme $model): bool
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
     * Determine whether the theme can restore the model.
     */
    public function restore(User $user, Theme $model): bool
    {
        return false;
    }

    /**
     * Determine whether the theme can permanently delete the model.
     */
    public function forceDelete(User $user, Theme $model): bool
    {
        return false;
    }
}
