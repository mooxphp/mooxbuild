<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Country;
use App\Models\Timezone;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TimezoneCountriesTest extends TestCase
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
    public function it_gets_timezone_countries(): void
    {
        $timezone = Timezone::factory()->create();
        $country = Country::factory()->create();

        $timezone->countries()->attach($country);

        $response = $this->getJson(
            route('api.timezones.countries.index', $timezone)
        );

        $response->assertOk()->assertSee($country->title);
    }

    /**
     * @test
     */
    public function it_can_attach_countries_to_timezone(): void
    {
        $timezone = Timezone::factory()->create();
        $country = Country::factory()->create();

        $response = $this->postJson(
            route('api.timezones.countries.store', [$timezone, $country])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $timezone
                ->countries()
                ->where('countries.id', $country->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_countries_from_timezone(): void
    {
        $timezone = Timezone::factory()->create();
        $country = Country::factory()->create();

        $response = $this->deleteJson(
            route('api.timezones.countries.store', [$timezone, $country])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $timezone
                ->countries()
                ->where('countries.id', $country->id)
                ->exists()
        );
    }
}
