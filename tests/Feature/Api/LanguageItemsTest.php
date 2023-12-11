<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Item;
use App\Models\Language;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LanguageItemsTest extends TestCase
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
    public function it_gets_language_items(): void
    {
        $language = Language::factory()->create();
        $items = Item::factory()
            ->count(2)
            ->create([
                'language_id' => $language->id,
            ]);

        $response = $this->getJson(
            route('api.languages.items.index', $language)
        );

        $response->assertOk()->assertSee($items[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_language_items(): void
    {
        $language = Language::factory()->create();
        $data = Item::factory()
            ->make([
                'language_id' => $language->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.languages.items.store', $language),
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

        $this->assertEquals($language->id, $item->language_id);
    }
}
