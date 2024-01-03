<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Blacklist;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BlacklistTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_blacklists_list(): void
    {
        $blacklists = Blacklist::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.blacklists.index'));

        $response->assertOk()->assertSee($blacklists[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_blacklist(): void
    {
        $data = Blacklist::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.blacklists.store'), $data);

        $this->assertDatabaseHas('blacklists', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_blacklist(): void
    {
        $blacklist = Blacklist::factory()->create();

        $data = [];

        $response = $this->putJson(
            route('api.blacklists.update', $blacklist),
            $data
        );

        $data['id'] = $blacklist->id;

        $this->assertDatabaseHas('blacklists', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_blacklist(): void
    {
        $blacklist = Blacklist::factory()->create();

        $response = $this->deleteJson(
            route('api.blacklists.destroy', $blacklist)
        );

        $this->assertModelMissing($blacklist);

        $response->assertNoContent();
    }
}
