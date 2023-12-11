<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Item;
use App\Models\Category;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryItemsTest extends TestCase
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
    public function it_gets_category_items(): void
    {
        $category = Category::factory()->create();
        $items = Item::factory()
            ->count(2)
            ->create([
                'main_category_id' => $category->id,
            ]);

        $response = $this->getJson(
            route('api.categories.items.index', $category)
        );

        $response->assertOk()->assertSee($items[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_category_items(): void
    {
        $category = Category::factory()->create();
        $data = Item::factory()
            ->make([
                'main_category_id' => $category->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.categories.items.store', $category),
            $data
        );

        unset($data['uid']);
        unset($data['main_category_id']);
        unset($data['title']);
        unset($data['slug']);
        unset($data['short']);
        unset($data['content']);
        unset($data['data']);
        unset($data['image']);
        unset($data['thumbnail']);
        unset($data['author_id']);
        unset($data['language_id']);
        unset($data['translation_id']);

        $this->assertDatabaseHas('items', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $item = Item::latest('id')->first();

        $this->assertEquals($category->id, $item->main_category_id);
    }
}
