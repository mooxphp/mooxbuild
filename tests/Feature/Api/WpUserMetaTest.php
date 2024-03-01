<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\WpUserMeta;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WpUserMetaTest extends TestCase
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
    public function it_gets_wp_user_metas_list(): void
    {
        $wpUserMetas = WpUserMeta::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.wp-user-metas.index'));

        $response->assertOk()->assertSee($wpUserMetas[0]->meta_key);
    }

    /**
     * @test
     */
    public function it_stores_the_wp_user_meta(): void
    {
        $data = WpUserMeta::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.wp-user-metas.store'), $data);

        $this->assertDatabaseHas('wp_usermeta', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_wp_user_meta(): void
    {
        $wpUserMeta = WpUserMeta::factory()->create();

        $data = [
            'user_id' => $this->faker->randomNumber(),
            'meta_key' => $this->faker->text(255),
            'meta_value' => $this->faker->text(),
        ];

        $response = $this->putJson(
            route('api.wp-user-metas.update', $wpUserMeta),
            $data
        );

        $data['umeta_id'] = $wpUserMeta->umeta_id;

        $this->assertDatabaseHas('wp_usermeta', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_wp_user_meta(): void
    {
        $wpUserMeta = WpUserMeta::factory()->create();

        $response = $this->deleteJson(
            route('api.wp-user-metas.destroy', $wpUserMeta)
        );

        $this->assertModelMissing($wpUserMeta);

        $response->assertNoContent();
    }
}
