<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Content;

use App\Models\ContentElement;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContentTest extends TestCase
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
    public function it_gets_contents_list(): void
    {
        $contents = Content::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.contents.index'));

        $response->assertOk()->assertSee($contents[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_content(): void
    {
        $data = Content::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.contents.store'), $data);

        $this->assertDatabaseHas('contents', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.contents.update', $content),
            $data
        );

        $data['id'] = $content->id;

        $this->assertDatabaseHas('contents', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_content(): void
    {
        $content = Content::factory()->create();

        $response = $this->deleteJson(route('api.contents.destroy', $content));

        $this->assertModelMissing($content);

        $response->assertNoContent();
    }
}
