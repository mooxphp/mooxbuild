<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Page;
use App\Models\PageTemplate;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PagePageTemplatesTest extends TestCase
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
    public function it_gets_page_page_templates(): void
    {
        $page = Page::factory()->create();
        $pageTemplates = PageTemplate::factory()
            ->count(2)
            ->create([
                'page_id' => $page->id,
            ]);

        $response = $this->getJson(
            route('api.pages.page-templates.index', $page)
        );

        $response->assertOk()->assertSee($pageTemplates[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_page_page_templates(): void
    {
        $page = Page::factory()->create();
        $data = PageTemplate::factory()
            ->make([
                'page_id' => $page->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.pages.page-templates.store', $page),
            $data
        );

        $this->assertDatabaseHas('page_templates', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $pageTemplate = PageTemplate::latest('id')->first();

        $this->assertEquals($page->id, $pageTemplate->page_id);
    }
}
