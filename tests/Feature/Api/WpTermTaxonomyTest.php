<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\WpTermTaxonomy;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WpTermTaxonomyTest extends TestCase
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
    public function it_gets_wp_term_taxonomies_list(): void
    {
        $wpTermTaxonomies = WpTermTaxonomy::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.wp-term-taxonomies.index'));

        $response->assertOk()->assertSee($wpTermTaxonomies[0]->taxonomy);
    }

    /**
     * @test
     */
    public function it_stores_the_wp_term_taxonomy(): void
    {
        $data = WpTermTaxonomy::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.wp-term-taxonomies.store'),
            $data
        );

        $this->assertDatabaseHas('wp_term_taxonomy', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_wp_term_taxonomy(): void
    {
        $wpTermTaxonomy = WpTermTaxonomy::factory()->create();

        $data = [
            'term_id' => $this->faker->randomNumber(),
            'taxonomy' => $this->faker->text(32),
            'description' => $this->faker->text(),
            'parent' => $this->faker->randomNumber(),
            'count' => $this->faker->randomNumber(),
        ];

        $response = $this->putJson(
            route('api.wp-term-taxonomies.update', $wpTermTaxonomy),
            $data
        );

        $data['term_taxonomy_id'] = $wpTermTaxonomy->term_taxonomy_id;

        $this->assertDatabaseHas('wp_term_taxonomy', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_wp_term_taxonomy(): void
    {
        $wpTermTaxonomy = WpTermTaxonomy::factory()->create();

        $response = $this->deleteJson(
            route('api.wp-term-taxonomies.destroy', $wpTermTaxonomy)
        );

        $this->assertModelMissing($wpTermTaxonomy);

        $response->assertNoContent();
    }
}
