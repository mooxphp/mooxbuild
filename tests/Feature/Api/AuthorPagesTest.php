<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Page;
use App\Models\Author;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthorPagesTest extends TestCase
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
    public function it_gets_author_pages(): void
    {
        $author = Author::factory()->create();
        $pages = Page::factory()
            ->count(2)
            ->create([
                'author_id' => $author->id,
            ]);

        $response = $this->getJson(route('api.authors.pages.index', $author));

        $response->assertOk()->assertSee($pages[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_author_pages(): void
    {
        $author = Author::factory()->create();
        $data = Page::factory()
            ->make([
                'author_id' => $author->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.authors.pages.store', $author),
            $data
        );

        $this->assertDatabaseHas('pages', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $page = Page::latest('id')->first();

        $this->assertEquals($author->id, $page->author_id);
    }
}
