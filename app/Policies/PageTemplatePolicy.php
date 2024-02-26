<?php

namespace App\Policies;

use App\Models\User;
use App\Models\PageTemplate;
use Illuminate\Auth\Access\HandlesAuthorization;

class PageTemplatePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the pageTemplate can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list pagetemplates');
    }

    /**
     * Determine whether the pageTemplate can view the model.
     */
    public function view(User $user, PageTemplate $model): bool
    {
        return $user->hasPermissionTo('view pagetemplates');
    }

    /**
     * Determine whether the pageTemplate can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create pagetemplates');
    }

    /**
     * Determine whether the pageTemplate can update the model.
     */
    public function update(User $user, PageTemplate $model): bool
    {
        return $user->hasPermissionTo('update pagetemplates');
    }

    /**
     * Determine whether the pageTemplate can delete the model.
     */
    public function delete(User $user, PageTemplate $model): bool
    {
        return $user->hasPermissionTo('delete pagetemplates');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete pagetemplates');
    }

    /**
     * Determine whether the pageTemplate can restore the model.
     */
    public function restore(User $user, PageTemplate $model): bool
    {
        return false;
    }

    /**
     * Determine whether the pageTemplate can permanently delete the model.
     */
    public function forceDelete(User $user, PageTemplate $model): bool
    {
        return false;
    }
}
