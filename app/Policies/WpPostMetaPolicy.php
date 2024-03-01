<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WpPostMeta;
use Illuminate\Auth\Access\HandlesAuthorization;

class WpPostMetaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the wpPostMeta can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list wppostmetas');
    }

    /**
     * Determine whether the wpPostMeta can view the model.
     */
    public function view(User $user, WpPostMeta $model): bool
    {
        return $user->hasPermissionTo('view wppostmetas');
    }

    /**
     * Determine whether the wpPostMeta can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create wppostmetas');
    }

    /**
     * Determine whether the wpPostMeta can update the model.
     */
    public function update(User $user, WpPostMeta $model): bool
    {
        return $user->hasPermissionTo('update wppostmetas');
    }

    /**
     * Determine whether the wpPostMeta can delete the model.
     */
    public function delete(User $user, WpPostMeta $model): bool
    {
        return $user->hasPermissionTo('delete wppostmetas');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete wppostmetas');
    }

    /**
     * Determine whether the wpPostMeta can restore the model.
     */
    public function restore(User $user, WpPostMeta $model): bool
    {
        return false;
    }

    /**
     * Determine whether the wpPostMeta can permanently delete the model.
     */
    public function forceDelete(User $user, WpPostMeta $model): bool
    {
        return false;
    }
}
