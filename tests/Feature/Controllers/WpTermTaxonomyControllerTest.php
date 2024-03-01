<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\WpTermTaxonomy;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WpTermTaxonomyControllerTest extends TestCase
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

    /**
     * @test
     */
    public function it_displays_index_view_with_wp_term_taxonomies(): void
    {
        $wpTermTaxonomies = WpTermTaxonomy::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('wp-term-taxonomies.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.wp_term_taxonomies.index')
            ->assertViewHas('wpTermTaxonomies');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_wp_term_taxonomy(): void
    {
        $response = $this->get(route('wp-term-taxonomies.create'));

        $response->assertOk()->assertViewIs('app.wp_term_taxonomies.create');
    }

    /**
     * @test
     */
    public function it_stores_the_wp_term_taxonomy(): void
    {
        $data = WpTermTaxonomy::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('wp-term-taxonomies.store'), $data);

        $this->assertDatabaseHas('wp_term_taxonomy', $data);

        $wpTermTaxonomy = WpTermTaxonomy::latest('term_taxonomy_id')->first();

        $response->assertRedirect(
            route('wp-term-taxonomies.edit', $wpTermTaxonomy)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_wp_term_taxonomy(): void
    {
        $wpTermTaxonomy = WpTermTaxonomy::factory()->create();

        $response = $this->get(
            route('wp-term-taxonomies.show', $wpTermTaxonomy)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.wp_term_taxonomies.show')
            ->assertViewHas('wpTermTaxonomy');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_wp_term_taxonomy(): void
    {
        $wpTermTaxonomy = WpTermTaxonomy::factory()->create();

        $response = $this->get(
            route('wp-term-taxonomies.edit', $wpTermTaxonomy)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.wp_term_taxonomies.edit')
            ->assertViewHas('wpTermTaxonomy');
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

        $response = $this->put(
            route('wp-term-taxonomies.update', $wpTermTaxonomy),
            $data
        );

        $data['term_taxonomy_id'] = $wpTermTaxonomy->term_taxonomy_id;

        $this->assertDatabaseHas('wp_term_taxonomy', $data);

        $response->assertRedirect(
            route('wp-term-taxonomies.edit', $wpTermTaxonomy)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_wp_term_taxonomy(): void
    {
        $wpTermTaxonomy = WpTermTaxonomy::factory()->create();

        $response = $this->delete(
            route('wp-term-taxonomies.destroy', $wpTermTaxonomy)
        );

        $response->assertRedirect(route('wp-term-taxonomies.index'));

        $this->assertModelMissing($wpTermTaxonomy);
    }
}
