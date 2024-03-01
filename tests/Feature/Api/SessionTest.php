<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Session;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SessionTest extends TestCase
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
    public function it_gets_sessions_list(): void
    {
        $sessions = Session::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.sessions.index'));

        $response->assertOk()->assertSee($sessions[0]->user_agent);
    }

    /**
     * @test
     */
    public function it_stores_the_session(): void
    {
        $data = Session::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.sessions.store'), $data);

        $this->assertDatabaseHas('sessions', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_session(): void
    {
        $session = Session::factory()->create();

        $user = User::factory()->create();

        $data = [
            'ip_address' => $this->faker->ipv4(),
            'user_agent' => $this->faker->userAgent(),
            'payload' => $this->faker->text(),
            'last_activity' => $this->faker->randomNumber(0),
            'user_id' => $user->id,
        ];

        $response = $this->putJson(
            route('api.sessions.update', $session),
            $data
        );

        $data['id'] = $session->id;

        $this->assertDatabaseHas('sessions', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_session(): void
    {
        $session = Session::factory()->create();

        $response = $this->deleteJson(route('api.sessions.destroy', $session));

        $this->assertModelMissing($session);

        $response->assertNoContent();
    }
}
