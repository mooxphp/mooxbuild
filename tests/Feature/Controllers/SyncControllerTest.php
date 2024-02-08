<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Sync;

use App\Models\Platform;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SyncControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_syncs(): void
    {
        $syncs = Sync::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('syncs.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.syncs.index')
            ->assertViewHas('syncs');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_sync(): void
    {
        $response = $this->get(route('syncs.create'));

        $response->assertOk()->assertViewIs('app.syncs.create');
    }

    /**
     * @test
     */
    public function it_stores_the_sync(): void
    {
        $data = Sync::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('syncs.store'), $data);

        $this->assertDatabaseHas('syncs', $data);

        $sync = Sync::latest('id')->first();

        $response->assertRedirect(route('syncs.edit', $sync));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_sync(): void
    {
        $sync = Sync::factory()->create();

        $response = $this->get(route('syncs.show', $sync));

        $response
            ->assertOk()
            ->assertViewIs('app.syncs.show')
            ->assertViewHas('sync');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_sync(): void
    {
        $sync = Sync::factory()->create();

        $response = $this->get(route('syncs.edit', $sync));

        $response
            ->assertOk()
            ->assertViewIs('app.syncs.edit')
            ->assertViewHas('sync');
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

        $response = $this->put(route('syncs.update', $sync), $data);

        $data['id'] = $sync->id;

        $this->assertDatabaseHas('syncs', $data);

        $response->assertRedirect(route('syncs.edit', $sync));
    }

    /**
     * @test
     */
    public function it_deletes_the_sync(): void
    {
        $sync = Sync::factory()->create();

        $response = $this->delete(route('syncs.destroy', $sync));

        $response->assertRedirect(route('syncs.index'));

        $this->assertModelMissing($sync);
    }
}
