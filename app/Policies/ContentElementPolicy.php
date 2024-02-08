<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ContentElement;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContentElementPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the contentElement can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the contentElement can view the model.
     */
    public function view(User $user, ContentElement $model): bool
    {
        return true;
    }

    /**
     * Determine whether the contentElement can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the contentElement can update the model.
     */
    public function update(User $user, ContentElement $model): bool
    {
        return true;
    }

    /**
     * Determine whether the contentElement can delete the model.
     */
    public function delete(User $user, ContentElement $model): bool
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
     * Determine whether the contentElement can restore the model.
     */
    public function restore(User $user, ContentElement $model): bool
    {
        return false;
    }

    /**
     * Determine whether the contentElement can permanently delete the model.
     */
    public function forceDelete(User $user, ContentElement $model): bool
    {
        return false;
    }
}
