<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Comment;

use App\Models\Author;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentTest extends TestCase
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
    public function it_gets_comments_list(): void
    {
        $comments = Comment::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.comments.index'));

        $response->assertOk()->assertSee($comments[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_comment(): void
    {
        $data = Comment::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.comments.store'), $data);

        $this->assertDatabaseHas('comments', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_comment(): void
    {
        $comment = Comment::factory()->create();

        $comment = Comment::factory()->create();
        $author = Author::factory()->create();

        $data = [
            'title' => $this->faker->sentence(10),
            'slug' => $this->faker->slug(),
            'content' => $this->faker->text(),
            'translations' => [],
            'is_from_author' => $this->faker->boolean(),
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'is_spam' => $this->faker->boolean(),
            'is_public' => $this->faker->boolean(),
            'parent_id' => $comment->id,
            'author_id' => $author->id,
        ];

        $response = $this->putJson(
            route('api.comments.update', $comment),
            $data
        );

        $data['id'] = $comment->id;

        $this->assertDatabaseHas('comments', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_comment(): void
    {
        $comment = Comment::factory()->create();

        $response = $this->deleteJson(route('api.comments.destroy', $comment));

        $this->assertSoftDeleted($comment);

        $response->assertNoContent();
    }
}
