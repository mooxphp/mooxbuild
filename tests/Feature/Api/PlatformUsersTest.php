<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Platform;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PlatformUsersTest extends TestCase
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
    public function it_gets_platform_users(): void
    {
        $platform = Platform::factory()->create();
        $user = User::factory()->create();

        $platform->users()->attach($user);

        $response = $this->getJson(
            route('api.platforms.users.index', $platform)
        );

        $response->assertOk()->assertSee($user->name);
    }

    /**
     * @test
     */
    public function it_can_attach_users_to_platform(): void
    {
        $platform = Platform::factory()->create();
        $user = User::factory()->create();

        $response = $this->postJson(
            route('api.platforms.users.store', [$platform, $user])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $platform
                ->users()
                ->where('users.id', $user->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_users_from_platform(): void
    {
        $platform = Platform::factory()->create();
        $user = User::factory()->create();

        $response = $this->deleteJson(
            route('api.platforms.users.store', [$platform, $user])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $platform
                ->users()
                ->where('users.id', $user->id)
                ->exists()
        );
    }
}
