<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Country;
use App\Models\Currency;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CurrencyCountriesTest extends TestCase
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
    public function it_gets_currency_countries(): void
    {
        $currency = Currency::factory()->create();
        $country = Country::factory()->create();

        $currency->countries()->attach($country);

        $response = $this->getJson(
            route('api.currencies.countries.index', $currency)
        );

        $response->assertOk()->assertSee($country->id);
    }

    /**
     * @test
     */
    public function it_can_attach_countries_to_currency(): void
    {
        $currency = Currency::factory()->create();
        $country = Country::factory()->create();

        $response = $this->postJson(
            route('api.currencies.countries.store', [$currency, $country])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $currency
                ->countries()
                ->where('countries.id', $country->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_countries_from_currency(): void
    {
        $currency = Currency::factory()->create();
        $country = Country::factory()->create();

        $response = $this->deleteJson(
            route('api.currencies.countries.store', [$currency, $country])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $currency
                ->countries()
                ->where('countries.id', $country->id)
                ->exists()
        );
    }
}
