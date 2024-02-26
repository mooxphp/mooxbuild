<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Post;
use App\Models\Author;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthorPostsTest extends TestCase
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
    public function it_gets_author_posts(): void
    {
        $author = Author::factory()->create();
        $posts = Post::factory()
            ->count(2)
            ->create([
                'author_id' => $author->id,
            ]);

        $response = $this->getJson(route('api.authors.posts.index', $author));

        $response->assertOk()->assertSee($posts[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_author_posts(): void
    {
        $author = Author::factory()->create();
        $data = Post::factory()
            ->make([
                'author_id' => $author->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.authors.posts.store', $author),
            $data
        );

        $this->assertDatabaseHas('posts', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $post = Post::latest('id')->first();

        $this->assertEquals($author->id, $post->author_id);
    }
}
