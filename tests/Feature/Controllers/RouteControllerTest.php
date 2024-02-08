<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Route;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RouteControllerTest extends TestCase
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
    public function it_displays_index_view_with_routes(): void
    {
        $routes = Route::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('routes.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.routes.index')
            ->assertViewHas('routes');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_route(): void
    {
        $response = $this->get(route('routes.create'));

        $response->assertOk()->assertViewIs('app.routes.create');
    }

    /**
     * @test
     */
    public function it_stores_the_route(): void
    {
        $data = Route::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('routes.store'), $data);

        $this->assertDatabaseHas('routes', $data);

        $route = Route::latest('id')->first();

        $response->assertRedirect(route('routes.edit', $route));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_route(): void
    {
        $route = Route::factory()->create();

        $response = $this->get(route('routes.show', $route));

        $response
            ->assertOk()
            ->assertViewIs('app.routes.show')
            ->assertViewHas('route');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_route(): void
    {
        $route = Route::factory()->create();

        $response = $this->get(route('routes.edit', $route));

        $response
            ->assertOk()
            ->assertViewIs('app.routes.edit')
            ->assertViewHas('route');
    }

    /**
     * @test
     */
    public function it_updates_the_route(): void
    {
        $route = Route::factory()->create();

        $data = [];

        $response = $this->put(route('routes.update', $route), $data);

        $data['id'] = $route->id;

        $this->assertDatabaseHas('routes', $data);

        $response->assertRedirect(route('routes.edit', $route));
    }

    /**
     * @test
     */
    public function it_deletes_the_route(): void
    {
        $route = Route::factory()->create();

        $response = $this->delete(route('routes.destroy', $route));

        $response->assertRedirect(route('routes.index'));

        $this->assertModelMissing($route);
    }
}
