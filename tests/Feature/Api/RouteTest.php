<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Route;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RouteTest extends TestCase
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
    public function it_gets_routes_list(): void
    {
        $routes = Route::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.routes.index'));

        $response->assertOk()->assertSee($routes[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_route(): void
    {
        $data = Route::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.routes.store'), $data);

        $this->assertDatabaseHas('routes', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_route(): void
    {
        $route = Route::factory()->create();

        $data = [];

        $response = $this->putJson(route('api.routes.update', $route), $data);

        $data['id'] = $route->id;

        $this->assertDatabaseHas('routes', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_route(): void
    {
        $route = Route::factory()->create();

        $response = $this->deleteJson(route('api.routes.destroy', $route));

        $this->assertModelMissing($route);

        $response->assertNoContent();
    }
}
