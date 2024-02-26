<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Platform;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserPlatformsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_user_platforms(): void
    {
        $user = User::factory()->create();
        $platform = Platform::factory()->create();

        $user->platforms()->attach($platform);

        $response = $this->getJson(route('api.users.platforms.index', $user));

        $response->assertOk()->assertSee($platform->title);
    }

    /**
     * @test
     */
    public function it_can_attach_platforms_to_user(): void
    {
        $user = User::factory()->create();
        $platform = Platform::factory()->create();

        $response = $this->postJson(
            route('api.users.platforms.store', [$user, $platform])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $user
                ->platforms()
                ->where('platforms.id', $platform->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_platforms_from_user(): void
    {
        $user = User::factory()->create();
        $platform = Platform::factory()->create();

        $response = $this->deleteJson(
            route('api.users.platforms.store', [$user, $platform])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $user
                ->platforms()
                ->where('platforms.id', $platform->id)
                ->exists()
        );
    }
}
