<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Country;
use App\Models\Language;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CountryLanguagesTest extends TestCase
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
    public function it_gets_country_languages(): void
    {
        $country = Country::factory()->create();
        $language = Language::factory()->create();

        $country->languages()->attach($language);

        $response = $this->getJson(
            route('api.countries.languages.index', $country)
        );

        $response->assertOk()->assertSee($language->title);
    }

    /**
     * @test
     */
    public function it_can_attach_languages_to_country(): void
    {
        $country = Country::factory()->create();
        $language = Language::factory()->create();

        $response = $this->postJson(
            route('api.countries.languages.store', [$country, $language])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $country
                ->languages()
                ->where('languages.id', $language->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_languages_from_country(): void
    {
        $country = Country::factory()->create();
        $language = Language::factory()->create();

        $response = $this->deleteJson(
            route('api.countries.languages.store', [$country, $language])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $country
                ->languages()
                ->where('languages.id', $language->id)
                ->exists()
        );
    }
}
