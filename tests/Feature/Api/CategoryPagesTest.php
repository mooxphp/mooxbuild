<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Page;
use App\Models\Category;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryPagesTest extends TestCase
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
    public function it_gets_category_pages(): void
    {
        $category = Category::factory()->create();
        $pages = Page::factory()
            ->count(2)
            ->create([
                'main_category_id' => $category->id,
            ]);

        $response = $this->getJson(
            route('api.categories.pages.index', $category)
        );

        $response->assertOk()->assertSee($pages[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_category_pages(): void
    {
        $category = Category::factory()->create();
        $data = Page::factory()
            ->make([
                'main_category_id' => $category->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.categories.pages.store', $category),
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

        $this->assertDatabaseHas('pages', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $page = Page::latest('id')->first();

        $this->assertEquals($category->id, $page->main_category_id);
    }
}
