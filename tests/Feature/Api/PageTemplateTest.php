<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\PageTemplate;

use App\Models\Page;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PageTemplateTest extends TestCase
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
    public function it_gets_page_templates_list(): void
    {
        $pageTemplates = PageTemplate::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.page-templates.index'));

        $response->assertOk()->assertSee($pageTemplates[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_page_template(): void
    {
        $data = PageTemplate::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.page-templates.store'), $data);

        $this->assertDatabaseHas('page_templates', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_page_template(): void
    {
        $pageTemplate = PageTemplate::factory()->create();

        $page = Page::factory()->create();

        $data = [
            'page_id' => $page->id,
        ];

        $response = $this->putJson(
            route('api.page-templates.update', $pageTemplate),
            $data
        );

        $data['id'] = $pageTemplate->id;

        $this->assertDatabaseHas('page_templates', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_page_template(): void
    {
        $pageTemplate = PageTemplate::factory()->create();

        $response = $this->deleteJson(
            route('api.page-templates.destroy', $pageTemplate)
        );

        $this->assertModelMissing($pageTemplate);

        $response->assertNoContent();
    }
}
