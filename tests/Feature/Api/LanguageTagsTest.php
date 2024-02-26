<?php

namespace Tests\Feature\Api;

use App\Models\Tag;
use App\Models\User;
use App\Models\Language;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LanguageTagsTest extends TestCase
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
    public function it_gets_language_tags(): void
    {
        $language = Language::factory()->create();
        $tags = Tag::factory()
            ->count(2)
            ->create([
                'language_id' => $language->id,
            ]);

        $response = $this->getJson(
            route('api.languages.tags.index', $language)
        );

        $response->assertOk()->assertSee($tags[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_language_tags(): void
    {
        $language = Language::factory()->create();
        $data = Tag::factory()
            ->make([
                'language_id' => $language->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.languages.tags.store', $language),
            $data
        );

        $this->assertDatabaseHas('tags', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $tag = Tag::latest('id')->first();

        $this->assertEquals($language->id, $tag->language_id);
    }
}
