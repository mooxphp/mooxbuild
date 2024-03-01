<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WpTermTaxonomy;
use Illuminate\Auth\Access\HandlesAuthorization;

class WpTermTaxonomyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the wpTermTaxonomy can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list wptermtaxonomies');
    }

    /**
     * Determine whether the wpTermTaxonomy can view the model.
     */
    public function view(User $user, WpTermTaxonomy $model): bool
    {
        return $user->hasPermissionTo('view wptermtaxonomies');
    }

    /**
     * Determine whether the wpTermTaxonomy can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create wptermtaxonomies');
    }

    /**
     * Determine whether the wpTermTaxonomy can update the model.
     */
    public function update(User $user, WpTermTaxonomy $model): bool
    {
        return $user->hasPermissionTo('update wptermtaxonomies');
    }

    /**
     * Determine whether the wpTermTaxonomy can delete the model.
     */
    public function delete(User $user, WpTermTaxonomy $model): bool
    {
        return $user->hasPermissionTo('delete wptermtaxonomies');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete wptermtaxonomies');
    }

    /**
     * Determine whether the wpTermTaxonomy can restore the model.
     */
    public function restore(User $user, WpTermTaxonomy $model): bool
    {
        return false;
    }

    /**
     * Determine whether the wpTermTaxonomy can permanently delete the model.
     */
    public function forceDelete(User $user, WpTermTaxonomy $model): bool
    {
        return false;
    }
}
