<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ActivityLogStoreRequest;
use App\Http\Requests\ActivityLogUpdateRequest;

class ActivityLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', ActivityLog::class);

        $search = $request->get('search', '');

        $activityLogs = ActivityLog::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.activity_logs.index',
            compact('activityLogs', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', ActivityLog::class);

        return view('app.activity_logs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ActivityLogStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', ActivityLog::class);

        $validated = $request->validated();
        $validated['properties'] = json_decode($validated['properties'], true);

        $activityLog = ActivityLog::create($validated);

        return redirect()
            ->route('activity-logs.edit', $activityLog)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, ActivityLog $activityLog): View
    {
        $this->authorize('view', $activityLog);

        return view('app.activity_logs.show', compact('activityLog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, ActivityLog $activityLog): View
    {
        $this->authorize('update', $activityLog);

        return view('app.activity_logs.edit', compact('activityLog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ActivityLogUpdateRequest $request,
        ActivityLog $activityLog
    ): RedirectResponse {
        $this->authorize('update', $activityLog);

        $validated = $request->validated();
        $validated['properties'] = json_decode($validated['properties'], true);

        $activityLog->update($validated);

        return redirect()
            ->route('activity-logs.edit', $activityLog)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        ActivityLog $activityLog
    ): RedirectResponse {
        $this->authorize('delete', $activityLog);

        $activityLog->delete();

        return redirect()
            ->route('activity-logs.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
