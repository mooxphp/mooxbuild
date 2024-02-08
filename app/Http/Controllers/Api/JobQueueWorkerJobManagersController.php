<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\JobQueueWorker;
use App\Http\Controllers\Controller;
use App\Http\Resources\JobManagerResource;
use App\Http\Resources\JobManagerCollection;

class JobQueueWorkerJobManagersController extends Controller
{
    public function index(
        Request $request,
        JobQueueWorker $jobQueueWorker
    ): JobManagerCollection {
        $this->authorize('view', $jobQueueWorker);

        $search = $request->get('search', '');

        $jobManagers = $jobQueueWorker
            ->jobManagers()
            ->search($search)
            ->latest()
            ->paginate();

        return new JobManagerCollection($jobManagers);
    }

    public function store(
        Request $request,
        JobQueueWorker $jobQueueWorker
    ): JobManagerResource {
        $this->authorize('create', JobManager::class);

        $validated = $request->validate([
            'job_id' => ['required', 'max:255', 'string'],
            'name' => ['nullable', 'max:255', 'string'],
            'queue' => ['nullable', 'max:255', 'string'],
            'available_at' => ['required', 'date'],
            'started_at' => ['nullable', 'date'],
            'finished_at' => ['nullable', 'date'],
            'failed' => ['required', 'boolean'],
            'attempt' => ['required', 'numeric'],
            'progress' => ['nullable', 'numeric'],
            'exception_message' => ['nullable', 'max:255', 'string'],
            'status' => ['required', 'max:255', 'string'],
        ]);

        $jobManager = $jobQueueWorker->jobManagers()->create($validated);

        return new JobManagerResource($jobManager);
    }
}
