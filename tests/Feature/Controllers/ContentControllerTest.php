<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Content;

use App\Models\ContentElement;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContentControllerTest extends TestCase
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
    public function it_displays_index_view_with_contents(): void
    {
        $contents = Content::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('contents.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.contents.index')
            ->assertViewHas('contents');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_content(): void
    {
        $response = $this->get(route('contents.create'));

        $response->assertOk()->assertViewIs('app.contents.create');
    }

    /**
     * @test
     */
    public function it_stores_the_content(): void
    {
        $data = Content::factory()
            ->make()
            ->toArray();

        $data['data'] = json_encode($data['data']);
        $data['settings'] = json_encode($data['settings']);

        $response = $this->post(route('contents.store'), $data);

        $data['data'] = $this->castToJson($data['data']);
        $data['settings'] = $this->castToJson($data['settings']);

        $this->assertDatabaseHas('contents', $data);

        $content = Content::latest('id')->first();

        $response->assertRedirect(route('contents.edit', $content));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_content(): void
    {
        $content = Content::factory()->create();

        $response = $this->get(route('contents.show', $content));

        $response
            ->assertOk()
            ->assertViewIs('app.contents.show')
            ->assertViewHas('content');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_content(): void
    {
        $content = Content::factory()->create();

        $response = $this->get(route('contents.edit', $content));

        $response
            ->assertOk()
            ->assertViewIs('app.contents.edit')
            ->assertViewHas('content');
    }

    /**
     * @test
     */
    public function it_updates_the_content(): void
    {
        $content = Content::factory()->create();

        $contentElement = ContentElement::factory()->create();

        $data = [
            'title' => $this->faker->sentence(10),
            'slug' => $this->faker->slug(),
            'data' => [],
            'settings' => [],
            'content_element_id' => $contentElement->id,
        ];

        $data['data'] = json_encode($data['data']);
        $data['settings'] = json_encode($data['settings']);

        $response = $this->put(route('contents.update', $content), $data);

        $data['id'] = $content->id;

        $data['data'] = $this->castToJson($data['data']);
        $data['settings'] = $this->castToJson($data['settings']);

        $this->assertDatabaseHas('contents', $data);

        $response->assertRedirect(route('contents.edit', $content));
    }

    /**
     * @test
     */
    public function it_deletes_the_content(): void
    {
        $content = Content::factory()->create();

        $response = $this->delete(route('contents.destroy', $content));

        $response->assertRedirect(route('contents.index'));

        $this->assertModelMissing($content);
    }
}
