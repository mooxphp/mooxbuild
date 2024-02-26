<?php

namespace App\Http\Controllers\Api;

use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserCollection;

class LanguageUsersController extends Controller
{
    public function index(Request $request, Language $language): UserCollection
    {
        $this->authorize('view', $language);

        $search = $request->get('search', '');

        $users = $language
            ->users()
            ->search($search)
            ->latest()
            ->paginate();

        return new UserCollection($users);
    }

    public function store(Request $request, Language $language): UserResource
    {
        $this->authorize('create', User::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'slug' => ['required', 'max:255', 'string'],
            'gender' => ['required', 'in:male,female,other'],
            'title' => ['nullable', 'max:255', 'string'],
            'first_name' => ['required', 'max:255', 'string'],
            'last_name' => ['required', 'max:255', 'string'],
            'email' => ['required', 'unique:users,email', 'email'],
            'website' => ['nullable', 'max:255', 'string'],
            'description' => ['nullable', 'max:255', 'string'],
            'password' => ['required'],
            'profile_photo_path' => ['nullable', 'max:255', 'string'],
            'wp_id' => ['nullable', 'max:255'],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = $language->users()->create($validated);

        $user->syncRoles($request->roles);

        return new UserResource($user);
    }
}
