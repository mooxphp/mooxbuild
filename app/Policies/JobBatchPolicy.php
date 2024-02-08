<?php

namespace App\Policies;

use App\Models\User;
use App\Models\JobBatch;
use Illuminate\Auth\Access\HandlesAuthorization;

class JobBatchPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the jobBatch can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the jobBatch can view the model.
     */
    public function view(User $user, JobBatch $model): bool
    {
        return true;
    }

    /**
     * Determine whether the jobBatch can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the jobBatch can update the model.
     */
    public function update(User $user, JobBatch $model): bool
    {
        return true;
    }

    /**
     * Determine whether the jobBatch can delete the model.
     */
    public function delete(User $user, JobBatch $model): bool
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
     * Determine whether the jobBatch can restore the model.
     */
    public function restore(User $user, JobBatch $model): bool
    {
        return false;
    }

    /**
     * Determine whether the jobBatch can permanently delete the model.
     */
    public function forceDelete(User $user, JobBatch $model): bool
    {
        return false;
    }
}
