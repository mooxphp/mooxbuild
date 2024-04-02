<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Page;

use App\Models\Author;
use App\Models\Category;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PageTest extends TestCase
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
    public function it_gets_pages_list(): void
    {
        $pages = Page::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.pages.index'));

        $response->assertOk()->assertSee($pages[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_page(): void
    {
        $data = Page::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.pages.store'), $data);

        $this->assertDatabaseHas('pages', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_page(): void
    {
        $page = Page::factory()->create();

        $author = Author::factory()->create();
        $category = Category::factory()->create();
        $page = Page::factory()->create();

        $data = [
            'uid' => $this->faker->randomNumber(),
            'title' => $this->faker->sentence(10),
            'slug' => $this->faker->slug(),
            'short' => $this->faker->text(),
            'content' => $this->faker->text(),
            'data' => [],
            'created_by_user_id' => $this->faker->text(255),
            'created_by_user_name' => $this->faker->text(255),
            'edited_by_user_id' => $this->faker->text(255),
            'edited_by_user_name' => $this->faker->text(255),
            'published_at' => $this->faker->dateTime(),
            'author_id' => $author->id,
            'main_category_id' => $category->id,
            'translation_id' => $page->id,
        ];

        $response = $this->putJson(route('api.pages.update', $page), $data);

        $data['id'] = $page->id;

        $this->assertDatabaseHas('pages', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_page(): void
    {
        $page = Page::factory()->create();

        $response = $this->deleteJson(route('api.pages.destroy', $page));

        $this->assertSoftDeleted($page);

        $response->assertNoContent();
    }
}
