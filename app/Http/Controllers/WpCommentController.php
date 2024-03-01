<?php

namespace App\Http\Controllers;

use App\Models\WpComment;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\WpCommentStoreRequest;
use App\Http\Requests\WpCommentUpdateRequest;

class WpCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', WpComment::class);

        $search = $request->get('search', '');

        $wpComments = WpComment::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.wp_comments.index', compact('wpComments', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', WpComment::class);

        return view('app.wp_comments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WpCommentStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', WpComment::class);

        $validated = $request->validated();

        $wpComment = WpComment::create($validated);

        return redirect()
            ->route('wp-comments.edit', $wpComment)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, WpComment $wpComment): View
    {
        $this->authorize('view', $wpComment);

        return view('app.wp_comments.show', compact('wpComment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, WpComment $wpComment): View
    {
        $this->authorize('update', $wpComment);

        return view('app.wp_comments.edit', compact('wpComment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        WpCommentUpdateRequest $request,
        WpComment $wpComment
    ): RedirectResponse {
        $this->authorize('update', $wpComment);

        $validated = $request->validated();

        $wpComment->update($validated);

        return redirect()
            ->route('wp-comments.edit', $wpComment)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        WpComment $wpComment
    ): RedirectResponse {
        $this->authorize('delete', $wpComment);

        $wpComment->delete();

        return redirect()
            ->route('wp-comments.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
