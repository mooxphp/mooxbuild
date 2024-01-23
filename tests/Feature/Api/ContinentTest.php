<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Continent;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContinentTest extends TestCase
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
    public function it_gets_continents_list(): void
    {
        $continents = Continent::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.continents.index'));

        $response->assertOk()->assertSee($continents[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_continent(): void
    {
        $data = Continent::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.continents.store'), $data);

        $this->assertDatabaseHas('continents', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_continent(): void
    {
        $continent = Continent::factory()->create();

        $continent = Continent::factory()->create();

        $data = [
            'title' => $this->faker->sentence(10),
            'slug' => $this->faker->slug(),
            'parent_continent_id' => $continent->id,
        ];

        $response = $this->putJson(
            route('api.continents.update', $continent),
            $data
        );

        $data['id'] = $continent->id;

        $this->assertDatabaseHas('continents', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_continent(): void
    {
        $continent = Continent::factory()->create();

        $response = $this->deleteJson(
            route('api.continents.destroy', $continent)
        );

        $this->assertModelMissing($continent);

        $response->assertNoContent();
    }
}
