<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\WpComment;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WpCommentControllerTest extends TestCase
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
    public function it_displays_index_view_with_wp_comments(): void
    {
        $wpComments = WpComment::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('wp-comments.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.wp_comments.index')
            ->assertViewHas('wpComments');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_wp_comment(): void
    {
        $response = $this->get(route('wp-comments.create'));

        $response->assertOk()->assertViewIs('app.wp_comments.create');
    }

    /**
     * @test
     */
    public function it_stores_the_wp_comment(): void
    {
        $data = WpComment::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('wp-comments.store'), $data);

        $this->assertDatabaseHas('wp_comments', $data);

        $wpComment = WpComment::latest('comment_ID')->first();

        $response->assertRedirect(route('wp-comments.edit', $wpComment));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_wp_comment(): void
    {
        $wpComment = WpComment::factory()->create();

        $response = $this->get(route('wp-comments.show', $wpComment));

        $response
            ->assertOk()
            ->assertViewIs('app.wp_comments.show')
            ->assertViewHas('wpComment');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_wp_comment(): void
    {
        $wpComment = WpComment::factory()->create();

        $response = $this->get(route('wp-comments.edit', $wpComment));

        $response
            ->assertOk()
            ->assertViewIs('app.wp_comments.edit')
            ->assertViewHas('wpComment');
    }

    /**
     * @test
     */
    public function it_updates_the_wp_comment(): void
    {
        $wpComment = WpComment::factory()->create();

        $data = [
            'comment_post_ID' => $this->faker->randomNumber(),
            'comment_author' => $this->faker->text(),
            'comment_author_email' => $this->faker->text(255),
            'comment_author_url' => $this->faker->text(255),
            'comment_author_IP' => $this->faker->text(255),
            'comment_date' => $this->faker->dateTime(),
            'comment_date_gmt' => $this->faker->dateTime(),
            'comment_content' => $this->faker->text(),
            'comment_karma' => $this->faker->randomNumber(0),
            'comment_approved' => $this->faker->text(255),
            'comment_agent' => $this->faker->text(255),
            'comment_type' => $this->faker->text(255),
            'comment_parent' => $this->faker->randomNumber(),
            'user_id' => $this->faker->randomNumber(),
        ];

        $response = $this->put(route('wp-comments.update', $wpComment), $data);

        $data['comment_ID'] = $wpComment->comment_ID;

        $this->assertDatabaseHas('wp_comments', $data);

        $response->assertRedirect(route('wp-comments.edit', $wpComment));
    }

    /**
     * @test
     */
    public function it_deletes_the_wp_comment(): void
    {
        $wpComment = WpComment::factory()->create();

        $response = $this->delete(route('wp-comments.destroy', $wpComment));

        $response->assertRedirect(route('wp-comments.index'));

        $this->assertModelMissing($wpComment);
    }
}
