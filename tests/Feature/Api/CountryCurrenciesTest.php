<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Country;
use App\Models\Currency;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CountryCurrenciesTest extends TestCase
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
    public function it_gets_country_currencies(): void
    {
        $country = Country::factory()->create();
        $currency = Currency::factory()->create();

        $country->currencies()->attach($currency);

        $response = $this->getJson(
            route('api.countries.currencies.index', $country)
        );

        $response->assertOk()->assertSee($currency->id);
    }

    /**
     * @test
     */
    public function it_can_attach_currencies_to_country(): void
    {
        $country = Country::factory()->create();
        $currency = Currency::factory()->create();

        $response = $this->postJson(
            route('api.countries.currencies.store', [$country, $currency])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $country
                ->currencies()
                ->where('currencies.id', $currency->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_currencies_from_country(): void
    {
        $country = Country::factory()->create();
        $currency = Currency::factory()->create();

        $response = $this->deleteJson(
            route('api.countries.currencies.store', [$country, $currency])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $country
                ->currencies()
                ->where('currencies.id', $currency->id)
                ->exists()
        );
    }
}
