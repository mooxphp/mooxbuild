<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\WpPostMeta;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WpPostMetaControllerTest extends TestCase
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
    public function it_displays_index_view_with_wp_post_metas(): void
    {
        $wpPostMetas = WpPostMeta::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('wp-post-metas.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.wp_post_metas.index')
            ->assertViewHas('wpPostMetas');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_wp_post_meta(): void
    {
        $response = $this->get(route('wp-post-metas.create'));

        $response->assertOk()->assertViewIs('app.wp_post_metas.create');
    }

    /**
     * @test
     */
    public function it_stores_the_wp_post_meta(): void
    {
        $data = WpPostMeta::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('wp-post-metas.store'), $data);

        $this->assertDatabaseHas('wp_postmeta', $data);

        $wpPostMeta = WpPostMeta::latest('meta_id')->first();

        $response->assertRedirect(route('wp-post-metas.edit', $wpPostMeta));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_wp_post_meta(): void
    {
        $wpPostMeta = WpPostMeta::factory()->create();

        $response = $this->get(route('wp-post-metas.show', $wpPostMeta));

        $response
            ->assertOk()
            ->assertViewIs('app.wp_post_metas.show')
            ->assertViewHas('wpPostMeta');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_wp_post_meta(): void
    {
        $wpPostMeta = WpPostMeta::factory()->create();

        $response = $this->get(route('wp-post-metas.edit', $wpPostMeta));

        $response
            ->assertOk()
            ->assertViewIs('app.wp_post_metas.edit')
            ->assertViewHas('wpPostMeta');
    }

    /**
     * @test
     */
    public function it_updates_the_wp_post_meta(): void
    {
        $wpPostMeta = WpPostMeta::factory()->create();

        $data = [
            'post_id' => $this->faker->randomNumber(),
            'meta_key' => $this->faker->text(255),
            'meta_value' => $this->faker->text(),
        ];

        $response = $this->put(
            route('wp-post-metas.update', $wpPostMeta),
            $data
        );

        $data['meta_id'] = $wpPostMeta->meta_id;

        $this->assertDatabaseHas('wp_postmeta', $data);

        $response->assertRedirect(route('wp-post-metas.edit', $wpPostMeta));
    }

    /**
     * @test
     */
    public function it_deletes_the_wp_post_meta(): void
    {
        $wpPostMeta = WpPostMeta::factory()->create();

        $response = $this->delete(route('wp-post-metas.destroy', $wpPostMeta));

        $response->assertRedirect(route('wp-post-metas.index'));

        $this->assertModelMissing($wpPostMeta);
    }
}
