<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\ContentElement;

use App\Models\Theme;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContentElementTest extends TestCase
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
    public function it_gets_content_elements_list(): void
    {
        $contentElements = ContentElement::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.content-elements.index'));

        $response->assertOk()->assertSee($contentElements[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_content_element(): void
    {
        $data = ContentElement::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.content-elements.store'), $data);

        $this->assertDatabaseHas('content_elements', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.content-elements.update', $contentElement),
            $data
        );

        $data['id'] = $contentElement->id;

        $this->assertDatabaseHas('content_elements', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_content_element(): void
    {
        $contentElement = ContentElement::factory()->create();

        $response = $this->deleteJson(
            route('api.content-elements.destroy', $contentElement)
        );

        $this->assertModelMissing($contentElement);

        $response->assertNoContent();
    }
}
