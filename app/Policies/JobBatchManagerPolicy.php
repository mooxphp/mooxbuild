<?php

namespace App\Policies;

use App\Models\User;
use App\Models\JobBatchManager;
use Illuminate\Auth\Access\HandlesAuthorization;

class JobBatchManagerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the jobBatchManager can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the jobBatchManager can view the model.
     */
    public function view(User $user, JobBatchManager $model): bool
    {
        return true;
    }

    /**
     * Determine whether the jobBatchManager can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the jobBatchManager can update the model.
     */
    public function update(User $user, JobBatchManager $model): bool
    {
        return true;
    }

    /**
     * Determine whether the jobBatchManager can delete the model.
     */
    public function delete(User $user, JobBatchManager $model): bool
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
     * Determine whether the jobBatchManager can restore the model.
     */
    public function restore(User $user, JobBatchManager $model): bool
    {
        return false;
    }

    /**
     * Determine whether the jobBatchManager can permanently delete the model.
     */
    public function forceDelete(User $user, JobBatchManager $model): bool
    {
        return false;
    }
}
