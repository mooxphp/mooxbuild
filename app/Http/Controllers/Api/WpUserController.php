<?php

namespace App\Http\Controllers\Api;

use App\Models\WpUser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\WpUserResource;
use App\Http\Resources\WpUserCollection;
use App\Http\Requests\WpUserStoreRequest;
use App\Http\Requests\WpUserUpdateRequest;

class WpUserController extends Controller
{
    public function index(Request $request): WpUserCollection
    {
        $this->authorize('view-any', WpUser::class);

        $search = $request->get('search', '');

        $wpUsers = WpUser::search($search)
            ->latest('id')
            ->paginate();

        return new WpUserCollection($wpUsers);
    }

    public function store(WpUserStoreRequest $request): WpUserResource
    {
        $this->authorize('create', WpUser::class);

        $validated = $request->validated();

        $wpUser = WpUser::create($validated);

        return new WpUserResource($wpUser);
    }

    public function show(Request $request, WpUser $wpUser): WpUserResource
    {
        $this->authorize('view', $wpUser);

        return new WpUserResource($wpUser);
    }

    public function update(
        WpUserUpdateRequest $request,
        WpUser $wpUser
    ): WpUserResource {
        $this->authorize('update', $wpUser);

        $validated = $request->validated();

        $wpUser->update($validated);

        return new WpUserResource($wpUser);
    }

    public function destroy(Request $request, WpUser $wpUser): Response
    {
        $this->authorize('delete', $wpUser);

        $wpUser->delete();

        return response()->noContent();
    }
}
