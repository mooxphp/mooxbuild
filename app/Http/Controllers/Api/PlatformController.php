<?php

namespace App\Http\Controllers\Api;

use App\Models\Platform;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\PlatformResource;
use App\Http\Resources\PlatformCollection;
use App\Http\Requests\PlatformStoreRequest;
use App\Http\Requests\PlatformUpdateRequest;

class PlatformController extends Controller
{
    public function index(Request $request): PlatformCollection
    {
        $this->authorize('view-any', Platform::class);

        $search = $request->get('search', '');

        $platforms = Platform::search($search)
            ->latest()
            ->paginate();

        return new PlatformCollection($platforms);
    }

    public function store(PlatformStoreRequest $request): PlatformResource
    {
        $this->authorize('create', Platform::class);

        $validated = $request->validated();
        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request
                ->file('thumbnail')
                ->store('public');
        }

        $platform = Platform::create($validated);

        return new PlatformResource($platform);
    }

    public function show(Request $request, Platform $platform): PlatformResource
    {
        $this->authorize('view', $platform);

        return new PlatformResource($platform);
    }

    public function update(
        PlatformUpdateRequest $request,
        Platform $platform
    ): PlatformResource {
        $this->authorize('update', $platform);

        $validated = $request->validated();

        if ($request->hasFile('thumbnail')) {
            if ($platform->thumbnail) {
                Storage::delete($platform->thumbnail);
            }

            $validated['thumbnail'] = $request
                ->file('thumbnail')
                ->store('public');
        }

        $platform->update($validated);

        return new PlatformResource($platform);
    }

    public function destroy(Request $request, Platform $platform): Response
    {
        $this->authorize('delete', $platform);

        if ($platform->thumbnail) {
            Storage::delete($platform->thumbnail);
        }

        $platform->delete();

        return response()->noContent();
    }
}
