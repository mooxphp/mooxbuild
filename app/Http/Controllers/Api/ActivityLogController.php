<?php

namespace App\Http\Controllers\Api;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\ActivityLogResource;
use App\Http\Resources\ActivityLogCollection;
use App\Http\Requests\ActivityLogStoreRequest;
use App\Http\Requests\ActivityLogUpdateRequest;

class ActivityLogController extends Controller
{
    public function index(Request $request): ActivityLogCollection
    {
        $this->authorize('view-any', ActivityLog::class);

        $search = $request->get('search', '');

        $activityLogs = ActivityLog::search($search)
            ->latest()
            ->paginate();

        return new ActivityLogCollection($activityLogs);
    }

    public function store(ActivityLogStoreRequest $request): ActivityLogResource
    {
        $this->authorize('create', ActivityLog::class);

        $validated = $request->validated();
        $validated['properties'] = json_decode($validated['properties'], true);

        $activityLog = ActivityLog::create($validated);

        return new ActivityLogResource($activityLog);
    }

    public function show(
        Request $request,
        ActivityLog $activityLog
    ): ActivityLogResource {
        $this->authorize('view', $activityLog);

        return new ActivityLogResource($activityLog);
    }

    public function update(
        ActivityLogUpdateRequest $request,
        ActivityLog $activityLog
    ): ActivityLogResource {
        $this->authorize('update', $activityLog);

        $validated = $request->validated();

        $validated['properties'] = json_decode($validated['properties'], true);

        $activityLog->update($validated);

        return new ActivityLogResource($activityLog);
    }

    public function destroy(
        Request $request,
        ActivityLog $activityLog
    ): Response {
        $this->authorize('delete', $activityLog);

        $activityLog->delete();

        return response()->noContent();
    }
}
