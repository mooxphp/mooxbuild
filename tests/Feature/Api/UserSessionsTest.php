<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Session;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserSessionsTest extends TestCase
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
    public function it_gets_user_sessions(): void
    {
        $user = User::factory()->create();
        $sessions = Session::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(route('api.users.sessions.index', $user));

        $response->assertOk()->assertSee($sessions[0]->user_agent);
    }

    /**
     * @test
     */
    public function it_stores_the_user_sessions(): void
    {
        $user = User::factory()->create();
        $data = Session::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.sessions.store', $user),
            $data
        );

        $this->assertDatabaseHas('sessions', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $session = Session::latest('id')->first();

        $this->assertEquals($user->id, $session->user_id);
    }
}
