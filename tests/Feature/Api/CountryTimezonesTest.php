<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Country;
use App\Models\Timezone;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CountryTimezonesTest extends TestCase
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
    public function it_gets_country_timezones(): void
    {
        $country = Country::factory()->create();
        $timezone = Timezone::factory()->create();

        $country->timezones()->attach($timezone);

        $response = $this->getJson(
            route('api.countries.timezones.index', $country)
        );

        $response->assertOk()->assertSee($timezone->zone_name);
    }

    /**
     * @test
     */
    public function it_can_attach_timezones_to_country(): void
    {
        $country = Country::factory()->create();
        $timezone = Timezone::factory()->create();

        $response = $this->postJson(
            route('api.countries.timezones.store', [$country, $timezone])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $country
                ->timezones()
                ->where('timezones.id', $timezone->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_timezones_from_country(): void
    {
        $country = Country::factory()->create();
        $timezone = Timezone::factory()->create();

        $response = $this->deleteJson(
            route('api.countries.timezones.store', [$country, $timezone])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $country
                ->timezones()
                ->where('timezones.id', $timezone->id)
                ->exists()
        );
    }
}
