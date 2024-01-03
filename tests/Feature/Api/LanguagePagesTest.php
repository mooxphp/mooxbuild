<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Page;
use App\Models\Language;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LanguagePagesTest extends TestCase
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
    public function it_gets_language_pages(): void
    {
        $language = Language::factory()->create();
        $pages = Page::factory()
            ->count(2)
            ->create([
                'language_id' => $language->id,
            ]);

        $response = $this->getJson(
            route('api.languages.pages.index', $language)
        );

        $response->assertOk()->assertSee($pages[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_language_pages(): void
    {
        $language = Language::factory()->create();
        $data = Page::factory()
            ->make([
                'language_id' => $language->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.languages.pages.store', $language),
            $data
        );

        $this->assertDatabaseHas('pages', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $page = Page::latest('id')->first();

        $this->assertEquals($language->id, $page->language_id);
    }
}
