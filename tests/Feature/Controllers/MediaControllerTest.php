<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Media;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MediaControllerTest extends TestCase
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
    public function it_displays_index_view_with_media(): void
    {
        $media = Media::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('media.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.media.index')
            ->assertViewHas('media');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_media(): void
    {
        $response = $this->get(route('media.create'));

        $response->assertOk()->assertViewIs('app.media.create');
    }

    /**
     * @test
     */
    public function it_stores_the_media(): void
    {
        $data = Media::factory()
            ->make()
            ->toArray();

        $data['manipulations'] = json_encode($data['manipulations']);
        $data['custom_properties'] = json_encode($data['custom_properties']);
        $data['generated_conversions'] = json_encode(
            $data['generated_conversions']
        );
        $data['responsive_images'] = json_encode($data['responsive_images']);

        $response = $this->post(route('media.store'), $data);

        $data['manipulations'] = $this->castToJson($data['manipulations']);
        $data['custom_properties'] = $this->castToJson(
            $data['custom_properties']
        );
        $data['generated_conversions'] = $this->castToJson(
            $data['generated_conversions']
        );
        $data['responsive_images'] = $this->castToJson(
            $data['responsive_images']
        );

        $this->assertDatabaseHas('media', $data);

        $media = Media::latest('id')->first();

        $response->assertRedirect(route('media.edit', $media));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_media(): void
    {
        $media = Media::factory()->create();

        $response = $this->get(route('media.show', $media));

        $response
            ->assertOk()
            ->assertViewIs('app.media.show')
            ->assertViewHas('media');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_media(): void
    {
        $media = Media::factory()->create();

        $response = $this->get(route('media.edit', $media));

        $response
            ->assertOk()
            ->assertViewIs('app.media.edit')
            ->assertViewHas('media');
    }

    /**
     * @test
     */
    public function it_updates_the_media(): void
    {
        $media = Media::factory()->create();

        $data = [
            'uuid' => $this->faker->unique->uuid(),
            'collection_name' => $this->faker->text(255),
            'name' => $this->faker->name(),
            'file_name' => $this->faker->text(255),
            'mime_type' => $this->faker->text(255),
            'disk' => 'public',
            'conversions_disk' => $this->faker->text(255),
            'size' => $this->faker->randomNumber(),
            'manipulations' => [],
            'custom_properties' => [],
            'generated_conversions' => [],
            'responsive_images' => [],
            'order_column' => $this->faker->randomNumber(),
        ];

        $data['manipulations'] = json_encode($data['manipulations']);
        $data['custom_properties'] = json_encode($data['custom_properties']);
        $data['generated_conversions'] = json_encode(
            $data['generated_conversions']
        );
        $data['responsive_images'] = json_encode($data['responsive_images']);

        $response = $this->put(route('media.update', $media), $data);

        $data['id'] = $media->id;

        $data['manipulations'] = $this->castToJson($data['manipulations']);
        $data['custom_properties'] = $this->castToJson(
            $data['custom_properties']
        );
        $data['generated_conversions'] = $this->castToJson(
            $data['generated_conversions']
        );
        $data['responsive_images'] = $this->castToJson(
            $data['responsive_images']
        );

        $this->assertDatabaseHas('media', $data);

        $response->assertRedirect(route('media.edit', $media));
    }

    /**
     * @test
     */
    public function it_deletes_the_media(): void
    {
        $media = Media::factory()->create();

        $response = $this->delete(route('media.destroy', $media));

        $response->assertRedirect(route('media.index'));

        $this->assertModelMissing($media);
    }
}
