<?php

namespace App\Http\Controllers\Api;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\MediaResource;
use App\Http\Resources\MediaCollection;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\MediaStoreRequest;
use App\Http\Requests\MediaUpdateRequest;

class MediaController extends Controller
{
    public function index(Request $request): MediaCollection
    {
        $this->authorize('view-any', Media::class);

        $search = $request->get('search', '');

        $media = Media::search($search)
            ->latest()
            ->paginate();

        return new MediaCollection($media);
    }

    public function store(MediaStoreRequest $request): MediaResource
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

        return new MediaResource($media);
    }

    public function show(Request $request, Media $media): MediaResource
    {
        $this->authorize('view', $media);

        return new MediaResource($media);
    }

    public function update(
        MediaUpdateRequest $request,
        Media $media
    ): MediaResource {
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

        return new MediaResource($media);
    }

    public function destroy(Request $request, Media $media): Response
    {
        $this->authorize('delete', $media);

        if ($media->file_name) {
            Storage::delete($media->file_name);
        }

        $media->delete();

        return response()->noContent();
    }
}
