<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\WpPostMeta;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WpPostMetaTest extends TestCase
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
    public function it_gets_wp_post_metas_list(): void
    {
        $wpPostMetas = WpPostMeta::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.wp-post-metas.index'));

        $response->assertOk()->assertSee($wpPostMetas[0]->meta_key);
    }

    /**
     * @test
     */
    public function it_stores_the_wp_post_meta(): void
    {
        $data = WpPostMeta::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.wp-post-metas.store'), $data);

        $this->assertDatabaseHas('wp_postmeta', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_wp_post_meta(): void
    {
        $wpPostMeta = WpPostMeta::factory()->create();

        $data = [
            'post_id' => $this->faker->randomNumber(),
            'meta_key' => $this->faker->text(255),
            'meta_value' => $this->faker->text(),
        ];

        $response = $this->putJson(
            route('api.wp-post-metas.update', $wpPostMeta),
            $data
        );

        $data['meta_id'] = $wpPostMeta->meta_id;

        $this->assertDatabaseHas('wp_postmeta', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_wp_post_meta(): void
    {
        $wpPostMeta = WpPostMeta::factory()->create();

        $response = $this->deleteJson(
            route('api.wp-post-metas.destroy', $wpPostMeta)
        );

        $this->assertModelMissing($wpPostMeta);

        $response->assertNoContent();
    }
}
