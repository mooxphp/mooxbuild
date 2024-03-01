<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\WpPost;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WpPostTest extends TestCase
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
    public function it_gets_wp_posts_list(): void
    {
        $wpPosts = WpPost::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.wp-posts.index'));

        $response->assertOk()->assertSee($wpPosts[0]->post_title);
    }

    /**
     * @test
     */
    public function it_stores_the_wp_post(): void
    {
        $data = WpPost::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.wp-posts.store'), $data);

        $this->assertDatabaseHas('wp_posts', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.wp-posts.update', $wpPost),
            $data
        );

        $data['ID'] = $wpPost->ID;

        $this->assertDatabaseHas('wp_posts', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_wp_post(): void
    {
        $wpPost = WpPost::factory()->create();

        $response = $this->deleteJson(route('api.wp-posts.destroy', $wpPost));

        $this->assertModelMissing($wpPost);

        $response->assertNoContent();
    }
}
