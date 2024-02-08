<?php

namespace App\Http\Controllers\Api;

use App\Models\JobManager;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\JobManagerResource;
use App\Http\Resources\JobManagerCollection;
use App\Http\Requests\JobManagerStoreRequest;
use App\Http\Requests\JobManagerUpdateRequest;

class JobManagerController extends Controller
{
    public function index(Request $request): JobManagerCollection
    {
        $this->authorize('view-any', JobManager::class);

        $search = $request->get('search', '');

        $jobManagers = JobManager::search($search)
            ->latest()
            ->paginate();

        return new JobManagerCollection($jobManagers);
    }

    public function store(JobManagerStoreRequest $request): JobManagerResource
    {
        $this->authorize('create', JobManager::class);

        $validated = $request->validated();

        $jobManager = JobManager::create($validated);

        return new JobManagerResource($jobManager);
    }

    public function show(
        Request $request,
        JobManager $jobManager
    ): JobManagerResource {
        $this->authorize('view', $jobManager);

        return new JobManagerResource($jobManager);
    }

    public function update(
        JobManagerUpdateRequest $request,
        JobManager $jobManager
    ): JobManagerResource {
        $this->authorize('update', $jobManager);

        $validated = $request->validated();

        $jobManager->update($validated);

        return new JobManagerResource($jobManager);
    }

    public function destroy(Request $request, JobManager $jobManager): Response
    {
        $this->authorize('delete', $jobManager);

        $jobManager->delete();

        return response()->noContent();
    }
}
