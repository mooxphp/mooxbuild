<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\PageTemplate;

use App\Models\Page;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PageTemplateControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_page_templates(): void
    {
        $pageTemplates = PageTemplate::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('page-templates.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.page_templates.index')
            ->assertViewHas('pageTemplates');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_page_template(): void
    {
        $response = $this->get(route('page-templates.create'));

        $response->assertOk()->assertViewIs('app.page_templates.create');
    }

    /**
     * @test
     */
    public function it_stores_the_page_template(): void
    {
        $data = PageTemplate::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('page-templates.store'), $data);

        $this->assertDatabaseHas('page_templates', $data);

        $pageTemplate = PageTemplate::latest('id')->first();

        $response->assertRedirect(route('page-templates.edit', $pageTemplate));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_page_template(): void
    {
        $pageTemplate = PageTemplate::factory()->create();

        $response = $this->get(route('page-templates.show', $pageTemplate));

        $response
            ->assertOk()
            ->assertViewIs('app.page_templates.show')
            ->assertViewHas('pageTemplate');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_page_template(): void
    {
        $pageTemplate = PageTemplate::factory()->create();

        $response = $this->get(route('page-templates.edit', $pageTemplate));

        $response
            ->assertOk()
            ->assertViewIs('app.page_templates.edit')
            ->assertViewHas('pageTemplate');
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

        $response = $this->put(
            route('page-templates.update', $pageTemplate),
            $data
        );

        $data['id'] = $pageTemplate->id;

        $this->assertDatabaseHas('page_templates', $data);

        $response->assertRedirect(route('page-templates.edit', $pageTemplate));
    }

    /**
     * @test
     */
    public function it_deletes_the_page_template(): void
    {
        $pageTemplate = PageTemplate::factory()->create();

        $response = $this->delete(
            route('page-templates.destroy', $pageTemplate)
        );

        $response->assertRedirect(route('page-templates.index'));

        $this->assertModelMissing($pageTemplate);
    }
}
