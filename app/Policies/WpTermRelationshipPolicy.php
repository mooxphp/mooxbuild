<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WpTermRelationship;
use Illuminate\Auth\Access\HandlesAuthorization;

class WpTermRelationshipPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the wpTermRelationship can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list wptermrelationships');
    }

    /**
     * Determine whether the wpTermRelationship can view the model.
     */
    public function view(User $user, WpTermRelationship $model): bool
    {
        return $user->hasPermissionTo('view wptermrelationships');
    }

    /**
     * Determine whether the wpTermRelationship can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create wptermrelationships');
    }

    /**
     * Determine whether the wpTermRelationship can update the model.
     */
    public function update(User $user, WpTermRelationship $model): bool
    {
        return $user->hasPermissionTo('update wptermrelationships');
    }

    /**
     * Determine whether the wpTermRelationship can delete the model.
     */
    public function delete(User $user, WpTermRelationship $model): bool
    {
        return $user->hasPermissionTo('delete wptermrelationships');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete wptermrelationships');
    }

    /**
     * Determine whether the wpTermRelationship can restore the model.
     */
    public function restore(User $user, WpTermRelationship $model): bool
    {
        return false;
    }

    /**
     * Determine whether the wpTermRelationship can permanently delete the model.
     */
    public function forceDelete(User $user, WpTermRelationship $model): bool
    {
        return false;
    }
}
