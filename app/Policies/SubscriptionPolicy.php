<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Subscription;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubscriptionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the subscription can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the subscription can view the model.
     */
    public function view(User $user, Subscription $model): bool
    {
        return true;
    }

    /**
     * Determine whether the subscription can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the subscription can update the model.
     */
    public function update(User $user, Subscription $model): bool
    {
        return true;
    }

    /**
     * Determine whether the subscription can delete the model.
     */
    public function delete(User $user, Subscription $model): bool
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
     * Determine whether the subscription can restore the model.
     */
    public function restore(User $user, Subscription $model): bool
    {
        return false;
    }

    /**
     * Determine whether the subscription can permanently delete the model.
     */
    public function forceDelete(User $user, Subscription $model): bool
    {
        return false;
    }
}
