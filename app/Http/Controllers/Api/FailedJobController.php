<?php

namespace App\Http\Controllers\Api;

use App\Models\FailedJob;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\FailedJobResource;
use App\Http\Resources\FailedJobCollection;
use App\Http\Requests\FailedJobStoreRequest;
use App\Http\Requests\FailedJobUpdateRequest;

class FailedJobController extends Controller
{
    public function index(Request $request): FailedJobCollection
    {
        $this->authorize('view-any', FailedJob::class);

        $search = $request->get('search', '');

        $failedJobs = FailedJob::search($search)
            ->latest('id')
            ->paginate();

        return new FailedJobCollection($failedJobs);
    }

    public function store(FailedJobStoreRequest $request): FailedJobResource
    {
        $this->authorize('create', FailedJob::class);

        $validated = $request->validated();

        $failedJob = FailedJob::create($validated);

        return new FailedJobResource($failedJob);
    }

    public function show(
        Request $request,
        FailedJob $failedJob
    ): FailedJobResource {
        $this->authorize('view', $failedJob);

        return new FailedJobResource($failedJob);
    }

    public function update(
        FailedJobUpdateRequest $request,
        FailedJob $failedJob
    ): FailedJobResource {
        $this->authorize('update', $failedJob);

        $validated = $request->validated();

        $failedJob->update($validated);

        return new FailedJobResource($failedJob);
    }

    public function destroy(Request $request, FailedJob $failedJob): Response
    {
        $this->authorize('delete', $failedJob);

        $failedJob->delete();

        return response()->noContent();
    }
}
