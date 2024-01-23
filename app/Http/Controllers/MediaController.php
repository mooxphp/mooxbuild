<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\MediaStoreRequest;
use App\Http\Requests\MediaUpdateRequest;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Media::class);

        $search = $request->get('search', '');

        $media = Media::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.media.index', compact('media', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Media::class);

        return view('app.media.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MediaStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Media::class);

        $validated = $request->validated();
        if ($request->hasFile('file_name')) {
            $validated['file_name'] = $request
                ->file('file_name')
                ->store('public');
        }

        $validated['manipulations'] = json_decode(
            $validated['manipulations'],
            true
        );

        $validated['custom_properties'] = json_decode(
            $validated['custom_properties'],
            true
        );

        $validated['generated_conversions'] = json_decode(
            $validated['generated_conversions'],
            true
        );

        $validated['responsive_images'] = json_decode(
            $validated['responsive_images'],
            true
        );

        $media = Media::create($validated);

        return redirect()
            ->route('media.edit', $media)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Media $media): View
    {
        $this->authorize('view', $media);

        return view('app.media.show', compact('media'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Media $media): View
    {
        $this->authorize('update', $media);

        return view('app.media.edit', compact('media'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        MediaUpdateRequest $request,
        Media $media
    ): RedirectResponse {
        $this->authorize('update', $media);

        $validated = $request->validated();
        if ($request->hasFile('file_name')) {
            if ($media->file_name) {
                Storage::delete($media->file_name);
            }

            $validated['file_name'] = $request
                ->file('file_name')
                ->store('public');
        }

        $validated['manipulations'] = json_decode(
            $validated['manipulations'],
            true
        );

        $validated['custom_properties'] = json_decode(
            $validated['custom_properties'],
            true
        );

        $validated['generated_conversions'] = json_decode(
            $validated['generated_conversions'],
            true
        );

        $validated['responsive_images'] = json_decode(
            $validated['responsive_images'],
            true
        );

        $media->update($validated);

        return redirect()
            ->route('media.edit', $media)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Media $media): RedirectResponse
    {
        $this->authorize('delete', $media);

        if ($media->file_name) {
            Storage::delete($media->file_name);
        }

        $media->delete();

        return redirect()
            ->route('media.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
