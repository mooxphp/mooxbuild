<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\JobQueueWorker;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\JobQueueWorkerStoreRequest;
use App\Http\Requests\JobQueueWorkerUpdateRequest;

class JobQueueWorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', JobQueueWorker::class);

        $search = $request->get('search', '');

        $jobQueueWorkers = JobQueueWorker::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.job_queue_workers.index',
            compact('jobQueueWorkers', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', JobQueueWorker::class);

        return view('app.job_queue_workers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobQueueWorkerStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', JobQueueWorker::class);

        $validated = $request->validated();

        $jobQueueWorker = JobQueueWorker::create($validated);

        return redirect()
            ->route('job-queue-workers.edit', $jobQueueWorker)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, JobQueueWorker $jobQueueWorker): View
    {
        $this->authorize('view', $jobQueueWorker);

        return view('app.job_queue_workers.show', compact('jobQueueWorker'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, JobQueueWorker $jobQueueWorker): View
    {
        $this->authorize('update', $jobQueueWorker);

        return view('app.job_queue_workers.edit', compact('jobQueueWorker'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        JobQueueWorkerUpdateRequest $request,
        JobQueueWorker $jobQueueWorker
    ): RedirectResponse {
        $this->authorize('update', $jobQueueWorker);

        $validated = $request->validated();

        $jobQueueWorker->update($validated);

        return redirect()
            ->route('job-queue-workers.edit', $jobQueueWorker)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        JobQueueWorker $jobQueueWorker
    ): RedirectResponse {
        $this->authorize('delete', $jobQueueWorker);

        $jobQueueWorker->delete();

        return redirect()
            ->route('job-queue-workers.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
