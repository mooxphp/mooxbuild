<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\WpTermMeta;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WpTermMetaTest extends TestCase
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
    public function it_gets_wp_term_metas_list(): void
    {
        $wpTermMetas = WpTermMeta::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.wp-term-metas.index'));

        $response->assertOk()->assertSee($wpTermMetas[0]->meta_key);
    }

    /**
     * @test
     */
    public function it_stores_the_wp_term_meta(): void
    {
        $data = WpTermMeta::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.wp-term-metas.store'), $data);

        $this->assertDatabaseHas('wp_termmeta', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_wp_term_meta(): void
    {
        $wpTermMeta = WpTermMeta::factory()->create();

        $data = [
            'term_id' => $this->faker->randomNumber(),
            'meta_key' => $this->faker->text(255),
            'meta_value' => $this->faker->text(),
        ];

        $response = $this->putJson(
            route('api.wp-term-metas.update', $wpTermMeta),
            $data
        );

        $data['meta_id'] = $wpTermMeta->meta_id;

        $this->assertDatabaseHas('wp_termmeta', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_wp_term_meta(): void
    {
        $wpTermMeta = WpTermMeta::factory()->create();

        $response = $this->deleteJson(
            route('api.wp-term-metas.destroy', $wpTermMeta)
        );

        $this->assertModelMissing($wpTermMeta);

        $response->assertNoContent();
    }
}
