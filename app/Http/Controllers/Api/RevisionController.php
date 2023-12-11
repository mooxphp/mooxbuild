<?php

namespace App\Http\Controllers\Api;

use App\Models\Revision;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\RevisionResource;
use App\Http\Resources\RevisionCollection;
use App\Http\Requests\RevisionStoreRequest;
use App\Http\Requests\RevisionUpdateRequest;

class RevisionController extends Controller
{
    public function index(Request $request): RevisionCollection
    {
        $this->authorize('view-any', Revision::class);

        $search = $request->get('search', '');

        $revisions = Revision::search($search)
            ->latest()
            ->paginate();

        return new RevisionCollection($revisions);
    }

    public function store(RevisionStoreRequest $request): RevisionResource
    {
        $this->authorize('create', Revision::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request
                ->file('thumbnail')
                ->store('public');
        }

        $validated['data'] = json_decode($validated['data'], true);

        $validated['categories'] = json_decode($validated['categories'], true);

        $validated['tags'] = json_decode($validated['tags'], true);

        $revision = Revision::create($validated);

        return new RevisionResource($revision);
    }

    public function show(Request $request, Revision $revision): RevisionResource
    {
        $this->authorize('view', $revision);

        return new RevisionResource($revision);
    }

    public function update(
        RevisionUpdateRequest $request,
        Revision $revision
    ): RevisionResource {
        $this->authorize('update', $revision);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($revision->image) {
                Storage::delete($revision->image);
            }

            $validated['image'] = $request->file('image')->store('public');
        }

        if ($request->hasFile('thumbnail')) {
            if ($revision->thumbnail) {
                Storage::delete($revision->thumbnail);
            }

            $validated['thumbnail'] = $request
                ->file('thumbnail')
                ->store('public');
        }

        $validated['data'] = json_decode($validated['data'], true);

        $validated['categories'] = json_decode($validated['categories'], true);

        $validated['tags'] = json_decode($validated['tags'], true);

        $revision->update($validated);

        return new RevisionResource($revision);
    }

    public function destroy(Request $request, Revision $revision): Response
    {
        $this->authorize('delete', $revision);

        if ($revision->image) {
            Storage::delete($revision->image);
        }

        if ($revision->thumbnail) {
            Storage::delete($revision->thumbnail);
        }

        $revision->delete();

        return response()->noContent();
    }
}
