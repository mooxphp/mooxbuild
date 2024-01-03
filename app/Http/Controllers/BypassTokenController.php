<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use App\Models\BypassToken;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\BypassTokenStoreRequest;
use App\Http\Requests\BypassTokenUpdateRequest;

class BypassTokenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', BypassToken::class);

        $search = $request->get('search', '');

        $bypassTokens = BypassToken::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.bypass_tokens.index',
            compact('bypassTokens', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', BypassToken::class);

        $users = User::pluck('name', 'id');

        return view('app.bypass_tokens.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BypassTokenStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', BypassToken::class);

        $validated = $request->validated();

        $bypassToken = BypassToken::create($validated);

        return redirect()
            ->route('bypass-tokens.edit', $bypassToken)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, BypassToken $bypassToken): View
    {
        $this->authorize('view', $bypassToken);

        return view('app.bypass_tokens.show', compact('bypassToken'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, BypassToken $bypassToken): View
    {
        $this->authorize('update', $bypassToken);

        $users = User::pluck('name', 'id');

        return view('app.bypass_tokens.edit', compact('bypassToken', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        BypassTokenUpdateRequest $request,
        BypassToken $bypassToken
    ): RedirectResponse {
        $this->authorize('update', $bypassToken);

        $validated = $request->validated();

        $bypassToken->update($validated);

        return redirect()
            ->route('bypass-tokens.edit', $bypassToken)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        BypassToken $bypassToken
    ): RedirectResponse {
        $this->authorize('delete', $bypassToken);

        $bypassToken->delete();

        return redirect()
            ->route('bypass-tokens.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
