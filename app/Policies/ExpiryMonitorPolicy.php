<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ExpiryMonitor;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExpiryMonitorPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the expiryMonitor can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list expirymonitors');
    }

    /**
     * Determine whether the expiryMonitor can view the model.
     */
    public function view(User $user, ExpiryMonitor $model): bool
    {
        return $user->hasPermissionTo('view expirymonitors');
    }

    /**
     * Determine whether the expiryMonitor can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create expirymonitors');
    }

    /**
     * Determine whether the expiryMonitor can update the model.
     */
    public function update(User $user, ExpiryMonitor $model): bool
    {
        return $user->hasPermissionTo('update expirymonitors');
    }

    /**
     * Determine whether the expiryMonitor can delete the model.
     */
    public function delete(User $user, ExpiryMonitor $model): bool
    {
        return $user->hasPermissionTo('delete expirymonitors');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete expirymonitors');
    }

    /**
     * Determine whether the expiryMonitor can restore the model.
     */
    public function restore(User $user, ExpiryMonitor $model): bool
    {
        return false;
    }

    /**
     * Determine whether the expiryMonitor can permanently delete the model.
     */
    public function forceDelete(User $user, ExpiryMonitor $model): bool
    {
        return false;
    }
}
