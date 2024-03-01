<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\WpComment;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WpCommentTest extends TestCase
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
    public function it_gets_wp_comments_list(): void
    {
        $wpComments = WpComment::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.wp-comments.index'));

        $response->assertOk()->assertSee($wpComments[0]->comment_author);
    }

    /**
     * @test
     */
    public function it_stores_the_wp_comment(): void
    {
        $data = WpComment::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.wp-comments.store'), $data);

        $this->assertDatabaseHas('wp_comments', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.wp-comments.update', $wpComment),
            $data
        );

        $data['comment_ID'] = $wpComment->comment_ID;

        $this->assertDatabaseHas('wp_comments', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_wp_comment(): void
    {
        $wpComment = WpComment::factory()->create();

        $response = $this->deleteJson(
            route('api.wp-comments.destroy', $wpComment)
        );

        $this->assertModelMissing($wpComment);

        $response->assertNoContent();
    }
}
