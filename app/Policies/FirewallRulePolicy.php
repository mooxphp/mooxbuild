<?php

namespace App\Policies;

use App\Models\User;
use App\Models\FirewallRule;
use Illuminate\Auth\Access\HandlesAuthorization;

class FirewallRulePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the firewallRule can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the firewallRule can view the model.
     */
    public function view(User $user, FirewallRule $model): bool
    {
        return true;
    }

    /**
     * Determine whether the firewallRule can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the firewallRule can update the model.
     */
    public function update(User $user, FirewallRule $model): bool
    {
        return true;
    }

    /**
     * Determine whether the firewallRule can delete the model.
     */
    public function delete(User $user, FirewallRule $model): bool
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
     * Determine whether the firewallRule can restore the model.
     */
    public function restore(User $user, FirewallRule $model): bool
    {
        return false;
    }

    /**
     * Determine whether the firewallRule can permanently delete the model.
     */
    public function forceDelete(User $user, FirewallRule $model): bool
    {
        return false;
    }
}
