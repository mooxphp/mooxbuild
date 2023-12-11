<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BypassTokenResource;
use App\Http\Resources\BypassTokenCollection;

class UserBypassTokensController extends Controller
{
    public function index(Request $request, User $user): BypassTokenCollection
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $bypassTokens = $user
            ->bypassTokens()
            ->search($search)
            ->latest()
            ->paginate();

        return new BypassTokenCollection($bypassTokens);
    }

    public function store(Request $request, User $user): BypassTokenResource
    {
        $this->authorize('create', BypassToken::class);

        $validated = $request->validate([
            'token' => ['required', 'max:255', 'string'],
        ]);

        $bypassToken = $user->bypassTokens()->create($validated);

        return new BypassTokenResource($bypassToken);
    }
}
