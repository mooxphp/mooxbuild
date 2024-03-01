<?php

namespace App\Http\Controllers\Api;

use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\SessionResource;
use App\Http\Resources\SessionCollection;
use App\Http\Requests\SessionStoreRequest;
use App\Http\Requests\SessionUpdateRequest;

class SessionController extends Controller
{
    public function index(Request $request): SessionCollection
    {
        $this->authorize('view-any', Session::class);

        $search = $request->get('search', '');

        $sessions = Session::search($search)
            ->latest()
            ->paginate();

        return new SessionCollection($sessions);
    }

    public function store(SessionStoreRequest $request): SessionResource
    {
        $this->authorize('create', Session::class);

        $validated = $request->validated();

        $session = Session::create($validated);

        return new SessionResource($session);
    }

    public function show(Request $request, Session $session): SessionResource
    {
        $this->authorize('view', $session);

        return new SessionResource($session);
    }

    public function update(
        SessionUpdateRequest $request,
        Session $session
    ): SessionResource {
        $this->authorize('update', $session);

        $validated = $request->validated();

        $session->update($validated);

        return new SessionResource($session);
    }

    public function destroy(Request $request, Session $session): Response
    {
        $this->authorize('delete', $session);

        $session->delete();

        return response()->noContent();
    }
}
