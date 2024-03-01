<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Session;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SessionControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_sessions(): void
    {
        $sessions = Session::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('sessions.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.sessions.index')
            ->assertViewHas('sessions');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_session(): void
    {
        $response = $this->get(route('sessions.create'));

        $response->assertOk()->assertViewIs('app.sessions.create');
    }

    /**
     * @test
     */
    public function it_stores_the_session(): void
    {
        $data = Session::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('sessions.store'), $data);

        $this->assertDatabaseHas('sessions', $data);

        $session = Session::latest('id')->first();

        $response->assertRedirect(route('sessions.edit', $session));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_session(): void
    {
        $session = Session::factory()->create();

        $response = $this->get(route('sessions.show', $session));

        $response
            ->assertOk()
            ->assertViewIs('app.sessions.show')
            ->assertViewHas('session');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_session(): void
    {
        $session = Session::factory()->create();

        $response = $this->get(route('sessions.edit', $session));

        $response
            ->assertOk()
            ->assertViewIs('app.sessions.edit')
            ->assertViewHas('session');
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

        $response = $this->put(route('sessions.update', $session), $data);

        $data['id'] = $session->id;

        $this->assertDatabaseHas('sessions', $data);

        $response->assertRedirect(route('sessions.edit', $session));
    }

    /**
     * @test
     */
    public function it_deletes_the_session(): void
    {
        $session = Session::factory()->create();

        $response = $this->delete(route('sessions.destroy', $session));

        $response->assertRedirect(route('sessions.index'));

        $this->assertModelMissing($session);
    }
}
