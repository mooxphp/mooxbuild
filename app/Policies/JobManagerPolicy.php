<?php

namespace App\Policies;

use App\Models\User;
use App\Models\JobManager;
use Illuminate\Auth\Access\HandlesAuthorization;

class JobManagerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the jobManager can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the jobManager can view the model.
     */
    public function view(User $user, JobManager $model): bool
    {
        return true;
    }

    /**
     * Determine whether the jobManager can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the jobManager can update the model.
     */
    public function update(User $user, JobManager $model): bool
    {
        return true;
    }

    /**
     * Determine whether the jobManager can delete the model.
     */
    public function delete(User $user, JobManager $model): bool
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
     * Determine whether the jobManager can restore the model.
     */
    public function restore(User $user, JobManager $model): bool
    {
        return false;
    }

    /**
     * Determine whether the jobManager can permanently delete the model.
     */
    public function forceDelete(User $user, JobManager $model): bool
    {
        return false;
    }
}
