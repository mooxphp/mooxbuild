<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\WpCommentMeta;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WpCommentMetaControllerTest extends TestCase
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
    public function it_displays_index_view_with_wp_comment_metas(): void
    {
        $wpCommentMetas = WpCommentMeta::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('wp-comment-metas.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.wp_comment_metas.index')
            ->assertViewHas('wpCommentMetas');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_wp_comment_meta(): void
    {
        $response = $this->get(route('wp-comment-metas.create'));

        $response->assertOk()->assertViewIs('app.wp_comment_metas.create');
    }

    /**
     * @test
     */
    public function it_stores_the_wp_comment_meta(): void
    {
        $data = WpCommentMeta::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('wp-comment-metas.store'), $data);

        $this->assertDatabaseHas('wp_commentmeta', $data);

        $wpCommentMeta = WpCommentMeta::latest('meta_id')->first();

        $response->assertRedirect(
            route('wp-comment-metas.edit', $wpCommentMeta)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_wp_comment_meta(): void
    {
        $wpCommentMeta = WpCommentMeta::factory()->create();

        $response = $this->get(route('wp-comment-metas.show', $wpCommentMeta));

        $response
            ->assertOk()
            ->assertViewIs('app.wp_comment_metas.show')
            ->assertViewHas('wpCommentMeta');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_wp_comment_meta(): void
    {
        $wpCommentMeta = WpCommentMeta::factory()->create();

        $response = $this->get(route('wp-comment-metas.edit', $wpCommentMeta));

        $response
            ->assertOk()
            ->assertViewIs('app.wp_comment_metas.edit')
            ->assertViewHas('wpCommentMeta');
    }

    /**
     * @test
     */
    public function it_updates_the_wp_comment_meta(): void
    {
        $wpCommentMeta = WpCommentMeta::factory()->create();

        $data = [
            'comment_id' => $this->faker->randomNumber(),
            'meta_key' => $this->faker->text(255),
            'meta_value' => $this->faker->text(),
        ];

        $response = $this->put(
            route('wp-comment-metas.update', $wpCommentMeta),
            $data
        );

        $data['meta_id'] = $wpCommentMeta->meta_id;

        $this->assertDatabaseHas('wp_commentmeta', $data);

        $response->assertRedirect(
            route('wp-comment-metas.edit', $wpCommentMeta)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_wp_comment_meta(): void
    {
        $wpCommentMeta = WpCommentMeta::factory()->create();

        $response = $this->delete(
            route('wp-comment-metas.destroy', $wpCommentMeta)
        );

        $response->assertRedirect(route('wp-comment-metas.index'));

        $this->assertModelMissing($wpCommentMeta);
    }
}
