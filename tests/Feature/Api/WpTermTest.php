<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\WpTerm;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WpTermTest extends TestCase
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
    public function it_gets_wp_terms_list(): void
    {
        $wpTerms = WpTerm::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.wp-terms.index'));

        $response->assertOk()->assertSee($wpTerms[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_wp_term(): void
    {
        $data = WpTerm::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.wp-terms.store'), $data);

        $this->assertDatabaseHas('wp_terms', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_wp_term(): void
    {
        $wpTerm = WpTerm::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'slug' => $this->faker->slug(),
            'term_group' => $this->faker->randomNumber(),
        ];

        $response = $this->putJson(
            route('api.wp-terms.update', $wpTerm),
            $data
        );

        $data['term_id'] = $wpTerm->term_id;

        $this->assertDatabaseHas('wp_terms', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_wp_term(): void
    {
        $wpTerm = WpTerm::factory()->create();

        $response = $this->deleteJson(route('api.wp-terms.destroy', $wpTerm));

        $this->assertModelMissing($wpTerm);

        $response->assertNoContent();
    }
}
