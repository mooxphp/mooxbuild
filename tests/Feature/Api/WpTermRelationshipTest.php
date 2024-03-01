<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\WpTermRelationship;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WpTermRelationshipTest extends TestCase
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
    public function it_gets_wp_term_relationships_list(): void
    {
        $wpTermRelationships = WpTermRelationship::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.wp-term-relationships.index'));

        $response->assertOk()->assertSee($wpTermRelationships[0]->object_id);
    }

    /**
     * @test
     */
    public function it_stores_the_wp_term_relationship(): void
    {
        $data = WpTermRelationship::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.wp-term-relationships.store'),
            $data
        );

        $this->assertDatabaseHas('wp_term_relationships', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.wp-term-relationships.update', $wpTermRelationship),
            $data
        );

        $data['object_id'] = $wpTermRelationship->object_id;

        $this->assertDatabaseHas('wp_term_relationships', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_wp_term_relationship(): void
    {
        $wpTermRelationship = WpTermRelationship::factory()->create();

        $response = $this->deleteJson(
            route('api.wp-term-relationships.destroy', $wpTermRelationship)
        );

        $this->assertModelMissing($wpTermRelationship);

        $response->assertNoContent();
    }
}
