<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\JobStoreRequest;
use App\Http\Requests\JobUpdateRequest;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Job::class);

        $search = $request->get('search', '');

        $jobs = Job::search($search)
            ->latest('id')
            ->paginate(5)
            ->withQueryString();

        return view('app.jobs.index', compact('jobs', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Job::class);

        return view('app.jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Job::class);

        $validated = $request->validated();

        $job = Job::create($validated);

        return redirect()
            ->route('jobs.edit', $job)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Job $job): View
    {
        $this->authorize('view', $job);

        return view('app.jobs.show', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Job $job): View
    {
        $this->authorize('update', $job);

        return view('app.jobs.edit', compact('job'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        JobUpdateRequest $request,
        Job $job
    ): RedirectResponse {
        $this->authorize('update', $job);

        $validated = $request->validated();

        $job->update($validated);

        return redirect()
            ->route('jobs.edit', $job)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Job $job): RedirectResponse
    {
        $this->authorize('delete', $job);

        $job->delete();

        return redirect()
            ->route('jobs.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
