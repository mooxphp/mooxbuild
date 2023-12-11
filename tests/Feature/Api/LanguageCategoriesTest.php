<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Language;
use App\Models\Category;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LanguageCategoriesTest extends TestCase
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
    public function it_gets_language_categories(): void
    {
        $language = Language::factory()->create();
        $categories = Category::factory()
            ->count(2)
            ->create([
                'language_id' => $language->id,
            ]);

        $response = $this->getJson(
            route('api.languages.categories.index', $language)
        );

        $response->assertOk()->assertSee($categories[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_language_categories(): void
    {
        $language = Language::factory()->create();
        $data = Category::factory()
            ->make([
                'language_id' => $language->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.languages.categories.store', $language),
            $data
        );

        $this->assertDatabaseHas('categories', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $category = Category::latest('id')->first();

        $this->assertEquals($language->id, $category->language_id);
    }
}
