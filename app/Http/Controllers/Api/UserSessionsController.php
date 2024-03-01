<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SessionResource;
use App\Http\Resources\SessionCollection;

class UserSessionsController extends Controller
{
    public function index(Request $request, User $user): SessionCollection
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $sessions = $user
            ->sessions()
            ->search($search)
            ->latest()
            ->paginate();

        return new SessionCollection($sessions);
    }

    public function store(Request $request, User $user): SessionResource
    {
        $this->authorize('create', Session::class);

        $validated = $request->validate([
            'ip_address' => ['nullable', 'max:255'],
            'user_agent' => ['nullable', 'max:255', 'string'],
            'payload' => ['required', 'max:255', 'string'],
            'last_activity' => ['required', 'numeric'],
        ]);

        $session = $user->sessions()->create($validated);

        return new SessionResource($session);
    }
}
