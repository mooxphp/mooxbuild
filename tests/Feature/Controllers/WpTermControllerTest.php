<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\WpTerm;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WpTermControllerTest extends TestCase
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
    public function it_displays_index_view_with_wp_terms(): void
    {
        $wpTerms = WpTerm::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('wp-terms.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.wp_terms.index')
            ->assertViewHas('wpTerms');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_wp_term(): void
    {
        $response = $this->get(route('wp-terms.create'));

        $response->assertOk()->assertViewIs('app.wp_terms.create');
    }

    /**
     * @test
     */
    public function it_stores_the_wp_term(): void
    {
        $data = WpTerm::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('wp-terms.store'), $data);

        $this->assertDatabaseHas('wp_terms', $data);

        $wpTerm = WpTerm::latest('term_id')->first();

        $response->assertRedirect(route('wp-terms.edit', $wpTerm));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_wp_term(): void
    {
        $wpTerm = WpTerm::factory()->create();

        $response = $this->get(route('wp-terms.show', $wpTerm));

        $response
            ->assertOk()
            ->assertViewIs('app.wp_terms.show')
            ->assertViewHas('wpTerm');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_wp_term(): void
    {
        $wpTerm = WpTerm::factory()->create();

        $response = $this->get(route('wp-terms.edit', $wpTerm));

        $response
            ->assertOk()
            ->assertViewIs('app.wp_terms.edit')
            ->assertViewHas('wpTerm');
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

        $response = $this->put(route('wp-terms.update', $wpTerm), $data);

        $data['term_id'] = $wpTerm->term_id;

        $this->assertDatabaseHas('wp_terms', $data);

        $response->assertRedirect(route('wp-terms.edit', $wpTerm));
    }

    /**
     * @test
     */
    public function it_deletes_the_wp_term(): void
    {
        $wpTerm = WpTerm::factory()->create();

        $response = $this->delete(route('wp-terms.destroy', $wpTerm));

        $response->assertRedirect(route('wp-terms.index'));

        $this->assertModelMissing($wpTerm);
    }
}
