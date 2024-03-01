<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\WpTermMeta;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WpTermMetaControllerTest extends TestCase
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
    public function it_displays_index_view_with_wp_term_metas(): void
    {
        $wpTermMetas = WpTermMeta::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('wp-term-metas.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.wp_term_metas.index')
            ->assertViewHas('wpTermMetas');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_wp_term_meta(): void
    {
        $response = $this->get(route('wp-term-metas.create'));

        $response->assertOk()->assertViewIs('app.wp_term_metas.create');
    }

    /**
     * @test
     */
    public function it_stores_the_wp_term_meta(): void
    {
        $data = WpTermMeta::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('wp-term-metas.store'), $data);

        $this->assertDatabaseHas('wp_termmeta', $data);

        $wpTermMeta = WpTermMeta::latest('meta_id')->first();

        $response->assertRedirect(route('wp-term-metas.edit', $wpTermMeta));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_wp_term_meta(): void
    {
        $wpTermMeta = WpTermMeta::factory()->create();

        $response = $this->get(route('wp-term-metas.show', $wpTermMeta));

        $response
            ->assertOk()
            ->assertViewIs('app.wp_term_metas.show')
            ->assertViewHas('wpTermMeta');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_wp_term_meta(): void
    {
        $wpTermMeta = WpTermMeta::factory()->create();

        $response = $this->get(route('wp-term-metas.edit', $wpTermMeta));

        $response
            ->assertOk()
            ->assertViewIs('app.wp_term_metas.edit')
            ->assertViewHas('wpTermMeta');
    }

    /**
     * @test
     */
    public function it_updates_the_wp_term_meta(): void
    {
        $wpTermMeta = WpTermMeta::factory()->create();

        $data = [
            'term_id' => $this->faker->randomNumber(),
            'meta_key' => $this->faker->text(255),
            'meta_value' => $this->faker->text(),
        ];

        $response = $this->put(
            route('wp-term-metas.update', $wpTermMeta),
            $data
        );

        $data['meta_id'] = $wpTermMeta->meta_id;

        $this->assertDatabaseHas('wp_termmeta', $data);

        $response->assertRedirect(route('wp-term-metas.edit', $wpTermMeta));
    }

    /**
     * @test
     */
    public function it_deletes_the_wp_term_meta(): void
    {
        $wpTermMeta = WpTermMeta::factory()->create();

        $response = $this->delete(route('wp-term-metas.destroy', $wpTermMeta));

        $response->assertRedirect(route('wp-term-metas.index'));

        $this->assertModelMissing($wpTermMeta);
    }
}
