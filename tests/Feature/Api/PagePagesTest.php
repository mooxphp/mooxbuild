<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Page;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PagePagesTest extends TestCase
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
    public function it_gets_page_pages(): void
    {
        $page = Page::factory()->create();
        $pages = Page::factory()
            ->count(2)
            ->create([
                'translation_id' => $page->id,
            ]);

        $response = $this->getJson(route('api.pages.pages.index', $page));

        $response->assertOk()->assertSee($pages[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_page_pages(): void
    {
        $page = Page::factory()->create();
        $data = Page::factory()
            ->make([
                'translation_id' => $page->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.pages.pages.store', $page),
            $data
        );

        $this->assertDatabaseHas('pages', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $page = Page::latest('id')->first();

        $this->assertEquals($page->id, $page->translation_id);
    }
}
