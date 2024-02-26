<?php
namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Platform;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollection;

class PlatformUsersController extends Controller
{
    public function index(Request $request, Platform $platform): UserCollection
    {
        $this->authorize('view', $platform);

        $search = $request->get('search', '');

        $users = $platform
            ->users()
            ->search($search)
            ->latest()
            ->paginate();

        return new UserCollection($users);
    }

    public function store(
        Request $request,
        Platform $platform,
        User $user
    ): Response {
        $this->authorize('update', $platform);

        $platform->users()->syncWithoutDetaching([$user->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        Platform $platform,
        User $user
    ): Response {
        $this->authorize('update', $platform);

        $platform->users()->detach($user);

        return response()->noContent();
    }
}
