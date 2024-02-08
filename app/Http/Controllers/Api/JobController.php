<?php

namespace App\Http\Controllers\Api;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\JobResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\JobCollection;
use App\Http\Requests\JobStoreRequest;
use App\Http\Requests\JobUpdateRequest;

class JobController extends Controller
{
    public function index(Request $request): JobCollection
    {
        $this->authorize('view-any', Job::class);

        $search = $request->get('search', '');

        $jobs = Job::search($search)
            ->latest('id')
            ->paginate();

        return new JobCollection($jobs);
    }

    public function store(JobStoreRequest $request): JobResource
    {
        $this->authorize('create', Job::class);

        $validated = $request->validated();

        $job = Job::create($validated);

        return new JobResource($job);
    }

    public function show(Request $request, Job $job): JobResource
    {
        $this->authorize('view', $job);

        return new JobResource($job);
    }

    public function update(JobUpdateRequest $request, Job $job): JobResource
    {
        $this->authorize('update', $job);

        $validated = $request->validated();

        $job->update($validated);

        return new JobResource($job);
    }

    public function destroy(Request $request, Job $job): Response
    {
        $this->authorize('delete', $job);

        $job->delete();

        return response()->noContent();
    }
}
