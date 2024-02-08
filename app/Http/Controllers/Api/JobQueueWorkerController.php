<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\JobQueueWorker;
use App\Http\Controllers\Controller;
use App\Http\Resources\JobQueueWorkerResource;
use App\Http\Resources\JobQueueWorkerCollection;
use App\Http\Requests\JobQueueWorkerStoreRequest;
use App\Http\Requests\JobQueueWorkerUpdateRequest;

class JobQueueWorkerController extends Controller
{
    public function index(Request $request): JobQueueWorkerCollection
    {
        $this->authorize('view-any', JobQueueWorker::class);

        $search = $request->get('search', '');

        $jobQueueWorkers = JobQueueWorker::search($search)
            ->latest()
            ->paginate();

        return new JobQueueWorkerCollection($jobQueueWorkers);
    }

    public function store(
        JobQueueWorkerStoreRequest $request
    ): JobQueueWorkerResource {
        $this->authorize('create', JobQueueWorker::class);

        $validated = $request->validated();

        $jobQueueWorker = JobQueueWorker::create($validated);

        return new JobQueueWorkerResource($jobQueueWorker);
    }

    public function show(
        Request $request,
        JobQueueWorker $jobQueueWorker
    ): JobQueueWorkerResource {
        $this->authorize('view', $jobQueueWorker);

        return new JobQueueWorkerResource($jobQueueWorker);
    }

    public function update(
        JobQueueWorkerUpdateRequest $request,
        JobQueueWorker $jobQueueWorker
    ): JobQueueWorkerResource {
        $this->authorize('update', $jobQueueWorker);

        $validated = $request->validated();

        $jobQueueWorker->update($validated);

        return new JobQueueWorkerResource($jobQueueWorker);
    }

    public function destroy(
        Request $request,
        JobQueueWorker $jobQueueWorker
    ): Response {
        $this->authorize('delete', $jobQueueWorker);

        $jobQueueWorker->delete();

        return response()->noContent();
    }
}
