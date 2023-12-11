<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Author;
use App\Models\Comment;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthorCommentsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_author_comments(): void
    {
        $author = Author::factory()->create();
        $comments = Comment::factory()
            ->count(2)
            ->create([
                'author_id' => $author->id,
            ]);

        $response = $this->getJson(
            route('api.authors.comments.index', $author)
        );

        $response->assertOk()->assertSee($comments[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_author_comments(): void
    {
        $author = Author::factory()->create();
        $data = Comment::factory()
            ->make([
                'author_id' => $author->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.authors.comments.store', $author),
            $data
        );

        $this->assertDatabaseHas('comments', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $comment = Comment::latest('id')->first();

        $this->assertEquals($author->id, $comment->author_id);
    }
}
