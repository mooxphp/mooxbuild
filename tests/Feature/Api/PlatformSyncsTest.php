<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Sync;
use App\Models\Platform;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PlatformSyncsTest extends TestCase
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
    public function it_gets_platform_syncs(): void
    {
        $platform = Platform::factory()->create();
        $syncs = Sync::factory()
            ->count(2)
            ->create([
                'target_platform_id' => $platform->id,
            ]);

        $response = $this->getJson(
            route('api.platforms.syncs.index', $platform)
        );

        $response->assertOk()->assertSee($syncs[0]->syncable_type);
    }

    /**
     * @test
     */
    public function it_stores_the_platform_syncs(): void
    {
        $platform = Platform::factory()->create();
        $data = Sync::factory()
            ->make([
                'target_platform_id' => $platform->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.platforms.syncs.store', $platform),
            $data
        );

        $this->assertDatabaseHas('syncs', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $sync = Sync::latest('id')->first();

        $this->assertEquals($platform->id, $sync->target_platform_id);
    }
}
