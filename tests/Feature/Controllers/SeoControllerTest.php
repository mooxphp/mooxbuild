<?php

namespace Tests\Feature\Controllers;

use App\Models\Seo;
use App\Models\User;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SeoControllerTest extends TestCase
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

    protected function castToJson($json)
    {
        if (is_array($json)) {
            $json = addslashes(json_encode($json));
        } elseif (is_null($json) || is_null(json_decode($json))) {
            throw new \Exception(
                'A valid JSON string was not provided for casting.'
            );
        }

        return \DB::raw("CAST('{$json}' AS JSON)");
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_seos(): void
    {
        $seos = Seo::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('seos.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.seos.index')
            ->assertViewHas('seos');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_seo(): void
    {
        $response = $this->get(route('seos.create'));

        $response->assertOk()->assertViewIs('app.seos.create');
    }

    /**
     * @test
     */
    public function it_stores_the_seo(): void
    {
        $data = Seo::factory()
            ->make()
            ->toArray();

        $data['schema_markup'] = json_encode($data['schema_markup']);
        $data['focus_keyphrases'] = json_encode($data['focus_keyphrases']);
        $data['seo_scores'] = json_encode($data['seo_scores']);
        $data['web_manifest'] = json_encode($data['web_manifest']);

        $response = $this->post(route('seos.store'), $data);

        $data['schema_markup'] = $this->castToJson($data['schema_markup']);
        $data['focus_keyphrases'] = $this->castToJson(
            $data['focus_keyphrases']
        );
        $data['seo_scores'] = $this->castToJson($data['seo_scores']);
        $data['web_manifest'] = $this->castToJson($data['web_manifest']);

        $this->assertDatabaseHas('seos', $data);

        $seo = Seo::latest('id')->first();

        $response->assertRedirect(route('seos.edit', $seo));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_seo(): void
    {
        $seo = Seo::factory()->create();

        $response = $this->get(route('seos.show', $seo));

        $response
            ->assertOk()
            ->assertViewIs('app.seos.show')
            ->assertViewHas('seo');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_seo(): void
    {
        $seo = Seo::factory()->create();

        $response = $this->get(route('seos.edit', $seo));

        $response
            ->assertOk()
            ->assertViewIs('app.seos.edit')
            ->assertViewHas('seo');
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

        $data['schema_markup'] = json_encode($data['schema_markup']);
        $data['focus_keyphrases'] = json_encode($data['focus_keyphrases']);
        $data['seo_scores'] = json_encode($data['seo_scores']);
        $data['web_manifest'] = json_encode($data['web_manifest']);

        $response = $this->put(route('seos.update', $seo), $data);

        $data['id'] = $seo->id;

        $data['schema_markup'] = $this->castToJson($data['schema_markup']);
        $data['focus_keyphrases'] = $this->castToJson(
            $data['focus_keyphrases']
        );
        $data['seo_scores'] = $this->castToJson($data['seo_scores']);
        $data['web_manifest'] = $this->castToJson($data['web_manifest']);

        $this->assertDatabaseHas('seos', $data);

        $response->assertRedirect(route('seos.edit', $seo));
    }

    /**
     * @test
     */
    public function it_deletes_the_seo(): void
    {
        $seo = Seo::factory()->create();

        $response = $this->delete(route('seos.destroy', $seo));

        $response->assertRedirect(route('seos.index'));

        $this->assertModelMissing($seo);
    }
}
