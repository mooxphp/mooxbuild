<?php

namespace Tests\Feature\Api;

use App\Models\Seo;
use App\Models\User;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SeoTest extends TestCase
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
    public function it_gets_seos_list(): void
    {
        $seos = Seo::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.seos.index'));

        $response->assertOk()->assertSee($seos[0]->seoable_type);
    }

    /**
     * @test
     */
    public function it_stores_the_seo(): void
    {
        $data = Seo::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.seos.store'), $data);

        $this->assertDatabaseHas('seos', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_seo(): void
    {
        $seo = Seo::factory()->create();

        $data = [
            'meta_title' => $this->faker->text(255),
            'meta_description' => $this->faker->text(255),
            'meta_keywords' => $this->faker->text(255),
            'og_title' => $this->faker->text(255),
            'og_description' => $this->faker->text(255),
            'og_image' => $this->faker->text(255),
            'twitter_card' => $this->faker->text(255),
            'twitter_site' => $this->faker->text(255),
            'twitter_creator' => $this->faker->text(255),
            'schema_markup' => [],
            'breadcrumb_title' => $this->faker->text(255),
            'canonical_url' => $this->faker->text(255),
            'redirect_url' => $this->faker->text(255),
            'focus_keyphrases' => [],
            'focus_keyphrase' => $this->faker->text(255),
            'seo_scores' => [],
            'seo_score' => $this->faker->randomNumber(1),
            'readability_score' => $this->faker->randomNumber(1),
            'fav_icon' => $this->faker->text(255),
            'app_icon' => $this->faker->text(255),
            'app_color' => $this->faker->text(255),
            'web_manifest' => [],
            'noindex' => $this->faker->boolean(),
            'nofollow' => $this->faker->boolean(),
        ];

        $response = $this->putJson(route('api.seos.update', $seo), $data);

        $data['id'] = $seo->id;

        $this->assertDatabaseHas('seos', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_seo(): void
    {
        $seo = Seo::factory()->create();

        $response = $this->deleteJson(route('api.seos.destroy', $seo));

        $this->assertModelMissing($seo);

        $response->assertNoContent();
    }
}
