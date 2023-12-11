<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Category;

use App\Models\Language;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
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
    public function it_gets_categories_list(): void
    {
        $categories = Category::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.categories.index'));

        $response->assertOk()->assertSee($categories[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_category(): void
    {
        $data = Category::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.categories.store'), $data);

        $this->assertDatabaseHas('categories', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_category(): void
    {
        $category = Category::factory()->create();

        $language = Language::factory()->create();
        $category = Category::factory()->create();

        $data = [
            'uid' => $this->faker->randomNumber(),
            'title' => $this->faker->sentence(10),
            'slug' => $this->faker->slug(),
            'content' => $this->faker->text(),
            'data' => [],
            'model' => $this->faker->text(255),
            'language_id' => $language->id,
            'translation_id' => $category->id,
        ];

        $response = $this->putJson(
            route('api.categories.update', $category),
            $data
        );

        $data['id'] = $category->id;

        $this->assertDatabaseHas('categories', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_category(): void
    {
        $category = Category::factory()->create();

        $response = $this->deleteJson(
            route('api.categories.destroy', $category)
        );

        $this->assertSoftDeleted($category);

        $response->assertNoContent();
    }
}
