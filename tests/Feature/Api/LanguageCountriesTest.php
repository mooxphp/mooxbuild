<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Country;
use App\Models\Language;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LanguageCountriesTest extends TestCase
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
    public function it_gets_language_countries(): void
    {
        $language = Language::factory()->create();
        $country = Country::factory()->create();

        $language->countries()->attach($country);

        $response = $this->getJson(
            route('api.languages.countries.index', $language)
        );

        $response->assertOk()->assertSee($country->id);
    }

    /**
     * @test
     */
    public function it_can_attach_countries_to_language(): void
    {
        $language = Language::factory()->create();
        $country = Country::factory()->create();

        $response = $this->postJson(
            route('api.languages.countries.store', [$language, $country])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $language
                ->countries()
                ->where('countries.id', $country->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_countries_from_language(): void
    {
        $language = Language::factory()->create();
        $country = Country::factory()->create();

        $response = $this->deleteJson(
            route('api.languages.countries.store', [$language, $country])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $language
                ->countries()
                ->where('countries.id', $country->id)
                ->exists()
        );
    }
}
