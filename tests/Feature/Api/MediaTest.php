<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Media;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MediaTest extends TestCase
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
    public function it_gets_media_list(): void
    {
        $media = Media::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.media.index'));

        $response->assertOk()->assertSee($media[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_media(): void
    {
        $data = Media::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.media.store'), $data);

        $this->assertDatabaseHas('media', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(route('api.media.update', $media), $data);

        $data['id'] = $media->id;

        $this->assertDatabaseHas('media', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_media(): void
    {
        $media = Media::factory()->create();

        $response = $this->deleteJson(route('api.media.destroy', $media));

        $this->assertModelMissing($media);

        $response->assertNoContent();
    }
}
