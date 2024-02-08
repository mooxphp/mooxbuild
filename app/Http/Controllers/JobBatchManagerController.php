<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\JobBatchManager;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\JobBatchManagerStoreRequest;
use App\Http\Requests\JobBatchManagerUpdateRequest;

class JobBatchManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', JobBatchManager::class);

        $search = $request->get('search', '');

        $jobBatchManagers = JobBatchManager::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.job_batch_managers.index',
            compact('jobBatchManagers', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', JobBatchManager::class);

        return view('app.job_batch_managers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        JobBatchManagerStoreRequest $request
    ): RedirectResponse {
        $this->authorize('create', JobBatchManager::class);

        $validated = $request->validated();

        $jobBatchManager = JobBatchManager::create($validated);

        return redirect()
            ->route('job-batch-managers.edit', $jobBatchManager)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(
        Request $request,
        JobBatchManager $jobBatchManager
    ): View {
        $this->authorize('view', $jobBatchManager);

        return view('app.job_batch_managers.show', compact('jobBatchManager'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Request $request,
        JobBatchManager $jobBatchManager
    ): View {
        $this->authorize('update', $jobBatchManager);

        return view('app.job_batch_managers.edit', compact('jobBatchManager'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        JobBatchManagerUpdateRequest $request,
        JobBatchManager $jobBatchManager
    ): RedirectResponse {
        $this->authorize('update', $jobBatchManager);

        $validated = $request->validated();

        $jobBatchManager->update($validated);

        return redirect()
            ->route('job-batch-managers.edit', $jobBatchManager)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        JobBatchManager $jobBatchManager
    ): RedirectResponse {
        $this->authorize('delete', $jobBatchManager);

        $jobBatchManager->delete();

        return redirect()
            ->route('job-batch-managers.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
