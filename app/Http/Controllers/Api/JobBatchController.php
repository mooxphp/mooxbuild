<?php

namespace App\Http\Controllers\Api;

use App\Models\JobBatch;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\JobBatchResource;
use App\Http\Resources\JobBatchCollection;
use App\Http\Requests\JobBatchStoreRequest;
use App\Http\Requests\JobBatchUpdateRequest;

class JobBatchController extends Controller
{
    public function index(Request $request): JobBatchCollection
    {
        $this->authorize('view-any', JobBatch::class);

        $search = $request->get('search', '');

        $jobBatches = JobBatch::search($search)
            ->latest('id')
            ->paginate();

        return new JobBatchCollection($jobBatches);
    }

    public function store(JobBatchStoreRequest $request): JobBatchResource
    {
        $this->authorize('create', JobBatch::class);

        $validated = $request->validated();

        $jobBatch = JobBatch::create($validated);

        return new JobBatchResource($jobBatch);
    }

    public function show(Request $request, JobBatch $jobBatch): JobBatchResource
    {
        $this->authorize('view', $jobBatch);

        return new JobBatchResource($jobBatch);
    }

    public function update(
        JobBatchUpdateRequest $request,
        JobBatch $jobBatch
    ): JobBatchResource {
        $this->authorize('update', $jobBatch);

        $validated = $request->validated();

        $jobBatch->update($validated);

        return new JobBatchResource($jobBatch);
    }

    public function destroy(Request $request, JobBatch $jobBatch): Response
    {
        $this->authorize('delete', $jobBatch);

        $jobBatch->delete();

        return response()->noContent();
    }
}
