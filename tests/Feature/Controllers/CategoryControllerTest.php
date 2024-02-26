<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Category;

use App\Models\Language;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryControllerTest extends TestCase
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
    public function it_displays_index_view_with_categories(): void
    {
        $categories = Category::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('categories.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.categories.index')
            ->assertViewHas('categories');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_category(): void
    {
        $response = $this->get(route('categories.create'));

        $response->assertOk()->assertViewIs('app.categories.create');
    }

    /**
     * @test
     */
    public function it_stores_the_category(): void
    {
        $data = Category::factory()
            ->make()
            ->toArray();

        $data['data'] = json_encode($data['data']);

        $response = $this->post(route('categories.store'), $data);

        $data['data'] = $this->castToJson($data['data']);

        $this->assertDatabaseHas('categories', $data);

        $category = Category::latest('id')->first();

        $response->assertRedirect(route('categories.edit', $category));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_category(): void
    {
        $category = Category::factory()->create();

        $response = $this->get(route('categories.show', $category));

        $response
            ->assertOk()
            ->assertViewIs('app.categories.show')
            ->assertViewHas('category');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_category(): void
    {
        $category = Category::factory()->create();

        $response = $this->get(route('categories.edit', $category));

        $response
            ->assertOk()
            ->assertViewIs('app.categories.edit')
            ->assertViewHas('category');
    }

    /**
     * @test
     */
    public function it_updates_the_category(): void
    {
        $category = Category::factory()->create();

        $category = Category::factory()->create();
        $language = Language::factory()->create();

        $data = [
            'uid' => $this->faker->randomNumber(),
            'title' => $this->faker->sentence(10),
            'slug' => $this->faker->slug(),
            'content' => $this->faker->text(),
            'data' => [],
            'model' => $this->faker->text(255),
            ' created_by_user_id' => $this->faker->text(255),
            'created_by_user_name' => $this->faker->text(255),
            'edited_by_user_id' => $this->faker->text(255),
            'edited_by_user_name' => $this->faker->text(255),
            'published_at' => $this->faker->dateTime(),
            'translation_id' => $category->id,
            'language_id' => $language->id,
        ];

        $data['data'] = json_encode($data['data']);

        $response = $this->put(route('categories.update', $category), $data);

        $data['id'] = $category->id;

        $data['data'] = $this->castToJson($data['data']);

        $this->assertDatabaseHas('categories', $data);

        $response->assertRedirect(route('categories.edit', $category));
    }

    /**
     * @test
     */
    public function it_deletes_the_category(): void
    {
        $category = Category::factory()->create();

        $response = $this->delete(route('categories.destroy', $category));

        $response->assertRedirect(route('categories.index'));

        $this->assertSoftDeleted($category);
    }
}
