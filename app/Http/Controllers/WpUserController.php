<?php

namespace App\Http\Controllers;

use App\Models\WpUser;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\WpUserStoreRequest;
use App\Http\Requests\WpUserUpdateRequest;

class WpUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', WpUser::class);

        $search = $request->get('search', '');

        $wpUsers = WpUser::search($search)
            ->latest('id')
            ->paginate(5)
            ->withQueryString();

        return view('app.wp_users.index', compact('wpUsers', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', WpUser::class);

        return view('app.wp_users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WpUserStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', WpUser::class);

        $validated = $request->validated();

        $wpUser = WpUser::create($validated);

        return redirect()
            ->route('wp-users.edit', $wpUser)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, WpUser $wpUser): View
    {
        $this->authorize('view', $wpUser);

        return view('app.wp_users.show', compact('wpUser'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, WpUser $wpUser): View
    {
        $this->authorize('update', $wpUser);

        return view('app.wp_users.edit', compact('wpUser'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        WpUserUpdateRequest $request,
        WpUser $wpUser
    ): RedirectResponse {
        $this->authorize('update', $wpUser);

        $validated = $request->validated();

        $wpUser->update($validated);

        return redirect()
            ->route('wp-users.edit', $wpUser)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, WpUser $wpUser): RedirectResponse
    {
        $this->authorize('delete', $wpUser);

        $wpUser->delete();

        return redirect()
            ->route('wp-users.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
