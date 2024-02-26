<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Media;
use Illuminate\Auth\Access\HandlesAuthorization;

class MediaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the media can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list media');
    }

    /**
     * Determine whether the media can view the model.
     */
    public function view(User $user, Media $model): bool
    {
        return $user->hasPermissionTo('view media');
    }

    /**
     * Determine whether the media can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create media');
    }

    /**
     * Determine whether the media can update the model.
     */
    public function update(User $user, Media $model): bool
    {
        return $user->hasPermissionTo('update media');
    }

    /**
     * Determine whether the media can delete the model.
     */
    public function delete(User $user, Media $model): bool
    {
        return $user->hasPermissionTo('delete media');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete media');
    }

    /**
     * Determine whether the media can restore the model.
     */
    public function restore(User $user, Media $model): bool
    {
        return false;
    }

    /**
     * Determine whether the media can permanently delete the model.
     */
    public function forceDelete(User $user, Media $model): bool
    {
        return false;
    }
}
