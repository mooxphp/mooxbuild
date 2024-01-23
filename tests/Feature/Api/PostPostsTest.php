<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Post;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostPostsTest extends TestCase
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
    public function it_gets_post_posts(): void
    {
        $post = Post::factory()->create();
        $posts = Post::factory()
            ->count(2)
            ->create([
                'translation_id' => $post->id,
            ]);

        $response = $this->getJson(route('api.posts.posts.index', $post));

        $response->assertOk()->assertSee($posts[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_post_posts(): void
    {
        $post = Post::factory()->create();
        $data = Post::factory()
            ->make([
                'translation_id' => $post->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.posts.posts.store', $post),
            $data
        );

        $this->assertDatabaseHas('posts', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $post = Post::latest('id')->first();

        $this->assertEquals($post->id, $post->translation_id);
    }
}
