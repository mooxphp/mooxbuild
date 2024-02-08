<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\JobManager;
use Illuminate\Http\Request;
use App\Models\JobQueueWorker;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\JobManagerStoreRequest;
use App\Http\Requests\JobManagerUpdateRequest;

class JobManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', JobManager::class);

        $search = $request->get('search', '');

        $jobManagers = JobManager::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.job_managers.index', compact('jobManagers', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', JobManager::class);

        $jobQueueWorkers = JobQueueWorker::pluck('worker_pid', 'id');

        return view('app.job_managers.create', compact('jobQueueWorkers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobManagerStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', JobManager::class);

        $validated = $request->validated();

        $jobManager = JobManager::create($validated);

        return redirect()
            ->route('job-managers.edit', $jobManager)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, JobManager $jobManager): View
    {
        $this->authorize('view', $jobManager);

        return view('app.job_managers.show', compact('jobManager'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, JobManager $jobManager): View
    {
        $this->authorize('update', $jobManager);

        $jobQueueWorkers = JobQueueWorker::pluck('worker_pid', 'id');

        return view(
            'app.job_managers.edit',
            compact('jobManager', 'jobQueueWorkers')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        JobManagerUpdateRequest $request,
        JobManager $jobManager
    ): RedirectResponse {
        $this->authorize('update', $jobManager);

        $validated = $request->validated();

        $jobManager->update($validated);

        return redirect()
            ->route('job-managers.edit', $jobManager)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        JobManager $jobManager
    ): RedirectResponse {
        $this->authorize('delete', $jobManager);

        $jobManager->delete();

        return redirect()
            ->route('job-managers.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
