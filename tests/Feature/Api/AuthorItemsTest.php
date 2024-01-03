<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Item;
use App\Models\Author;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthorItemsTest extends TestCase
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
    public function it_gets_author_items(): void
    {
        $author = Author::factory()->create();
        $items = Item::factory()
            ->count(2)
            ->create([
                'author_id' => $author->id,
            ]);

        $response = $this->getJson(route('api.authors.items.index', $author));

        $response->assertOk()->assertSee($items[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_author_items(): void
    {
        $author = Author::factory()->create();
        $data = Item::factory()
            ->make([
                'author_id' => $author->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.authors.items.store', $author),
            $data
        );

        $this->assertDatabaseHas('items', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $item = Item::latest('id')->first();

        $this->assertEquals($author->id, $item->author_id);
    }
}
