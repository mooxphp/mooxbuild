<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\JobBatchManager;
use App\Http\Controllers\Controller;
use App\Http\Resources\JobBatchManagerResource;
use App\Http\Resources\JobBatchManagerCollection;
use App\Http\Requests\JobBatchManagerStoreRequest;
use App\Http\Requests\JobBatchManagerUpdateRequest;

class JobBatchManagerController extends Controller
{
    public function index(Request $request): JobBatchManagerCollection
    {
        $this->authorize('view-any', JobBatchManager::class);

        $search = $request->get('search', '');

        $jobBatchManagers = JobBatchManager::search($search)
            ->latest()
            ->paginate();

        return new JobBatchManagerCollection($jobBatchManagers);
    }

    public function store(
        JobBatchManagerStoreRequest $request
    ): JobBatchManagerResource {
        $this->authorize('create', JobBatchManager::class);

        $validated = $request->validated();

        $jobBatchManager = JobBatchManager::create($validated);

        return new JobBatchManagerResource($jobBatchManager);
    }

    public function show(
        Request $request,
        JobBatchManager $jobBatchManager
    ): JobBatchManagerResource {
        $this->authorize('view', $jobBatchManager);

        return new JobBatchManagerResource($jobBatchManager);
    }

    public function update(
        JobBatchManagerUpdateRequest $request,
        JobBatchManager $jobBatchManager
    ): JobBatchManagerResource {
        $this->authorize('update', $jobBatchManager);

        $validated = $request->validated();

        $jobBatchManager->update($validated);

        return new JobBatchManagerResource($jobBatchManager);
    }

    public function destroy(
        Request $request,
        JobBatchManager $jobBatchManager
    ): Response {
        $this->authorize('delete', $jobBatchManager);

        $jobBatchManager->delete();

        return response()->noContent();
    }
}
