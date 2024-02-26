<?php
namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Platform;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\PlatformCollection;

class UserPlatformsController extends Controller
{
    public function index(Request $request, User $user): PlatformCollection
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $platforms = $user
            ->platforms()
            ->search($search)
            ->latest()
            ->paginate();

        return new PlatformCollection($platforms);
    }

    public function store(
        Request $request,
        User $user,
        Platform $platform
    ): Response {
        $this->authorize('update', $user);

        $user->platforms()->syncWithoutDetaching([$platform->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        User $user,
        Platform $platform
    ): Response {
        $this->authorize('update', $user);

        $user->platforms()->detach($platform);

        return response()->noContent();
    }
}
