<?php

namespace App\Policies;

use App\Models\Seo;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SeoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the seo can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list seos');
    }

    /**
     * Determine whether the seo can view the model.
     */
    public function view(User $user, Seo $model): bool
    {
        return $user->hasPermissionTo('view seos');
    }

    /**
     * Determine whether the seo can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create seos');
    }

    /**
     * Determine whether the seo can update the model.
     */
    public function update(User $user, Seo $model): bool
    {
        return $user->hasPermissionTo('update seos');
    }

    /**
     * Determine whether the seo can delete the model.
     */
    public function delete(User $user, Seo $model): bool
    {
        return $user->hasPermissionTo('delete seos');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete seos');
    }

    /**
     * Determine whether the seo can restore the model.
     */
    public function restore(User $user, Seo $model): bool
    {
        return false;
    }

    /**
     * Determine whether the seo can permanently delete the model.
     */
    public function forceDelete(User $user, Seo $model): bool
    {
        return false;
    }
}
