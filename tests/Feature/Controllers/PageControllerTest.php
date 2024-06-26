<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Page;

use App\Models\Author;
use App\Models\Category;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PageControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    protected function castToJson($json)
    {
        if (is_array($json)) {
            $json = addslashes(json_encode($json));
        } elseif (is_null($json) || is_null(json_decode($json))) {
            throw new \Exception(
                'A valid JSON string was not provided for casting.'
            );
        }

        return \DB::raw("CAST('{$json}' AS JSON)");
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_pages(): void
    {
        $pages = Page::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('pages.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.pages.index')
            ->assertViewHas('pages');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_page(): void
    {
        $response = $this->get(route('pages.create'));

        $response->assertOk()->assertViewIs('app.pages.create');
    }

    /**
     * @test
     */
    public function it_stores_the_page(): void
    {
        $data = Page::factory()
            ->make()
            ->toArray();

        $data['data'] = json_encode($data['data']);

        $response = $this->post(route('pages.store'), $data);

        $data['data'] = $this->castToJson($data['data']);

        $this->assertDatabaseHas('pages', $data);

        $page = Page::latest('id')->first();

        $response->assertRedirect(route('pages.edit', $page));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_page(): void
    {
        $page = Page::factory()->create();

        $response = $this->get(route('pages.show', $page));

        $response
            ->assertOk()
            ->assertViewIs('app.pages.show')
            ->assertViewHas('page');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_page(): void
    {
        $page = Page::factory()->create();

        $response = $this->get(route('pages.edit', $page));

        $response
            ->assertOk()
            ->assertViewIs('app.pages.edit')
            ->assertViewHas('page');
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

        $data['data'] = json_encode($data['data']);

        $response = $this->put(route('pages.update', $page), $data);

        $data['id'] = $page->id;

        $data['data'] = $this->castToJson($data['data']);

        $this->assertDatabaseHas('pages', $data);

        $response->assertRedirect(route('pages.edit', $page));
    }

    /**
     * @test
     */
    public function it_deletes_the_page(): void
    {
        $page = Page::factory()->create();

        $response = $this->delete(route('pages.destroy', $page));

        $response->assertRedirect(route('pages.index'));

        $this->assertSoftDeleted($page);
    }
}
