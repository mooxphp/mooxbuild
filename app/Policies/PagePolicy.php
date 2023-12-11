<?php

namespace App\Policies;

use App\Models\Page;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the page can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the page can view the model.
     */
    public function view(User $user, Page $model): bool
    {
        return true;
    }

    /**
     * Determine whether the page can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the page can update the model.
     */
    public function update(User $user, Page $model): bool
    {
        return true;
    }

    /**
     * Determine whether the page can delete the model.
     */
    public function delete(User $user, Page $model): bool
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
     * Determine whether the page can restore the model.
     */
    public function restore(User $user, Page $model): bool
    {
        return false;
    }

    /**
     * Determine whether the page can permanently delete the model.
     */
    public function forceDelete(User $user, Page $model): bool
    {
        return false;
    }
}
