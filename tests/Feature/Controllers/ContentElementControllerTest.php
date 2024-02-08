<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\ContentElement;

use App\Models\Theme;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContentElementControllerTest extends TestCase
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
    public function it_displays_index_view_with_content_elements(): void
    {
        $contentElements = ContentElement::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('content-elements.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.content_elements.index')
            ->assertViewHas('contentElements');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_content_element(): void
    {
        $response = $this->get(route('content-elements.create'));

        $response->assertOk()->assertViewIs('app.content_elements.create');
    }

    /**
     * @test
     */
    public function it_stores_the_content_element(): void
    {
        $data = ContentElement::factory()
            ->make()
            ->toArray();

        $data['data_structure'] = json_encode($data['data_structure']);

        $response = $this->post(route('content-elements.store'), $data);

        $data['data_structure'] = $this->castToJson($data['data_structure']);

        $this->assertDatabaseHas('content_elements', $data);

        $contentElement = ContentElement::latest('id')->first();

        $response->assertRedirect(
            route('content-elements.edit', $contentElement)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_content_element(): void
    {
        $contentElement = ContentElement::factory()->create();

        $response = $this->get(route('content-elements.show', $contentElement));

        $response
            ->assertOk()
            ->assertViewIs('app.content_elements.show')
            ->assertViewHas('contentElement');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_content_element(): void
    {
        $contentElement = ContentElement::factory()->create();

        $response = $this->get(route('content-elements.edit', $contentElement));

        $response
            ->assertOk()
            ->assertViewIs('app.content_elements.edit')
            ->assertViewHas('contentElement');
    }

    /**
     * @test
     */
    public function it_updates_the_content_element(): void
    {
        $contentElement = ContentElement::factory()->create();

        $theme = Theme::factory()->create();

        $data = [
            'title' => $this->faker->sentence(10),
            'slug' => $this->faker->slug(),
            'description' => $this->faker->text(),
            'data_structure' => [],
            'template' => $this->faker->text(),
            'component' => $this->faker->text(255),
            'theme_id' => $theme->id,
        ];

        $data['data_structure'] = json_encode($data['data_structure']);

        $response = $this->put(
            route('content-elements.update', $contentElement),
            $data
        );

        $data['id'] = $contentElement->id;

        $data['data_structure'] = $this->castToJson($data['data_structure']);

        $this->assertDatabaseHas('content_elements', $data);

        $response->assertRedirect(
            route('content-elements.edit', $contentElement)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_content_element(): void
    {
        $contentElement = ContentElement::factory()->create();

        $response = $this->delete(
            route('content-elements.destroy', $contentElement)
        );

        $response->assertRedirect(route('content-elements.index'));

        $this->assertModelMissing($contentElement);
    }
}
