<?php

namespace App\Policies;

use App\Models\User;
use App\Models\JobQueueWorker;
use Illuminate\Auth\Access\HandlesAuthorization;

class JobQueueWorkerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the jobQueueWorker can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list jobqueueworkers');
    }

    /**
     * Determine whether the jobQueueWorker can view the model.
     */
    public function view(User $user, JobQueueWorker $model): bool
    {
        return $user->hasPermissionTo('view jobqueueworkers');
    }

    /**
     * Determine whether the jobQueueWorker can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create jobqueueworkers');
    }

    /**
     * Determine whether the jobQueueWorker can update the model.
     */
    public function update(User $user, JobQueueWorker $model): bool
    {
        return $user->hasPermissionTo('update jobqueueworkers');
    }

    /**
     * Determine whether the jobQueueWorker can delete the model.
     */
    public function delete(User $user, JobQueueWorker $model): bool
    {
        return $user->hasPermissionTo('delete jobqueueworkers');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete jobqueueworkers');
    }

    /**
     * Determine whether the jobQueueWorker can restore the model.
     */
    public function restore(User $user, JobQueueWorker $model): bool
    {
        return false;
    }

    /**
     * Determine whether the jobQueueWorker can permanently delete the model.
     */
    public function forceDelete(User $user, JobQueueWorker $model): bool
    {
        return false;
    }
}
