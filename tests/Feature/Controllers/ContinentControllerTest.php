<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Continent;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContinentControllerTest extends TestCase
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
    public function it_displays_index_view_with_continents(): void
    {
        $continents = Continent::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('continents.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.continents.index')
            ->assertViewHas('continents');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_continent(): void
    {
        $response = $this->get(route('continents.create'));

        $response->assertOk()->assertViewIs('app.continents.create');
    }

    /**
     * @test
     */
    public function it_stores_the_continent(): void
    {
        $data = Continent::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('continents.store'), $data);

        $this->assertDatabaseHas('continents', $data);

        $continent = Continent::latest('id')->first();

        $response->assertRedirect(route('continents.edit', $continent));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_continent(): void
    {
        $continent = Continent::factory()->create();

        $response = $this->get(route('continents.show', $continent));

        $response
            ->assertOk()
            ->assertViewIs('app.continents.show')
            ->assertViewHas('continent');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_continent(): void
    {
        $continent = Continent::factory()->create();

        $response = $this->get(route('continents.edit', $continent));

        $response
            ->assertOk()
            ->assertViewIs('app.continents.edit')
            ->assertViewHas('continent');
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

        $response = $this->put(route('continents.update', $continent), $data);

        $data['id'] = $continent->id;

        $this->assertDatabaseHas('continents', $data);

        $response->assertRedirect(route('continents.edit', $continent));
    }

    /**
     * @test
     */
    public function it_deletes_the_continent(): void
    {
        $continent = Continent::factory()->create();

        $response = $this->delete(route('continents.destroy', $continent));

        $response->assertRedirect(route('continents.index'));

        $this->assertModelMissing($continent);
    }
}
