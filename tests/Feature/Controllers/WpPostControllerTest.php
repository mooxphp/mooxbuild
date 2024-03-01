<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\WpPost;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WpPostControllerTest extends TestCase
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
    public function it_displays_index_view_with_wp_posts(): void
    {
        $wpPosts = WpPost::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('wp-posts.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.wp_posts.index')
            ->assertViewHas('wpPosts');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_wp_post(): void
    {
        $response = $this->get(route('wp-posts.create'));

        $response->assertOk()->assertViewIs('app.wp_posts.create');
    }

    /**
     * @test
     */
    public function it_stores_the_wp_post(): void
    {
        $data = WpPost::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('wp-posts.store'), $data);

        $this->assertDatabaseHas('wp_posts', $data);

        $wpPost = WpPost::latest('ID')->first();

        $response->assertRedirect(route('wp-posts.edit', $wpPost));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_wp_post(): void
    {
        $wpPost = WpPost::factory()->create();

        $response = $this->get(route('wp-posts.show', $wpPost));

        $response
            ->assertOk()
            ->assertViewIs('app.wp_posts.show')
            ->assertViewHas('wpPost');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_wp_post(): void
    {
        $wpPost = WpPost::factory()->create();

        $response = $this->get(route('wp-posts.edit', $wpPost));

        $response
            ->assertOk()
            ->assertViewIs('app.wp_posts.edit')
            ->assertViewHas('wpPost');
    }

    /**
     * @test
     */
    public function it_updates_the_wp_post(): void
    {
        $wpPost = WpPost::factory()->create();

        $data = [
            'post_author' => $this->faker->randomNumber(),
            'post_date' => $this->faker->dateTime(),
            'post_date_gmt' => $this->faker->dateTime(),
            'post_content' => $this->faker->text(),
            'post_title' => $this->faker->text(),
            'post_excerpt' => $this->faker->text(),
            'post_status' => $this->faker->text(20),
            'comment_status' => $this->faker->text(20),
            'ping_status' => $this->faker->text(20),
            'post_password' => $this->faker->text(255),
            'post_name' => $this->faker->text(200),
            'to_ping' => $this->faker->text(),
            'pinged' => $this->faker->text(),
            'post_modified' => $this->faker->dateTime(),
            'post_modified_gmt' => $this->faker->dateTime(),
            'post_content_filtered' => $this->faker->text(),
            'post_parent' => $this->faker->randomNumber(),
            'guid' => $this->faker->text(255),
            'menu_order' => $this->faker->randomNumber(0),
            'post_type' => $this->faker->text(20),
            'post_mime_type' => $this->faker->text(100),
            'comment_count' => $this->faker->randomNumber(),
        ];

        $response = $this->put(route('wp-posts.update', $wpPost), $data);

        $data['ID'] = $wpPost->ID;

        $this->assertDatabaseHas('wp_posts', $data);

        $response->assertRedirect(route('wp-posts.edit', $wpPost));
    }

    /**
     * @test
     */
    public function it_deletes_the_wp_post(): void
    {
        $wpPost = WpPost::factory()->create();

        $response = $this->delete(route('wp-posts.destroy', $wpPost));

        $response->assertRedirect(route('wp-posts.index'));

        $this->assertModelMissing($wpPost);
    }
}
