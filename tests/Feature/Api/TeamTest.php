<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Team;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TeamTest extends TestCase
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
    public function it_gets_teams_list(): void
    {
        $teams = Team::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.teams.index'));

        $response->assertOk()->assertSee($teams[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_team(): void
    {
        $data = Team::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.teams.store'), $data);

        $this->assertDatabaseHas('teams', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_team(): void
    {
        $team = Team::factory()->create();

        $data = [];

        $response = $this->putJson(route('api.teams.update', $team), $data);

        $data['id'] = $team->id;

        $this->assertDatabaseHas('teams', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_team(): void
    {
        $team = Team::factory()->create();

        $response = $this->deleteJson(route('api.teams.destroy', $team));

        $this->assertModelMissing($team);

        $response->assertNoContent();
    }
}
