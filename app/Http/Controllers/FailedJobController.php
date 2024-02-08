<?php

namespace App\Http\Controllers;

use App\Models\FailedJob;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\FailedJobStoreRequest;
use App\Http\Requests\FailedJobUpdateRequest;

class FailedJobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', FailedJob::class);

        $search = $request->get('search', '');

        $failedJobs = FailedJob::search($search)
            ->latest('id')
            ->paginate(5)
            ->withQueryString();

        return view('app.failed_jobs.index', compact('failedJobs', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', FailedJob::class);

        return view('app.failed_jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FailedJobStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', FailedJob::class);

        $validated = $request->validated();

        $failedJob = FailedJob::create($validated);

        return redirect()
            ->route('failed-jobs.edit', $failedJob)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, FailedJob $failedJob): View
    {
        $this->authorize('view', $failedJob);

        return view('app.failed_jobs.show', compact('failedJob'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, FailedJob $failedJob): View
    {
        $this->authorize('update', $failedJob);

        return view('app.failed_jobs.edit', compact('failedJob'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        FailedJobUpdateRequest $request,
        FailedJob $failedJob
    ): RedirectResponse {
        $this->authorize('update', $failedJob);

        $validated = $request->validated();

        $failedJob->update($validated);

        return redirect()
            ->route('failed-jobs.edit', $failedJob)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        FailedJob $failedJob
    ): RedirectResponse {
        $this->authorize('delete', $failedJob);

        $failedJob->delete();

        return redirect()
            ->route('failed-jobs.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
