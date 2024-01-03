<?php

namespace App\Http\Controllers;

use App\Models\Revision;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\RevisionStoreRequest;
use App\Http\Requests\RevisionUpdateRequest;

class RevisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Revision::class);

        $search = $request->get('search', '');

        $revisions = Revision::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.revisions.index', compact('revisions', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Revision::class);

        return view('app.revisions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RevisionStoreRequest $request): RedirectResponse
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

        $validated['fields'] = json_decode($validated['fields'], true);

        $revision = Revision::create($validated);

        return redirect()
            ->route('revisions.edit', $revision)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Revision $revision): View
    {
        $this->authorize('view', $revision);

        return view('app.revisions.show', compact('revision'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Revision $revision): View
    {
        $this->authorize('update', $revision);

        return view('app.revisions.edit', compact('revision'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        RevisionUpdateRequest $request,
        Revision $revision
    ): RedirectResponse {
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

        $validated['fields'] = json_decode($validated['fields'], true);

        $revision->update($validated);

        return redirect()
            ->route('revisions.edit', $revision)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Revision $revision
    ): RedirectResponse {
        $this->authorize('delete', $revision);

        if ($revision->image) {
            Storage::delete($revision->image);
        }

        if ($revision->thumbnail) {
            Storage::delete($revision->thumbnail);
        }

        $revision->delete();

        return redirect()
            ->route('revisions.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
