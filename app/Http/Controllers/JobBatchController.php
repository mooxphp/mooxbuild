<?php

namespace App\Http\Controllers;

use App\Models\JobBatch;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\JobBatchStoreRequest;
use App\Http\Requests\JobBatchUpdateRequest;

class JobBatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', JobBatch::class);

        $search = $request->get('search', '');

        $jobBatches = JobBatch::search($search)
            ->latest('id')
            ->paginate(5)
            ->withQueryString();

        return view('app.job_batches.index', compact('jobBatches', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', JobBatch::class);

        return view('app.job_batches.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobBatchStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', JobBatch::class);

        $validated = $request->validated();

        $jobBatch = JobBatch::create($validated);

        return redirect()
            ->route('job-batches.edit', $jobBatch)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, JobBatch $jobBatch): View
    {
        $this->authorize('view', $jobBatch);

        return view('app.job_batches.show', compact('jobBatch'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, JobBatch $jobBatch): View
    {
        $this->authorize('update', $jobBatch);

        return view('app.job_batches.edit', compact('jobBatch'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        JobBatchUpdateRequest $request,
        JobBatch $jobBatch
    ): RedirectResponse {
        $this->authorize('update', $jobBatch);

        $validated = $request->validated();

        $jobBatch->update($validated);

        return redirect()
            ->route('job-batches.edit', $jobBatch)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        JobBatch $jobBatch
    ): RedirectResponse {
        $this->authorize('delete', $jobBatch);

        $jobBatch->delete();

        return redirect()
            ->route('job-batches.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
