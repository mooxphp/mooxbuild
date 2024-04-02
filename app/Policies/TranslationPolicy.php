<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Translation;
use Illuminate\Auth\Access\HandlesAuthorization;

class TranslationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the translation can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list translations');
    }

    /**
     * Determine whether the translation can view the model.
     */
    public function view(User $user, Translation $model): bool
    {
        return $user->hasPermissionTo('view translations');
    }

    /**
     * Determine whether the translation can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create translations');
    }

    /**
     * Determine whether the translation can update the model.
     */
    public function update(User $user, Translation $model): bool
    {
        return $user->hasPermissionTo('update translations');
    }

    /**
     * Determine whether the translation can delete the model.
     */
    public function delete(User $user, Translation $model): bool
    {
        return $user->hasPermissionTo('delete translations');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete translations');
    }

    /**
     * Determine whether the translation can restore the model.
     */
    public function restore(User $user, Translation $model): bool
    {
        return false;
    }

    /**
     * Determine whether the translation can permanently delete the model.
     */
    public function forceDelete(User $user, Translation $model): bool
    {
        return false;
    }
}
