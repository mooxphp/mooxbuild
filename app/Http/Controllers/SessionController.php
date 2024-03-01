<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Session;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\SessionStoreRequest;
use App\Http\Requests\SessionUpdateRequest;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Session::class);

        $search = $request->get('search', '');

        $sessions = Session::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.sessions.index', compact('sessions', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Session::class);

        $users = User::pluck('name', 'id');

        return view('app.sessions.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SessionStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Session::class);

        $validated = $request->validated();

        $session = Session::create($validated);

        return redirect()
            ->route('sessions.edit', $session)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Session $session): View
    {
        $this->authorize('view', $session);

        return view('app.sessions.show', compact('session'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Session $session): View
    {
        $this->authorize('update', $session);

        $users = User::pluck('name', 'id');

        return view('app.sessions.edit', compact('session', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        SessionUpdateRequest $request,
        Session $session
    ): RedirectResponse {
        $this->authorize('update', $session);

        $validated = $request->validated();

        $session->update($validated);

        return redirect()
            ->route('sessions.edit', $session)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Session $session
    ): RedirectResponse {
        $this->authorize('delete', $session);

        $session->delete();

        return redirect()
            ->route('sessions.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
