<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Country;
use App\Models\Continent;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContinentCountriesTest extends TestCase
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
    public function it_gets_continent_countries(): void
    {
        $continent = Continent::factory()->create();
        $countries = Country::factory()
            ->count(2)
            ->create([
                'continent_id' => $continent->id,
            ]);

        $response = $this->getJson(
            route('api.continents.countries.index', $continent)
        );

        $response->assertOk()->assertSee($countries[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_continent_countries(): void
    {
        $continent = Continent::factory()->create();
        $data = Country::factory()
            ->make([
                'continent_id' => $continent->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.continents.countries.store', $continent),
            $data
        );

        $this->assertDatabaseHas('countries', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $country = Country::latest('id')->first();

        $this->assertEquals($continent->id, $country->continent_id);
    }
}
