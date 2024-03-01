<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\WpTermRelationship;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WpTermRelationshipControllerTest extends TestCase
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
    public function it_displays_index_view_with_wp_term_relationships(): void
    {
        $wpTermRelationships = WpTermRelationship::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('wp-term-relationships.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.wp_term_relationships.index')
            ->assertViewHas('wpTermRelationships');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_wp_term_relationship(): void
    {
        $response = $this->get(route('wp-term-relationships.create'));

        $response->assertOk()->assertViewIs('app.wp_term_relationships.create');
    }

    /**
     * @test
     */
    public function it_stores_the_wp_term_relationship(): void
    {
        $data = WpTermRelationship::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('wp-term-relationships.store'), $data);

        $this->assertDatabaseHas('wp_term_relationships', $data);

        $wpTermRelationship = WpTermRelationship::latest('object_id')->first();

        $response->assertRedirect(
            route('wp-term-relationships.edit', $wpTermRelationship)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_wp_term_relationship(): void
    {
        $wpTermRelationship = WpTermRelationship::factory()->create();

        $response = $this->get(
            route('wp-term-relationships.show', $wpTermRelationship)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.wp_term_relationships.show')
            ->assertViewHas('wpTermRelationship');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_wp_term_relationship(): void
    {
        $wpTermRelationship = WpTermRelationship::factory()->create();

        $response = $this->get(
            route('wp-term-relationships.edit', $wpTermRelationship)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.wp_term_relationships.edit')
            ->assertViewHas('wpTermRelationship');
    }

    /**
     * @test
     */
    public function it_updates_the_wp_term_relationship(): void
    {
        $wpTermRelationship = WpTermRelationship::factory()->create();

        $data = [
            'term_taxonomy_id' => $this->faker->randomNumber(),
            'term_order' => $this->faker->randomNumber(0),
        ];

        $response = $this->put(
            route('wp-term-relationships.update', $wpTermRelationship),
            $data
        );

        $data['object_id'] = $wpTermRelationship->object_id;

        $this->assertDatabaseHas('wp_term_relationships', $data);

        $response->assertRedirect(
            route('wp-term-relationships.edit', $wpTermRelationship)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_wp_term_relationship(): void
    {
        $wpTermRelationship = WpTermRelationship::factory()->create();

        $response = $this->delete(
            route('wp-term-relationships.destroy', $wpTermRelationship)
        );

        $response->assertRedirect(route('wp-term-relationships.index'));

        $this->assertModelMissing($wpTermRelationship);
    }
}
