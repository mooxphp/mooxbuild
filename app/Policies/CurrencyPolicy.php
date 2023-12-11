<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Currency;
use Illuminate\Auth\Access\HandlesAuthorization;

class CurrencyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the currency can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the currency can view the model.
     */
    public function view(User $user, Currency $model): bool
    {
        return true;
    }

    /**
     * Determine whether the currency can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the currency can update the model.
     */
    public function update(User $user, Currency $model): bool
    {
        return true;
    }

    /**
     * Determine whether the currency can delete the model.
     */
    public function delete(User $user, Currency $model): bool
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
     * Determine whether the currency can restore the model.
     */
    public function restore(User $user, Currency $model): bool
    {
        return false;
    }

    /**
     * Determine whether the currency can permanently delete the model.
     */
    public function forceDelete(User $user, Currency $model): bool
    {
        return false;
    }
}
