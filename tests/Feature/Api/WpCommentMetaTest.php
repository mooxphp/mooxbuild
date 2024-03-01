<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\WpCommentMeta;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WpCommentMetaTest extends TestCase
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
    public function it_gets_wp_comment_metas_list(): void
    {
        $wpCommentMetas = WpCommentMeta::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.wp-comment-metas.index'));

        $response->assertOk()->assertSee($wpCommentMetas[0]->meta_key);
    }

    /**
     * @test
     */
    public function it_stores_the_wp_comment_meta(): void
    {
        $data = WpCommentMeta::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.wp-comment-metas.store'), $data);

        $this->assertDatabaseHas('wp_commentmeta', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_wp_comment_meta(): void
    {
        $wpCommentMeta = WpCommentMeta::factory()->create();

        $data = [
            'comment_id' => $this->faker->randomNumber(),
            'meta_key' => $this->faker->text(255),
            'meta_value' => $this->faker->text(),
        ];

        $response = $this->putJson(
            route('api.wp-comment-metas.update', $wpCommentMeta),
            $data
        );

        $data['meta_id'] = $wpCommentMeta->meta_id;

        $this->assertDatabaseHas('wp_commentmeta', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_wp_comment_meta(): void
    {
        $wpCommentMeta = WpCommentMeta::factory()->create();

        $response = $this->deleteJson(
            route('api.wp-comment-metas.destroy', $wpCommentMeta)
        );

        $this->assertModelMissing($wpCommentMeta);

        $response->assertNoContent();
    }
}
