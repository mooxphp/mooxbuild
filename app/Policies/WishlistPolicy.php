<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Auth\Access\HandlesAuthorization;

class WishlistPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the wishlist can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list wishlists');
    }

    /**
     * Determine whether the wishlist can view the model.
     */
    public function view(User $user, Wishlist $model): bool
    {
        return $user->hasPermissionTo('view wishlists');
    }

    /**
     * Determine whether the wishlist can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create wishlists');
    }

    /**
     * Determine whether the wishlist can update the model.
     */
    public function update(User $user, Wishlist $model): bool
    {
        return $user->hasPermissionTo('update wishlists');
    }

    /**
     * Determine whether the wishlist can delete the model.
     */
    public function delete(User $user, Wishlist $model): bool
    {
        return $user->hasPermissionTo('delete wishlists');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete wishlists');
    }

    /**
     * Determine whether the wishlist can restore the model.
     */
    public function restore(User $user, Wishlist $model): bool
    {
        return false;
    }

    /**
     * Determine whether the wishlist can permanently delete the model.
     */
    public function forceDelete(User $user, Wishlist $model): bool
    {
        return false;
    }
}
