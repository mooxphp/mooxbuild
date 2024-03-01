<?php

namespace App\Http\Controllers\Api;

use App\Models\WpOption;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\WpOptionResource;
use App\Http\Resources\WpOptionCollection;
use App\Http\Requests\WpOptionStoreRequest;
use App\Http\Requests\WpOptionUpdateRequest;

class WpOptionController extends Controller
{
    public function index(Request $request): WpOptionCollection
    {
        $this->authorize('view-any', WpOption::class);

        $search = $request->get('search', '');

        $wpOptions = WpOption::search($search)
            ->latest()
            ->paginate();

        return new WpOptionCollection($wpOptions);
    }

    public function store(WpOptionStoreRequest $request): WpOptionResource
    {
        $this->authorize('create', WpOption::class);

        $validated = $request->validated();

        $wpOption = WpOption::create($validated);

        return new WpOptionResource($wpOption);
    }

    public function show(Request $request, WpOption $wpOption): WpOptionResource
    {
        $this->authorize('view', $wpOption);

        return new WpOptionResource($wpOption);
    }

    public function update(
        WpOptionUpdateRequest $request,
        WpOption $wpOption
    ): WpOptionResource {
        $this->authorize('update', $wpOption);

        $validated = $request->validated();

        $wpOption->update($validated);

        return new WpOptionResource($wpOption);
    }

    public function destroy(Request $request, WpOption $wpOption): Response
    {
        $this->authorize('delete', $wpOption);

        $wpOption->delete();

        return response()->noContent();
    }
}
