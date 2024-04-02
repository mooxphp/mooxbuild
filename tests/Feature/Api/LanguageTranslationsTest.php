<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Language;
use App\Models\Translation;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LanguageTranslationsTest extends TestCase
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
    public function it_gets_language_translations(): void
    {
        $language = Language::factory()->create();
        $translations = Translation::factory()
            ->count(2)
            ->create([
                'fallback_language_id' => $language->id,
            ]);

        $response = $this->getJson(
            route('api.languages.translations.index', $language)
        );

        $response->assertOk()->assertSee($translations[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_language_translations(): void
    {
        $language = Language::factory()->create();
        $data = Translation::factory()
            ->make([
                'fallback_language_id' => $language->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.languages.translations.store', $language),
            $data
        );

        unset($data['language_id']);
        unset($data['fallback_language_id']);

        $this->assertDatabaseHas('translations', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $translation = Translation::latest('id')->first();

        $this->assertEquals($language->id, $translation->fallback_language_id);
    }
}
