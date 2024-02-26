<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Sync;

use App\Models\Platform;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SyncTest extends TestCase
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
    public function it_gets_syncs_list(): void
    {
        $syncs = Sync::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.syncs.index'));

        $response->assertOk()->assertSee($syncs[0]->syncable_type);
    }

    /**
     * @test
     */
    public function it_stores_the_sync(): void
    {
        $data = Sync::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.syncs.store'), $data);

        $this->assertDatabaseHas('syncs', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_sync(): void
    {
        $sync = Sync::factory()->create();

        $platform = Platform::factory()->create();
        $platform = Platform::factory()->create();

        $data = [
            'last_sync' => $this->faker->dateTime(),
            'source_platform_id' => $platform->id,
            'target_platform_id' => $platform->id,
        ];

        $response = $this->putJson(route('api.syncs.update', $sync), $data);

        $data['id'] = $sync->id;

        $this->assertDatabaseHas('syncs', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_sync(): void
    {
        $sync = Sync::factory()->create();

        $response = $this->deleteJson(route('api.syncs.destroy', $sync));

        $this->assertModelMissing($sync);

        $response->assertNoContent();
    }
}
